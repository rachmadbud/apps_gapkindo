@extends('layouts.master')
@section('title', 'Rekapitulasi Laporan Bulanan')
@section('content')
    @include('laporanPenjualan._styles')
    @php
        $monthNames = [
            1 => 'Januari',
            2 => 'Februari',
            3 => 'Maret',
            4 => 'April',
            5 => 'Mei',
            6 => 'Juni',
            7 => 'Juli',
            8 => 'Agustus',
            9 => 'September',
            10 => 'Oktober',
            11 => 'November',
            12 => 'Desember',
        ];
        $statusLabels = [
            'pending_review' => 'Menunggu Review',
            'needs_revision' => 'Perlu Revisi',
            'approved' => 'Disetujui',
        ];
        $statusClasses = ['pending_review' => 'warning', 'needs_revision' => 'danger', 'approved' => 'success'];
        $periodReport = $currentReport;
        $periodStatus = $periodReport->status ?? null;
        $canUploadPeriod = $periodStatus === null || $periodStatus === 'needs_revision';
    @endphp

    <style>
        .upload-box {
            border: 2px dashed #cbd5e1;
            border-radius: 14px;
            padding: 35px 20px;
            text-align: center;
            background: #f8fafc;
            cursor: pointer;
            transition: all 0.25s ease;
        }

        .upload-box:hover {
            border-color: #198754;
            background: #f0fdf4;
        }

        .upload-box.dragover {
            border-color: #198754;
            background: #ecfdf3;
            transform: scale(1.01);
        }

        .upload-icon {
            width: 65px;
            height: 65px;
            background: #dcfce7;
            color: #198754;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 30px;
            margin: 0 auto 15px;
        }

        .btn-upload {
            background: #198754;
            color: white;
            border-radius: 8px;
            padding: 9px 22px;
            font-weight: 600;
            transition: 0.2s;
        }

        .btn-upload:hover {
            background: #146c43;
            color: white;
        }

        #file-name {
            word-break: break-word;
        }

        .upload-box small {
            font-size: 12px;
        }
    </style>
    <div class="container-fluid py-4 monthly-report-page">
        <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">
            <div>
                <h1 class="h3 mb-1">Laporan Bulanan Cabang</h1>
                <p class="text-muted mb-0">
                    <i class="fas fa-map-marker-alt mr-1"></i>{{ $branch['name'] }}
                    <span class="mx-1">·</span>{{ $branch['code'] }}
                </p>
            </div>
        </div>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Periksa kembali:</strong>
                <ul class="mb-0 mt-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="card report-card report-tone-brand mb-4">
            <div class="card-header">
                <h5 class="card-title"><i class="fas fa-file-excel mr-2"></i>Template Laporan</h5>
            </div>
            <div class="card-body d-flex flex-wrap justify-content-between align-items-center">
                <div class="mr-3">
                    <h2 class="h5 mb-1">Mulai dengan template resmi</h2>
                    <p class="text-muted mb-0">Unduh template, isi data perusahaan tanpa mengubah header, lalu unggah file
                        tersebut di bawah.</p>
                </div>
                <div class="mt-3 mt-md-0">
                    <a class="btn btn-success mr-2" href="{{ route('laporanPenjualan.template') }}">
                        <i class="fas fa-file-excel mr-1"></i> Download Template Excel
                    </a>
                    <a class="btn btn-outline-primary"
                        href="{{ asset('manualbook/Manualbook_Laporan_Bulanan_Cabang.pdf') }}" target="_blank">
                        {{-- {{ route('laporanPenjualan.guide') }} --}}
                        <i class="fas fa-book mr-1"></i> Download Panduan PDF
                    </a>
                </div>
            </div>
        </div>

        <div class="card report-card report-tone-success mb-4">
            <div class="card-header">
                <div class="d-flex flex-wrap justify-content-between align-items-center">
                    <h2 class="h5 mb-0">Upload Laporan Bulanan</h2>
                    <span class="badge badge-{{ $statusClasses[$periodStatus] ?? 'secondary' }}">
                        {{ $periodStatus ? $statusLabels[$periodStatus] ?? $periodStatus : 'Belum Upload' }}
                    </span>
                </div>
            </div>
            <div class="card-body">
                @if ($periodReport && $periodReport->status === 'needs_revision' && $periodReport->admin_note)
                    <div class="alert alert-warning">Catatan admin: {{ $periodReport->admin_note }}</div>
                @endif
                @if (!$canUploadPeriod && !$preview)
                    <div class="alert alert-warning">
                        Periode {{ $monthNames[(int) $selectedMonth] }} {{ $selectedYear }} berstatus
                        <strong>{{ $statusLabels[$periodReport->status] ?? $periodReport->status }}</strong>.
                        @if ($periodReport->status === 'pending_review')
                            Tunggu hasil pemeriksaan admin sebelum mengunggah kembali, atau pilih periode lain.
                        @else
                            Laporan yang disetujui tidak dapat diganti; pilih periode lain.
                        @endif
                    </div>
                @endif
                <form action="{{ route('laporanPenjualan.preview') }}" method="POST" enctype="multipart/form-data"
                    id="report-upload-form">
                    @csrf
                    <input type="hidden" name="history_year" value="{{ $historyYear }}">
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="report_month">Bulan laporan</label>
                            <select class="form-control" id="report_month" name="report_month" required>
                                @foreach ($monthNames as $number => $monthName)
                                    <option value="{{ $number }}"
                                        {{ (int) old('report_month', $selectedMonth) === $number ? 'selected' : '' }}>
                                        {{ $monthName }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="report_year">Tahun laporan</label>
                            <select class="form-control" id="report_year" name="report_year" required>
                                @for ($year = 2100; $year >= 2000; $year--)
                                    <option value="{{ $year }}"
                                        {{ (int) old('report_year', $selectedYear) === $year ? 'selected' : '' }}>
                                        {{ $year }}</option>
                                @endfor
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="font-weight-bold mb-2" for="file">
                            File Laporan Excel
                        </label>

                        <div class="upload-box" id="drop-zone">
                            <input type="file" id="file" name="file" accept=".xlsx,.xls" required hidden>

                            <div id="upload-placeholder">
                                <div class="upload-icon">
                                    <i class="fas fa-file-excel"></i>
                                </div>

                                <h6 class="font-weight-bold mb-1">
                                    Upload File Excel
                                </h6>

                                <p class="text-muted mb-3">
                                    Seret dan lepas file di sini atau
                                </p>

                                <button type="button" class="btn btn-upload" id="choose-file">
                                    <i class="fas fa-folder-open mr-2"></i>
                                    Pilih File
                                </button>

                                <small class="d-block text-muted mt-3">
                                    Format .xlsx atau .xls (Maksimal 10 MB)
                                </small>
                            </div>

                            <div id="file-selected" class="d-none">
                                <div class="upload-icon">
                                    <i class="fas fa-file-excel"></i>
                                </div>

                                <h6 class="font-weight-bold text-success mb-1">
                                    File berhasil dipilih!
                                </h6>

                                <p id="file-name" class="mb-1 font-weight-bold"></p>
                                <small id="file-size" class="text-muted"></small>

                                <div class="mt-3">
                                    <button type="button" class="btn btn-sm btn-outline-primary" id="change-file">
                                        Ganti File
                                    </button>

                                    <button type="button" class="btn btn-sm btn-outline-danger" id="remove-file">
                                        Hapus
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tombol Preview -->
                    <div class="d-flex align-items-center mt-4">

                        <button class="btn btn-primary px-4" type="submit" id="preview-button">
                            <i class="fas fa-search mr-1"></i>
                            Baca dan Preview Excel
                        </button>

                        <span class="text-muted ml-3 d-none" id="upload-loading">
                            <i class="fas fa-spinner fa-spin mr-1"></i>
                            Membaca file...
                        </span>

                    </div>
                </form>
            </div>
        </div>

        @if ($preview)
            <div class="card report-card report-tone-info mb-4" id="preview-results">
                <div class="card-header d-flex flex-wrap justify-content-between align-items-center">
                    <div>
                        <h2 class="h5 mb-1">Preview Data Excel</h2>
                        <small class="text-muted">
                            {{ $monthNames[(int) $selectedMonth] }} {{ $selectedYear }}
                            @if ($previewFileName)
                                · {{ $previewFileName }} ({{ number_format($previewFileSize / 1024, 1, ',', '.') }} KB)
                            @endif
                        </small>
                    </div>
                    <span class="badge badge-info p-2">{{ count($preview['rows']) }} perusahaan</span>
                </div>
                <div class="card-body">
                    <div class="row">
                        @foreach (['production' => 'Total Produksi (KG)', 'local_sales' => 'Total Lokal (KG)', 'export_sales' => 'Total Ekspor (KG)', 'total_sales' => 'Total Penjualan (KG)'] as $field => $label)
                            <div class="col-lg-3 col-sm-6 mb-3">
                                <div class="report-summary-card rounded p-3 h-100">
                                    <small class="text-muted">{{ $label }}</small>
                                    <div class="h5 mb-0 mt-1">
                                        {{ number_format($preview['totals'][$field] ?? 0, 0, ',', '.') }}</div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    @if ($preview['warnings'] !== [])
                        <div class="alert alert-warning">
                            <strong><i class="fas fa-exclamation-triangle mr-1"></i> Perlu diperiksa</strong>
                            <ul class="mb-0 mt-2">
                                @foreach (array_slice($preview['warnings'], 0, 30) as $warning)
                                    <li>{{ $warning }}</li>
                                @endforeach
                                @if (count($preview['warnings']) > 30)
                                    <li>Dan {{ count($preview['warnings']) - 30 }} peringatan lainnya.</li>
                                @endif
                            </ul>
                        </div>
                    @else
                        <div class="alert alert-success">Struktur dan total Excel berhasil dibaca. Periksa data sebelum
                            mengirim.</div>
                    @endif

                    <div class="card report-card mb-0">
                        <div class="card-header">
                            <h6 class="card-title">Data Perusahaan</h6>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped" id="preview-data-table">
                                    <thead>
                                        <tr align="center" class="alert-dark">
                                            <th>No.</th>
                                            <th>Nama Perusahaan</th>
                                            <th>Kapasitas (TON/THN)</th>
                                            <th>Kode TPP</th>
                                            <th>Jenis Karet</th>
                                            <th>Oper. Fact. (UNIT)</th>
                                            <th>Produksi (KG)</th>
                                            <th>Lokal (KG)</th>
                                            <th>Ekspor (KG)</th>
                                            <th>Penjualan (KG)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach (array_slice($preview['rows'], 0, 100) as $row)
                                            <tr>
                                                <td>{{ $row['source_number'] ?: '—' }}</td>
                                                <td>{{ $row['company_name'] ?: '—' }}</td>
                                                <td>{{ $row['capacity'] === null ? '—' : number_format($row['capacity'], 0, ',', '.') }}
                                                </td>
                                                <td>{{ $row['tpp_code'] ?: '—' }}</td>
                                                <td>{{ $row['rubber_type'] ?: '—' }}</td>
                                                <td>{{ $row['operating_factor'] === null ? '—' : number_format($row['operating_factor'], 2, ',', '.') }}
                                                </td>
                                                <td>{{ $row['production'] === null ? '—' : number_format($row['production'], 0, ',', '.') }}
                                                </td>
                                                <td>{{ $row['local_sales'] === null ? '—' : number_format($row['local_sales'], 0, ',', '.') }}
                                                </td>
                                                <td>{{ $row['export_sales'] === null ? '—' : number_format($row['export_sales'], 0, ',', '.') }}
                                                </td>
                                                <td>{{ $row['total_sales'] === null ? '—' : number_format($row['total_sales'], 0, ',', '.') }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    @if (count($preview['rows']) > 100)
                        <small class="text-muted">Preview menampilkan 100 dari {{ count($preview['rows']) }} perusahaan;
                            seluruh data akan disimpan.</small>
                    @endif

                    @if ($preview['errors'] === [] && $previewToken)
                        <form action="{{ route('laporanPenjualan.store') }}" method="POST" class="mt-3">
                            @csrf
                            <input type="hidden" name="preview_token" value="{{ $previewToken }}">
                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-paper-plane mr-1"></i> Kirim Laporan
                            </button>
                        </form>
                    @else
                        <div class="alert alert-danger mb-0">Data belum dapat dikirim. Perbaiki nilai yang tidak valid di
                            file Excel lalu buat preview ulang.</div>
                    @endif
                </div>
            </div>
        @endif

        <div class="card report-card report-tone-secondary">
            <div class="card-header d-flex flex-wrap justify-content-between align-items-center">
                <h2 class="card-title mb-2 mb-md-0">Riwayat Laporan</h2>
                <form action="{{ route('laporanPenjualan.index') }}" method="GET" class="form-inline">
                    <label for="history_year" class="mr-2 mb-0">Tahun</label>
                    <select class="form-control form-control-sm mr-2" id="history_year" name="history_year">
                        <option value="all" {{ $historyYear === 'all' ? 'selected' : '' }}>Semua tahun</option>
                        @foreach ($reportYears as $year)
                            <option value="{{ $year }}" {{ (string) $year === $historyYear ? 'selected' : '' }}>
                                {{ $year }}
                            </option>
                        @endforeach
                    </select>
                    <button class="btn btn-sm btn-primary" type="submit">
                        <i class="fas fa-filter mr-1"></i> Tampilkan
                    </button>
                </form>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped mb-0">
                        <thead>
                            <tr align="center" class="alert-dark">
                                <th>Periode</th>
                                <th>Tanggal Upload</th>
                                <th>Nama File</th>
                                <th>Status</th>
                                <th>Catatan Admin</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($reports as $report)
                                <tr>
                                    <td>{{ $monthNames[$report->report_month] ?? $report->report_month }}
                                        {{ $report->report_year }}</td>
                                    <td>{{ optional($report->latestUpload)->created_at ? $report->latestUpload->created_at->format('d-m-Y H:i') : '—' }}
                                    </td>
                                    <td>{{ optional($report->latestUpload)->original_filename ?? '—' }}</td>
                                    <td><span
                                            class="badge badge-{{ $statusClasses[$report->status] ?? 'secondary' }}">{{ $statusLabels[$report->status] ?? $report->status }}</span>
                                    </td>
                                    <td>{{ $report->admin_note ?: '—' }}</td>
                                    <td><a class="btn btn-sm btn-outline-primary"
                                            href="{{ route('laporanPenjualan.show', $report) }}">Detail</a></td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center text-muted py-4">Belum ada laporan yang
                                        diunggah.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            @if ($reports->hasPages())
                <div class="card-footer bg-white">{{ $reports->links() }}</div>
            @endif
        </div>
    </div>

    <script>
        (function() {
            const input = document.getElementById('file');
            const zone = document.getElementById('drop-zone');

            if (!input || !zone) return;

            const placeholder = document.getElementById('upload-placeholder');
            const selected = document.getElementById('file-selected');

            const chooseBtn = document.getElementById('choose-file');
            const changeBtn = document.getElementById('change-file');
            const removeBtn = document.getElementById('remove-file');

            const fileName = document.getElementById('file-name');
            const fileSize = document.getElementById('file-size');

            const MAX_SIZE = 10 * 1024 * 1024;

            function showFile(file) {
                if (!file) return;

                const extension = file.name.split('.').pop().toLowerCase();

                if (!['xlsx', 'xls'].includes(extension)) {
                    alert('Format file harus .xlsx atau .xls!');
                    input.value = '';
                    return;
                }

                if (file.size > MAX_SIZE) {
                    alert('Ukuran file maksimal 10 MB!');
                    input.value = '';
                    return;
                }

                fileName.textContent = file.name;
                fileSize.textContent =
                    (file.size / 1024 / 1024).toFixed(2) + ' MB';

                placeholder.classList.add('d-none');
                selected.classList.remove('d-none');
            }

            function resetFile() {
                input.value = '';
                selected.classList.add('d-none');
                placeholder.classList.remove('d-none');
            }

            function openFile() {
                input.click();
            }

            chooseBtn.addEventListener('click', function(e) {
                e.stopPropagation();
                openFile();
            });

            changeBtn.addEventListener('click', function(e) {
                e.stopPropagation();
                openFile();
            });

            removeBtn.addEventListener('click', function(e) {
                e.stopPropagation();
                resetFile();
            });

            zone.addEventListener('click', function(e) {
                if (e.target.closest('button')) return;
                openFile();
            });

            input.addEventListener('change', function() {
                showFile(input.files[0]);
            });

            zone.addEventListener('dragover', function(e) {
                e.preventDefault();
                zone.classList.add('dragover');
            });

            zone.addEventListener('dragleave', function(e) {
                if (!zone.contains(e.relatedTarget)) {
                    zone.classList.remove('dragover');
                }
            });

            zone.addEventListener('drop', function(e) {
                e.preventDefault();
                zone.classList.remove('dragover');

                const file = e.dataTransfer.files[0];
                if (!file) return;

                const dataTransfer = new DataTransfer();
                dataTransfer.items.add(file);
                input.files = dataTransfer.files;

                showFile(file);
            });

            const form = document.getElementById('report-upload-form');

            if (form) {
                form.addEventListener('submit', function(e) {
                    if (!input.files.length) {
                        e.preventDefault();
                        alert('Silakan pilih file Excel terlebih dahulu!');
                        return;
                    }

                    const file = input.files[0];

                    if (
                        !['xlsx', 'xls'].includes(
                            file.name.split('.').pop().toLowerCase()
                        ) || file.size > MAX_SIZE
                    ) {
                        e.preventDefault();
                        alert('File tidak valid!');
                        return;
                    }

                    const previewButton = document.getElementById('preview-button');
                    const loading = document.getElementById('upload-loading');

                    if (previewButton) previewButton.disabled = true;
                    if (loading) loading.classList.remove('d-none');
                });
            }

            @if ($preview)
                window.setTimeout(function() {
                    const previewTable = document.getElementById('preview-data-table');
                    if (previewTable) {
                        previewTable.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                    }
                }, 250);
            @endif
        })();
    </script>
@endsection

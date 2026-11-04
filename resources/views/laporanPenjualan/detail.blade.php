@extends('layouts.master')
@section('title', 'Detail Laporan Cabang')
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
        $upload = $report->latestUpload;
    @endphp
    <div class="container-fluid py-4 monthly-report-page">
        <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">
            <div>
                <a href="{{ route('laporanPenjualan.index') }}" class="text-muted"><i class="fas fa-arrow-left mr-1"></i>
                    Kembali</a>
                <h1 class="h3 mt-2 mb-0">Detail Laporan Bulanan</h1>
            </div>
            <span
                class="badge badge-{{ $statusClasses[$report->status] ?? 'secondary' }} p-2">{{ $statusLabels[$report->status] ?? $report->status }}</span>
        </div>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="row">
            <div class="col-lg-4 mb-3">
                <div class="card report-card report-tone-primary h-100">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="card-title font-weight-bold text-dark mb-0">
                            <i class="far fa-file-chart-line mr-2"></i> Identitas Laporan
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-sm table-bordered mb-0">
                                <tbody>
                                    <tr>
                                        <th class="text-muted font-weight-normal" style="width: 40%;">
                                            Cabang
                                        </th>
                                        <td class="font-weight-bold text-dark">
                                            {{ $report->branchUser->name }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="text-muted font-weight-normal">
                                            Periode
                                        </th>
                                        <td class="font-weight-bold text-dark">
                                            {{ $monthNames[$report->report_month] }} {{ $report->report_year }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="text-muted font-weight-normal">
                                            Status
                                        </th>
                                        <td>
                                            <span class="badge badge-info">
                                                {{ $statusLabels[$report->status] ?? $report->status }}
                                            </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="text-muted font-weight-normal">
                                            Catatan Admin
                                        </th>
                                        <td class="text-dark">
                                            {{ $report->admin_note ?: '—' }}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-8 mb-3">
                <div class="card report-card h-100">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="card-title font-weight-bold text-dark mb-0">
                            <i class="far fa-file-excel mr-2"></i>File Terbaru
                        </h5>
                    </div>
                    <div class="card-body">
                        @if ($upload)
                            <p class="mb-1"><strong>{{ $upload->original_filename }}</strong></p>
                            <p class="text-muted mb-3">{{ number_format($upload->file_size / 1024, 1, ',', '.') }} KB ·
                                Diunggah {{ $upload->created_at->format('d-m-Y H:i') }} · {{ $upload->company_count }}
                                perusahaan</p>
                            <a class="btn btn-outline-primary btn-sm"
                                href="{{ route('laporanPenjualan.download', [$report, $upload]) }}"><i
                                    class="fas fa-download mr-1"></i> Download Excel Asli</a>
                            <div class="row mt-4">
                                @php
                                    $summaryCards = [
                                        [
                                            'field' => 'production',
                                            'label' => 'Produksi',
                                            'unit' => 'KG',
                                            'icon' => 'fas fa-industry',
                                            'color' => '#3498db',
                                            'bg' => '#eaf4fc',
                                        ],
                                        [
                                            'field' => 'local_sales',
                                            'label' => 'Lokal',
                                            'unit' => 'KG',
                                            'icon' => 'fas fa-truck-loading',
                                            'color' => '#17a673',
                                            'bg' => '#e8f8f1',
                                        ],
                                        [
                                            'field' => 'export_sales',
                                            'label' => 'Ekspor',
                                            'unit' => 'KG',
                                            'icon' => 'fas fa-globe-asia',
                                            'color' => '#8e6ccf',
                                            'bg' => '#f2edfb',
                                        ],
                                        [
                                            'field' => 'total_sales',
                                            'label' => 'Total',
                                            'unit' => 'KG',
                                            'icon' => 'fas fa-chart-line',
                                            'color' => '#e69526',
                                            'bg' => '#fff5e5',
                                        ],
                                    ];
                                @endphp
                                @foreach ($summaryCards as $card)
                                    <div class="col-xl-3 col-md-6 col-6 mb-3">
                                                <div class="card report-card report-tone-{{ $card['field'] === 'production' ? 'production' : ($card['field'] === 'local_sales' ? 'local' : ($card['field'] === 'export_sales' ? 'export' : 'total')) }} h-100 mb-0">
                                            <div class="card-header">
                                                <h6 class="card-title">{{ $card['label'] }} <small class="text-muted">({{ $card['unit'] }})</small></h6>
                                            </div>
                                            <div class="card-body p-3">
                                                <div class="d-flex justify-content-between align-items-start mb-3">
                                                    <div>
                                                        <small class="text-muted font-weight-bold">Total laporan</small>
                                                    </div>
                                                    <div class="d-flex align-items-center justify-content-center"
                                                        style="
                        width: 42px;
                        height: 42px;
                        background: {{ $card['bg'] }};
                        color: {{ $card['color'] }};
                        border-radius: 12px;
                    ">
                                                        <i class="{{ $card['icon'] }} fa-lg"></i>
                                                    </div>
                                                </div>
                                                <h4 class="font-weight-bold mb-0 text-dark"
                                                    style="font-size: clamp(16px, 2vw, 22px);">
                                                    {{ number_format($upload->totals[$card['field']] ?? 0, 0, ',', '.') }}
                                                </h4>
                                                <div class="mt-2"
                                                    style="height: 3px; width: 45px; background: {{ $card['color'] }}; border-radius: 5px;">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            @if (!empty($upload->warnings))
                                <div class="card report-card report-tone-warning mt-3 mb-0">
                                    {{-- Header --}}
                                    <div class="card-header d-flex align-items-center justify-content-between">
                                        <div class="d-flex align-items-center">
                                            <div class="mr-3 d-flex align-items-center justify-content-center"
                                                style="width: 40px; height: 40px; background: #fff0c2; border-radius: 10px;">
                                                <i class="fas fa-exclamation-triangle text-warning fa-lg"></i>
                                            </div>
                                            <div>
                                                <h6 class="font-weight-bold text-dark mb-0">
                                                    Peringatan Excel
                                                </h6>
                                                <small class="text-muted">
                                                    Ditemukan {{ count($upload->warnings) }} peringatan pada file
                                                </small>
                                            </div>
                                        </div>
                                        <span class="badge badge-warning px-3 py-2" style="border-radius: 20px;">
                                            {{ count($upload->warnings) }} Peringatan
                                        </span>
                                    </div>
                                    {{-- Body --}}
                                    <div class="card-body p-3">
                                        <div class="mb-2 text-muted" style="font-size: 13px;">
                                            <i class="fas fa-info-circle mr-1"></i>
                                            Periksa beberapa informasi berikut untuk memastikan data laporan sudah sesuai.
                                        </div>
                                        <div style="max-height: 250px; overflow-y: auto;">
                                            <ul class="list-unstyled mb-0">
                                                @foreach (array_slice($upload->warnings, 0, 20) as $index => $warning)
                                                    <li class="d-flex align-items-start py-2"
                                                        style="border-bottom: 1px solid #f1ead8;">
                                                        <span
                                                            class="mr-3 d-flex align-items-center justify-content-center text-warning"
                                                            style="min-width: 25px; height: 25px; background: #fff0c2; border-radius: 50%; font-size: 11px;">
                                                            <i class="fas fa-exclamation"></i>
                                                        </span>
                                                        <span class="text-dark" style="font-size: 13px; line-height: 1.6;">
                                                            {{ $warning }}
                                                        </span>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                        @if (count($upload->warnings) > 20)
                                            <div class="mt-3 text-center">
                                                <small class="text-muted">
                                                    Dan {{ count($upload->warnings) - 20 }} peringatan lainnya tidak
                                                    ditampilkan.
                                                </small>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @endif
                        @else
                            <p class="text-muted mb-0">Belum ada file laporan.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        @if ($isAdmin && $report->status === 'pending_review')
            <div class="card report-card report-tone-warning mb-4">
                <div class="card-header">
                    <h3 class="card-title font-weight-bold">
                        <i class="fas fa-clipboard-check mr-2"></i>
                        Keputusan Review
                    </h3>
                </div>

                <div class="card-body">
                    <div class="row">


                        {{-- Permintaan revisi --}}
                        <div class="col-md-8">
                            <div class="h-100 p-3 border rounded">
                                <h6 class="font-weight-bold mb-2">
                                    <i class="fas fa-edit text-warning mr-1"></i>
                                    Minta Revisi
                                </h6>

                                <p class="text-muted small">
                                    Berikan catatan yang jelas agar pengguna mengetahui
                                    bagian laporan yang perlu diperbaiki.
                                </p>

                                <form action="{{ route('laporanPenjualan.revision', $report) }}" method="POST">
                                    @csrf

                                    <div class="form-group mb-3">
                                        <label for="note">
                                            Catatan / Alasan Revisi
                                            <span class="text-danger">*</span>
                                        </label>

                                        <textarea class="form-control @error('note') is-invalid @enderror" name="note" id="note" rows="3"
                                            minlength="5" maxlength="2000" placeholder="Tuliskan alasan atau bagian yang perlu diperbaiki..." required>{{ old('note') }}</textarea>

                                        @error('note')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror

                                        <small class="text-muted">
                                            Minimal 5 karakter, maksimal 2000 karakter.
                                        </small>
                                    </div>

                                    <button type="submit" class="btn btn-warning">
                                        <i class="fas fa-undo mr-1"></i>
                                        Kirim Permintaan Revisi
                                    </button>
                                </form>
                            </div>
                        </div>

                        {{-- Persetujuan --}}
                        <div class="col-md-4 mb-3 mb-md-0">
                            <div class="h-100 p-3 border rounded">
                                <h6 class="font-weight-bold mb-2">
                                    <i class="fas fa-check-circle text-success mr-1"></i>
                                    Setujui Laporan
                                </h6>

                                <p class="text-muted small">
                                    Jika laporan sudah sesuai dan tidak memerlukan perbaikan,
                                    Anda dapat menyetujui laporan ini.
                                </p>

                                <form action="{{ route('laporanPenjualan.approve', $report) }}" method="POST"
                                    onsubmit="return confirm('Apakah Anda yakin ingin menyetujui laporan ini?')">
                                    @csrf

                                    <button type="submit" class="btn btn-success btn-block">
                                        <i class="fas fa-check mr-1"></i>
                                        Setujui Laporan
                                    </button>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        @endif

        <div class="row">
            <div class="col-12">
                <div class="card report-card report-tone-info">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="card-title font-weight-bold text-dark mb-0">
                            <i class="far fa-file-chart-line mr-2"></i>Preview Laporan
                            {{ $monthNames[$report->report_month] }} {{ $report->report_year }}
                        </h5>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="table-responsive">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr align="center" class="alert-dark">
                                    <th>No.</th>
                                    <th>Nama Perusahaan</th>
                                    <th>Kapasitas</th>
                                    <th>Kode TPP</th>
                                    <th>Jenis Karet</th>
                                    <th>Oper. Fact.</th>
                                    <th>Produksi</th>
                                    <th>Lokal</th>
                                    <th>Ekspor</th>
                                    <th>Penjualan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse (optional($upload)->rows ?? [] as $row)
                                    <tr>
                                        <td>{{ $row->source_number ?: '—' }}</td>
                                        <td>{{ $row->company_name }}</td>
                                        <td>{{ $row->capacity === null ? '—' : number_format($row->capacity, 0, ',', '.') }}
                                        </td>
                                        <td>{{ $row->tpp_code ?: '—' }}</td>
                                        <td>{{ $row->rubber_type ?: '—' }}</td>
                                        <td>{{ $row->operating_factor === null ? '—' : number_format($row->operating_factor, 2, ',', '.') }}
                                        </td>
                                        <td>{{ $row->production === null ? '—' : number_format($row->production, 0, ',', '.') }}
                                        </td>
                                        <td>{{ $row->local_sales === null ? '—' : number_format($row->local_sales, 0, ',', '.') }}
                                        </td>
                                        <td>{{ $row->export_sales === null ? '—' : number_format($row->export_sales, 0, ',', '.') }}
                                        </td>
                                        <td>{{ $row->total_sales === null ? '—' : number_format($row->total_sales, 0, ',', '.') }}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="10" class="text-center text-muted py-4">Belum ada data perusahaan.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        </div>

                    </div>

                    <!-- /.card-body -->
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-6 mb-4">
                <div class="card report-card report-tone-primary h-100">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="card-title font-weight-bold text-dark mb-0">
                            <i class="far fa-history mr-2"></i> Riwayat Upload
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="list-group list-group-flush">
                            @forelse ($report->uploads->sortByDesc('id') as $version)
                                <div class="list-group-item d-flex justify-content-between align-items-center">
                                    <div><strong>{{ $version->original_filename }}</strong><br><small
                                            class="text-muted">Versi
                                            {{ $version->id }} · {{ $version->created_at->format('d-m-Y H:i') }} ·
                                            {{ $version->company_count }} perusahaan</small></div>
                                    <a class="btn btn-outline-secondary"
                                        href="{{ route('laporanPenjualan.download', [$report, $version]) }}"
                                        title="Unduh"><i class="fad fa-download"></i></a>
                                </div>
                            @empty
                                <div class="list-group-item text-muted">Belum ada riwayat upload.</div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 mb-4">
                <div class="card report-card report-tone-purple h-100">
                    <div class="card-header">
                        <h5 class="card-title font-weight-bold text-dark mb-0">
                            <i class="far fa-history mr-2"></i> Riwayat Aktivitas
                        </h5>
                    </div>

                    <div class="card-body">
                        <div class="timeline">

                            @forelse ($report->reviews->sortByDesc('id') as $review)
                                {{-- Label tanggal --}}
                                @if (
                                    $loop->first ||
                                        $review->created_at->format('Y-m-d') !=
                                            $report->reviews->sortByDesc('id')->values()[$loop->index - 1]->created_at->format('Y-m-d'))
                                    <div class="time-label">
                                        <span class="bg-success">
                                            {{ $review->created_at->translatedFormat('d M Y') }}
                                        </span>
                                    </div>
                                @endif

                                {{-- Item timeline --}}
                                <div>
                                    <i class="fas fa-circle bg-info" style="font-size: 12px;"></i>

                                    <div class="timeline-item">
                                        <span class="time">
                                            <i class="far fa-clock"></i>
                                            {{ $review->created_at->format('H:i') }}
                                        </span>

                                        <h3 class="timeline-header border-0">
                                            <strong>
                                                @switch($review->action)
                                                    @case('uploaded')
                                                        Diunggah
                                                    @break

                                                    @case('revised')
                                                        Diunggah ulang
                                                    @break

                                                    @case('approved')
                                                        Disetujui
                                                    @break

                                                    @case('revision_requested')
                                                        Diminta revisi
                                                    @break

                                                    @default
                                                        {{ ucfirst($review->action) }}
                                                @endswitch
                                            </strong>

                                            <span class="text-muted">
                                                oleh {{ $review->reviewer->name ?? 'Pengguna' }}
                                            </span>
                                        </h3>

                                        @if ($review->note)
                                            <div class="timeline-body">
                                                {{ $review->note }}
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                @empty
                                    <div class="text-center text-muted py-4">
                                        Belum ada aktivitas.
                                    </div>
                                @endforelse

                                <div>
                                    <i class="fas fa-clock bg-gray"></i>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection

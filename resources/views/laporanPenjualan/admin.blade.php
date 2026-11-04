@extends('layouts.master')
@section('title', 'Monitoring Laporan Cabang')
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
    @endphp

    <div class="container-fluid py-4 monthly-report-page">
        <div class="mb-4">
            <h1 class="h3 mb-1">Monitoring Laporan Bulanan Cabang Admin</h1>
            <p class="text-muted mb-0">Pantau laporan dan proses review dari seluruh akun cabang.</p>
        </div>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="card report-card report-tone-brand mb-4">
            <div class="card-header">
                <h5 class="card-title"><i class="far fa-filter mr-2"></i>Filter Data</h5>
            </div>
            <form method="GET" action="{{ route('laporanPenjualan.index') }}">
                <div class="card-body">
                    <div class="form-row align-items-end mb-0">
                        <div class="form-group col-md-2">
                            <label for="month">Bulan</label>
                            <select class="form-control" name="month" id="month">
                                @foreach ($monthNames as $number => $monthName)
                                    <option value="{{ $number }}"
                                        {{ $filters['month'] === $number ? 'selected' : '' }}>
                                        {{ $monthName }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-2">
                            <label for="year">Tahun</label>
                            <input class="form-control" type="number" min="2000" max="2100" name="year"
                                id="year" value="{{ $filters['year'] }}">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="branch">Cabang</label>
                            <select class="form-control" name="branch" id="branch">
                                <option value="">Semua cabang</option>
                                @foreach ($branches as $branch)
                                    <option value="{{ $branch->id }}"
                                        {{ (string) $filters['branch'] === (string) $branch->id ? 'selected' : '' }}>
                                        {{ $branch->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="status">Status</label>
                            <select class="form-control" name="status" id="status">
                                <option value="">Semua status</option>
                                <option value="not_uploaded" {{ $filters['status'] === 'not_uploaded' ? 'selected' : '' }}>
                                    Belum Upload</option>
                                <option value="pending_review"
                                    {{ $filters['status'] === 'pending_review' ? 'selected' : '' }}>
                                    Menunggu Review</option>
                                <option value="needs_revision"
                                    {{ $filters['status'] === 'needs_revision' ? 'selected' : '' }}>
                                    Perlu Revisi</option>
                                <option value="approved" {{ $filters['status'] === 'approved' ? 'selected' : '' }}>
                                    Disetujui
                                </option>
                            </select>
                        </div>
                        <div class="form-group col-md-2">
                            <button class="btn btn-primary btn-block" type="submit"><i class="fas fa-filter mr-1"></i>
                                Terapkan</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    @foreach ([['Total Cabang', $stats['branches'], 'primary', 'far fa-code-branch'], ['Sudah Upload', $stats['uploaded'], 'info', 'fas fa-cloud-upload-alt'], ['Belum Upload', $stats['not_uploaded'], 'secondary', 'far fa-file-excel'], ['Menunggu', $stats['pending'], 'warning', 'far fa-clock'], ['Disetujui', $stats['approved'], 'success', 'fas fa-check-circle'], ['Perlu Revisi', $stats['revision'], 'danger', 'fas fa-undo-alt']] as [$label, $value, $color, $icon])
                        <div class="col-xl-2 col-md-4 col-6 mb-3">
                            <div class="card report-card report-stat-card report-tone-{{ $color }} h-100 mb-0">
                                <div class="card-header">
                                    <h6 class="card-title">{{ $label }}</h6>
                                </div>
                                <div class="card-body report-stat-body">
                                    <h3 class="report-stat-value mb-0">{{ $value }}</h3>
                                    <i class="{{ $icon }} report-stat-icon" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-12">
                    <div class="card report-card report-tone-info">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="card-title">
                                <i class="far fa-file-chart-line mr-2"></i> Laporan
                                {{ $monthNames[$filters['month']] }} {{ $filters['year'] }}
                            </h5>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped mb-0">
                                    <thead>
                                        <tr align="center" class="alert-dark">
                                            <th>No.</th>
                                            <th>Cabang</th>
                                            <th>Periode Laporan</th>
                                            <th>Tanggal Upload</th>
                                            <th>Nama File</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($reports as $index => $report)
                                            <tr>
                                                <td>{{ $reports->firstItem() + $index }}</td>
                                                <td>{{ $report->branch_name }}</td>
                                                <td>{{ $monthNames[$filters['month']] }} {{ $filters['year'] }}</td>
                                                <td>{{ $report->uploaded_at ? \Illuminate\Support\Carbon::parse($report->uploaded_at)->format('d-m-Y H:i') : '—' }}
                                                </td>
                                                <td>{{ $report->filename ?: '—' }}</td>
                                                <td>
                                                    @if (!$report->report_id)
                                                        <span class="badge badge-secondary">Belum Upload</span>
                                                    @else
                                                        <span
                                                            class="badge badge-{{ $statusClasses[$report->status] ?? 'secondary' }}">{{ $statusLabels[$report->status] ?? $report->status }}</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($report->report_id)
                                                        <a class="btn btn-sm btn-outline-primary"
                                                            href="{{ route('laporanPenjualan.show', $report->report_id) }}">Detail</a>
                                                    @else
                                                        <span class="text-muted">—</span>
                                                    @endif
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="7" class="text-center text-muted py-4">Tidak ada cabang yang
                                                    sesuai
                                                    filter.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
@endsection

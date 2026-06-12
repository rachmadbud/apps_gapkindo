@extends('layouts.master')
@section('title', 'Dashboard')
@section('content')

    @php
        use App\Models\CustomClass;
    @endphp

    @if ($aksesMenu != 1)
        @include('errors.405')
    @else
        <div class="container-fluid pt-4">

            <div class="row pt-4">

                <div class="col-lg-6 col-md-12 mb-4">
                    <div class="card border-0 elevation-1 custom-stat-card"
                        style="border-radius: 12px; transition: all 0.3s ease;">
                        <div class="card-body d-flex align-items-center justify-content-between p-4">
                            <div class="d-flex align-items-center">
                                <div class="d-flex align-items-center justify-content-center text-info rounded-circle mr-3"
                                    style="width: 60px; height: 60px; background-color: #e3f2fd;">
                                    <i class="fas fa-file-import fa-2x"></i>
                                </div>
                                <div>
                                    <span class="text-muted text-uppercase text-xs font-weight-bold d-block mb-1"
                                        style="letter-spacing: 1.5px;">Surat Masuk</span>
                                    <span class="text-xs text-muted"><i class="fas fa-clock mr-1"></i> Diperbarui
                                        live</span>
                                </div>
                            </div>
                            <div>
                                <h1 class="display-4 font-weight-bold mb-0 text-dark"
                                    style="font-size: 2.8rem; letter-spacing: -1px;">{{ $stmtSuratMasukRow }}</h1>
                            </div>
                        </div>
                        <div
                            class="card-footer bg-transparent border-0 pt-0 pb-3 px-4 d-flex justify-content-between align-items-center">
                            <a href="{{ app(CustomClass::class)->rootApp() }}/suratMasukx"
                                class="text-sm text-info font-weight-bold custom-link">
                                Lihat detail data <i class="fas fa-arrow-right text-xs ml-1 transition-arrow"></i>
                            </a>
                            <span class="text-xs text-muted">Total berkas terdata</span>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 col-md-12 mb-4">
                    <div class="card border-0 elevation-1 custom-stat-card"
                        style="border-radius: 12px; transition: all 0.3s ease;">
                        <div class="card-body d-flex align-items-center justify-content-between p-4">
                            <div class="d-flex align-items-center">
                                <div class="d-flex align-items-center justify-content-center text-success rounded-circle mr-3"
                                    style="width: 60px; height: 60px; background-color: #e8f5e9;">
                                    <i class="fas fa-file-export fa-2x"></i>
                                </div>
                                <div>
                                    <span class="text-muted text-uppercase text-xs font-weight-bold d-block mb-1"
                                        style="letter-spacing: 1.5px;">Surat Keluar</span>
                                    <span class="text-xs text-muted"><i class="fas fa-clock mr-1"></i> Diperbarui
                                        live</span>
                                </div>
                            </div>
                            <div>
                                <h1 class="display-4 font-weight-bold mb-0 text-dark"
                                    style="font-size: 2.8rem; letter-spacing: -1px;">{{ $stmtSuratKeluarRow }}</h1>
                            </div>
                        </div>
                        <div
                            class="card-footer bg-transparent border-0 pt-0 pb-3 px-4 d-flex justify-content-between align-items-center">
                            <a href="{{ app(CustomClass::class)->rootApp() }}/suratKeluarx"
                                class="text-sm text-success font-weight-bold custom-link">
                                Lihat detail data <i class="fas fa-arrow-right text-xs ml-1 transition-arrow"></i>
                            </a>
                            <span class="text-xs text-muted">Total berkas terkirim</span>
                        </div>
                    </div>
                </div>

            </div>

            <div class="row mt-3">
                <div class="col-12">
                    <div class="card border-0 elevation-1" style="border-radius: 10px;">
                        <div class="card-header bg-white border-0 pt-3 d-flex justify-content-between align-items-center">
                            <h5 class="card-title font-weight-bold text-dark mb-0">
                                <i class="fas fa-paper-plane text-success mr-2"></i> Surat Keluar Terbaru
                            </h5>
                            <a href="{{ app(CustomClass::class)->rootApp() }}/suratKeluarx"
                                class="text-xs font-weight-bold text-success">Lihat Semua <i
                                    class="fas fa-arrow-right ml-1"></i></a>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-hover table-striped table-valign-middle mb-0">
                                    <thead>
                                        <tr class="text-muted text-xs">
                                            <th style="width: 15%;">Tanggal</th>
                                            <th style="width: 20%;">No. Surat</th>
                                            <th style="width: 40%;">Perihal</th>
                                            <th style="width: 25%;">Ditujukan Ke</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($stmtSuratKeluar as $surat)
                                            <tr>
                                                <td>
                                                    <span class="text-sm text-dark">
                                                        {{ date('d-m-Y', strtotime($surat->tanggal)) }}
                                                    </span>
                                                </td>

                                                <td>
                                                    <span class="font-weight-bold text-sm text-primary">
                                                        {{ $surat->nomor_surat }}
                                                    </span>
                                                </td>

                                                <td>
                                                    <span class="text-sm text-muted">
                                                        {{ $surat->perihal }}
                                                    </span>
                                                </td>

                                                <td>
                                                    <span class="font-weight-bold text-sm text-dark">
                                                        {{ $surat->ditujukan }}
                                                    </span>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="4" class="text-center text-muted py-3">Belum ada data surat
                                                    keluar.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-2">

                <div class="col-lg-8 col-md-12 mb-4">
                    <div class="card border-0 elevation-1" style="border-radius: 10px; min-height: 200px;">
                        <div class="card-header bg-white border-0 pt-3 d-flex justify-content-between align-items-center">
                            <h5 class="card-title font-weight-bold text-dark mb-0">
                                <i class="fas fa-envelope-open-text text-info mr-2"></i> Surat Masuk Terbaru
                            </h5>
                            <a href="#" class="text-xs font-weight-bold text-info">Lihat Semua <i
                                    class="fas fa-arrow-right ml-1"></i></a>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-hover table-striped table-valign-middle mb-0">
                                    <thead>
                                        <tr class="text-muted text-xs">
                                            <th style="width: 15%;">Tanggal</th>
                                            <th style="width: 20%;">No. Agenda</th>
                                            <th style="width: 25%;">No. Surat</th>
                                            <th style="width: 40%;">Pengirim</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($stmtSuratMasuk as $surat)
                                            <tr>
                                                <td>
                                                    <span class="text-sm text-dark">
                                                        {{ date('d-m-Y', strtotime($surat->tanggal)) }}
                                                    </span>
                                                </td>

                                                <td>
                                                    <span class="font-weight-bold text-sm text-secondary">
                                                        {{ $surat->nomor_agenda }}
                                                    </span>
                                                </td>

                                                <td>
                                                    <span class="font-weight-bold text-sm text-primary">
                                                        {{ $surat->nomor_surat }}
                                                    </span>
                                                </td>

                                                <td>
                                                    <span class="text-sm text-muted">
                                                        {{ $surat->pengirim }}
                                                    </span>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="4" class="text-center text-muted py-4">
                                                    <i class="fas fa-envelope mr-2"></i> Belum ada data surat masuk
                                                    terbaru.
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-12 mb-4">
                    <div class="card border-0 elevation-1" style="border-radius: 10px; min-height: 200px;">
                        <div class="card-header bg-white border-0 pt-3">
                            <h5 class="card-title font-weight-bold text-dark">
                                <i class="fas fa-bolt text-warning mr-2"></i> Aksi Cepat
                            </h5>
                        </div>
                        <div class="card-body d-flex flex-column justify-content-center p-3" style="height: 145px;">
                            <a href="{{ app(CustomClass::class)->rootApp() }}/form/suratKeluar"
                                class="btn btn-outline-success btn-block text-left py-2 font-weight-bold"
                                style="border-radius: 8px; font-size: 13px;">
                                <i class="fas fa-paper-plane mr-2"></i> Buat Draft Surat Keluar
                            </a>
                            <a href="{{ app(CustomClass::class)->rootApp() }}/form/suratMasuk"
                                class="btn btn-outline-primary btn-block text-left py-2 mb-2 font-weight-bold"
                                style="border-radius: 8px; font-size: 13px;">
                                <i class="fas fa-plus-circle mr-2"></i> Registrasi Surat Masuk Baru
                            </a>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    @endif

@endsection

@extends('layouts.master')
@section('content')

@php
use App\Models\CustomClass;
@endphp

@if($aksesSubMenu != 1)
    @include('errors.405')
@else
    <div class="container-fluid">
        <h3 class="text-black-50">Master Jenis Laporan</h3>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                    <h3 class="card-title">
                    <a href="{{app(CustomClass::class)->rootApp()}}/manajemenJenisLaporan/tambah" class="btn btn-info"><i class='fa fa-plus'></i></a>
                    </h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">

                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr align="center" class="alert-dark">
                                    <th>No.</th>
                                    <th>Nama Jenis Laporan</th>
                                    <th>Unit Kerja</th>
                                    <th>Periode Laporan</th>
                                    <th>Tanggal Jatuh Tempo Laporan</th>
                                    <th>Status Data</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $no = 1; @endphp
                                @foreach($stmtListJenisLaporan as $dataListJenisLaporan)
                                <tr>
                                    <td align="center">{{ $no++ }}</td>
                                    <td align="left">{{ $dataListJenisLaporan->nama }}</td>
                                    <td align="center">{{ app(CustomClass::class)->getNamaUnitKerja($dataListJenisLaporan->id_unit_kerja) }}</td>
                                    <td align="center">{{ app(CustomClass::class)->getNamaPeriodeLaporan($dataListJenisLaporan->id_periode_laporan) }}</td>
                                    <td align="left">{{ $dataListJenisLaporan->tanggal_jatuh_tempo_laporan }}</td>
                                    <td align="center">{{ app(CustomClass::class)->ketStatusData($dataListJenisLaporan->status_data) }}</td>
                                    <td align="center"><a href="{{app(CustomClass::class)->rootApp()}}/manajemenJenisLaporan/edit/{{ app(CustomClass::class)->enkrip($dataListJenisLaporan->id) }}" class="btn btn-info"><i class='fa fa-pen'></i></a>
                                    <a href='{{app(CustomClass::class)->rootApp()}}/manajemenJenisLaporan/hapus/{{ app(CustomClass::class)->enkrip($dataListJenisLaporan->id) }}' class='btn btn-danger float-right' onclick="return confirm('Apakah Anda yakin untuk menghapus data ini ?')">
                                        <i class='fa fa-trash'></i>
                                    </a></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>

                    <!-- /.card-body -->
                </div>
            </div>
        </div>

    </div>
@endif

@endsection
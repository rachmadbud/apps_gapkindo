@extends('layouts.master')
@section('content')

@php
use App\Models\CustomClass;
@endphp

@if($aksesSubMenu != 1)
    @include('errors.405')
@else
    <div class="container-fluid">
        <h3 class="text-black-50">Bukti Upload Laporan</h3>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                    <h3 class="card-title">
                    <a href="{{app(CustomClass::class)->rootApp()}}/manajemenBuktiUpload/tambah" class="btn btn-info"><i class='fa fa-plus'></i></a>
                    </h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">

                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr align="center" class="alert-dark">
                                    <th>No.</th>
                                    <th>Jenis Laporan</th>
                                    <th>Periode</th>
                                    <th>File Bukti Kirim</th>
                                    <th>Keterangan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $no = 1; @endphp
                                @foreach($stmtListHistLaporan as $dataListHistLaporan)
                                <tr>
                                    <td align="center">{{ $no++ }}</td>
                                    <td align="center">{{ app(CustomClass::class)->getNamaJenisLaporan($dataListHistLaporan->id_jenis_laporan) }}</td>
                                    <td align="center">{{ $dataListHistLaporan->periode }}</td>
                                    <td align="center">{{ $dataListHistLaporan->nama_file_bukti_kirim }}</td>
                                    <td align="center">{{ $dataListHistLaporan->keterangan }}</td>
                                    <td align="center"><a href="{{app(CustomClass::class)->rootApp()}}/manajemenBuktiUpload/edit/{{ app(CustomClass::class)->enkrip($dataListHistLaporan->id) }}" class="btn btn-info"><i class='fa fa-pen'></i></a>
                                    <a href='{{app(CustomClass::class)->rootApp()}}/manajemenBuktiUploadLaporan/hapus/{{ app(CustomClass::class)->enkrip($dataListHistLaporan->id) }}' class='btn btn-danger float-right' onclick="return confirm('Apakah Anda yakin untuk menghapus data ini ?')">
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
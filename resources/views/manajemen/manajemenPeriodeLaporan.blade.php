@extends('layouts.master')
@section('content')

@php
use App\Models\CustomClass;
@endphp

@if($aksesSubMenu != 1)
    @include('errors.405')
@else
    <div class="container-fluid">
        <h3 class="text-black-50">Master Periode Laporan</h3>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                    <h3 class="card-title">
                    <a href="{{app(CustomClass::class)->rootApp()}}/manajemenPeriodeLaporan/tambah" class="btn btn-info"><i class='fa fa-plus'></i></a>
                    </h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">

                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr align="center" class="alert-dark">
                                    <th>No.</th>
                                    <th>Nama Periode Laporan</th>
                                    <th>Reminder Pertama</th>
                                    <th>Reminder Kedua</th>
                                    <th>Reminder Ketiga</th>
                                    <th>Reminder Keempat</th>
                                    {{-- <th>Time Reminder</th> --}}
                                    <th>Status Data</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $no = 1; @endphp
                                @foreach($stmtListPeriodeLaporan as $dataListPeriodeLaporan)
                                <tr>
                                    <td align="center">{{ $no++ }}</td>
                                    <td align="left">{{ $dataListPeriodeLaporan->nama }}</td>
                                    <td align="left">{{ $dataListPeriodeLaporan->reminder_1 }}</td>
                                    <td align="left">{{ $dataListPeriodeLaporan->reminder_2 }}</td>
                                    <td align="left">{{ $dataListPeriodeLaporan->reminder_3 }}</td>
                                    <td align="left">{{ $dataListPeriodeLaporan->reminder_4 }}</td>
                                    {{-- <td align="left">{{ $dataListPeriodeLaporan->time_reminder }}</td> --}}
                                    {{-- <td align="left">{{ $dataListMasterUnitKerja->status_data }}</td> --}}
                                    <td align="center">{{ app(CustomClass::class)->ketStatusData($dataListPeriodeLaporan->status_data) }}</td>
                                    {{-- <td align="center">{{ app(CustomClass::class)->getNamaUnitKerja($dataListUser->id_unit_kerja) }}</td> --}}
                                    <td align="center"><a href="{{app(CustomClass::class)->rootApp()}}/manajemenPeriodeLaporan/edit/{{ app(CustomClass::class)->enkrip($dataListPeriodeLaporan->id) }}" class="btn btn-info"><i class='fa fa-pen'></i></a>
                                    <a href='{{app(CustomClass::class)->rootApp()}}/manajemenPeriodeLaporan/hapus/{{ app(CustomClass::class)->enkrip($dataListPeriodeLaporan->id) }}' class='btn btn-danger float-right' onclick="return confirm('Apakah Anda yakin untuk menghapus data ini ?')">
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
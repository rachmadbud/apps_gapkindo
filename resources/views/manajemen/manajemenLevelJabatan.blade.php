@extends('layouts.master')
@section('content')

@php
use App\Models\CustomClass;
@endphp

@if($aksesSubMenu != 1)
@include('errors.405')
@else
<div class="container-fluid">
    <h3 class="text-black-50">Master Level Jabatan</h3>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <a href="{{app(CustomClass::class)->rootApp()}}/manajemenLevelJabatan/tambah"
                            class="btn btn-info"><i class='fa fa-plus'></i></a>
                    </h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">

                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr align="center" class="alert-dark">
                                <th>No.</th>
                                <th>Nama Level Jabatan</th>
                                <th>Hak Akses Jabatan</th>
                                <th>Status Data</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $no = 1; @endphp
                            @foreach($stmtListLevelJabatan as $dataListLevelJabatan)
                            <tr>
                                <td align="center">{{ $no++ }}</td>
                                <td align="left">{{ $dataListLevelJabatan->nama }}</td>
                                <td align="left">
                                    <ol>
                                        @foreach(explode(',', $dataListLevelJabatan->id_akses_jabatan) as
                                        $id_akses_jabatan)
                                        @if($id_akses_jabatan != 0)
                                        <li>{{ app(CustomClass::class)->getMasterAksesJabatan($id_akses_jabatan) }}</li>
                                        @endif
                                        @endforeach
                                    </ol>
                                </td>
                                <td align="center">
                                    {{ app(CustomClass::class)->ketStatusData($dataListLevelJabatan->status_data) }}
                                </td>
                                <td align="center"><a
                                        href="{{app(CustomClass::class)->rootApp()}}/manajemenLevelJabatan/edit/{{ app(CustomClass::class)->enkrip($dataListLevelJabatan->id) }}"
                                        class="btn btn-info"><i class='fa fa-pen'></i></a>
                                </td>
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
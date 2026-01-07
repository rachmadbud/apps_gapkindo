@extends('layouts.master')
@section('content')

@php
use App\Models\CustomClass;
@endphp

@if($aksesSubMenu != 1)
    @include('errors.405')
@else
    <div class="container-fluid">
        <h3 class="text-black-50">Manajemen Submenu</h3>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                    <h3 class="card-title">
                    <a href="{{app(CustomClass::class)->rootApp()}}/manajemenSubmenu/tambah" class="btn btn-info"><i class='fa fa-plus'></i></a>
                    </h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">

                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr align="center" class="alert-dark">
                                    <th>No.</th>
                                    <th>ID Menu</th>
                                    <th>ID Submenu</th>
                                    <th>Nama Menu</th>
                                    <th>Nama Submenu</th>
                                    <th>Link</th>
                                    <th>Urutan Submenu</th>
                                    <th>Status Data</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $no = 1; @endphp
                                @foreach($stmtListSubmenu as $dataListSubmenu)
                                <tr>
                                    <td align="center">{{ $no++ }}</td>
                                    <td align="center">{{ $dataListSubmenu->id_menu }}</td>
                                    <td align="center">{{ $dataListSubmenu->id }}</td>
                                    <td>{{ app(CustomClass::class)->getNamaMenu($dataListSubmenu->id_menu) }}</td>
                                    <td>{{ $dataListSubmenu->nama }}</td>
                                    <td align="center"><a href="{{ $dataListSubmenu->link }}">{{ $dataListSubmenu->link }}</a></td>
                                    <td align="center">{{ $dataListSubmenu->urutan }}</td>
                                    <td align="center">{{ app(CustomClass::class)->ketStatusData($dataListSubmenu->status_data) }}</td>
                                    <td align="center"><a href="{{app(CustomClass::class)->rootApp()}}/manajemenSubmenu/edit/{{ app(CustomClass::class)->enkrip($dataListSubmenu->id) }}" class="btn btn-info"><i class='fa fa-pen'></i></a>
<!--                                     <a href='{{app(CustomClass::class)->rootApp()}}/manajemenSubmenu/hapus/{{ app(CustomClass::class)->enkrip($dataListSubmenu->id) }}' class='btn btn-danger float-right' onclick="return confirm('Apakah Anda yakin untuk menghapus data ini ?')">
                                        <i class='fa fa-trash'></i>
                                    </a> -->
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
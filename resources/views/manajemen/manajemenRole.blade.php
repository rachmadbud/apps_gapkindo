@extends('layouts.master')
@section('content')

@php
use App\Models\CustomClass;
@endphp

@if($aksesSubMenu != 1)
    @include('errors.405')
@else
    <div class="container-fluid">
        <h3 class="text-black-50">Manajemen Role</h3>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                    <h3 class="card-title">
                    <a href="{{app(CustomClass::class)->rootApp()}}/manajemenRole/tambah" class="btn btn-info"><i class='fa fa-plus'></i></a>
                    </h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">

                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr align="center" class="alert-dark">
                                    <th>No.</th>
                                    <th>Nama Role</th>
                                    <th>Menu</th>
                                    <th>Submenu</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $no = 1;
                                    $noMenu = 1;
                                @endphp

                                @foreach($stmtListRole as $dataListRole)
                                <tr>
                                    <td align="center">{{ $no++ }}</td>
                                    <td align="center">{{ $dataListRole->nama }}</td>
                                    <td align="left">
                                        <ol>
                                        @foreach(explode(',', $dataListRole->id_menu) as $id_menu)
                                            @if($id_menu != 0)
                                            <li>{{ app(CustomClass::class)->getNamaMenu($id_menu) }}</li>
                                            @endif
                                        @endforeach
                                        </ol>
                                    </td>
                                    <td align="left">
                                        <ol>
                                        @foreach(explode(',', $dataListRole->id_submenu) as $id_submenu)
                                            @if($id_submenu != 0)
                                                <li>{{ app(CustomClass::class)->getNamaMenuFromSubmenu($id_submenu) }} &#8594; {{ app(CustomClass::class)->getNamaSubmenu($id_submenu) }}</li>
                                            @endif
                                        @endforeach
                                        </ol>
                                    </td>
                                    <!-- <td align="center">{{ $dataListRole->id_submenu }}</td>
                                    <td align="left">
                                        <ol>
                                        @foreach($stmtListMenu as $dataListMenu)
                                            <li>{{ $dataListMenu->nama }}</li>
                                            @foreach($stmtListSubmenu as $dataListSubmenu)
                                                @if($dataListMenu->id == $dataListSubmenu->id_menu)
                                                    <ul>
                                                        <li>{{ $dataListSubmenu->nama }}</li>
                                                    </ul>
                                                @endif
                                            @endforeach    
                                        @endforeach
                                        </ol>
                                    </td> -->
                                    <td align="center"><a href="{{app(CustomClass::class)->rootApp()}}/manajemenRole/edit/{{ app(CustomClass::class)->enkrip($dataListRole->id) }}" class="btn btn-info"><i class='fa fa-pen'></i></a></td>
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
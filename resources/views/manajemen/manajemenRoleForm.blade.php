@extends('layouts.master')
@section('content')

@php
use App\Models\CustomClass;
@endphp

@if($aksesSubMenu != 1)
    @include('errors.405')
@else
    <div class="card card-dark">
        <div class="card-header">
            <h3 class="card-title"></h3>
        </div>

        @if(count($errors) > 0)
        <div class="card-footer">
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
        @endif

        
        @if(isset($stmtGetRole))
        <form id="quickForm" action="{{app(CustomClass::class)->rootApp()}}/manajemenRole/edit/proses" method="post" enctype="multipart/form-data">
        @else
        <form id="quickForm" action="{{app(CustomClass::class)->rootApp()}}/manajemenRole/tambah/proses" method="post" enctype="multipart/form-data">
        @endif

        {{ csrf_field() }}

        @if(isset($stmtGetRole))
        @foreach($stmtGetRole as $dataGetRole)
        <input type="hidden" name="id" value="{{ $dataGetRole->id }}" class="form-control">
        @endforeach
        @endif

        @foreach($stmtListMenu as $dataListMenu)
        @endforeach

            <div class="card-body">
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Nama Role</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="nama" value="{{ (isset($stmtGetRole)) ? $dataGetRole->nama : '' }}" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Menu</label>
                    <div class="col-sm-3">
                        <ul>
                        @foreach($stmtListMenu as $dataListMenu)
                            <li>
                                <label class="container">
                                    <input type="checkbox" name="id_menu[]" value="{{ $dataListMenu->id }}" 
                                    
                                    @if(isset($stmtGetRole))
                                    @foreach(explode(',', $dataGetRole->id_menu) as $id_menu)
                                        @if($id_menu != 0 && $id_menu == $dataListMenu->id)
                                            checked
                                        @endif
                                    @endforeach
                                    @endif
                                    
                                    >

                                    {{ $dataListMenu->nama }}
                                    <span class="checkmark"></span>
                                </label>
                            </li>
                            @foreach($stmtListSubmenu as $dataListSubmenu)
                                @if($dataListMenu->id == $dataListSubmenu->id_menu)
                                    <ul style='list-style-type:disc;'>
                                        <li>
                                            <label class='container'>
                                            <input type="checkbox" name="id_submenu[]" value="{{ $dataListSubmenu->id }}" 
                                            
                                            @if(isset($stmtGetRole))
                                            @foreach(explode(',', $dataGetRole->id_submenu) as $id_submenu)
                                                @if($id_submenu != 0 && $id_submenu == $dataListSubmenu->id)
                                                    checked
                                                @endif
                                            @endforeach
                                            @endif
                                            
                                            >
                                                {{ $dataListSubmenu->nama }}
                                            <span class='checkmark'></span>
                                            </label>
                                        </li>
                                    </ul>
                                @endif
                            @endforeach
                        @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button type="reset" class="btn btn-default">Reset</button>
                <button type="submit" class="btn btn-primary" name="button" value="submit">{{ (isset($stmtGetRole)) ? 'Update' : 'Submit' }}</button>
                @if(isset($stmtGetRole))
                    <a href='{{app(CustomClass::class)->rootApp()}}/manajemenRole/hapus/{{ app(CustomClass::class)->enkrip($dataGetRole->id) }}' class='btn btn-danger float-right' onclick="return confirm('Apakah Anda yakin untuk menghapus data ini ?')">
                        <i class='fa fa-trash'></i>
                    </a>
                @endif
            </div>
        </form>

    </div>
@endif

@endsection
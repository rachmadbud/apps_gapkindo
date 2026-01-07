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

        
        @if(isset($stmtGetSubmenu))
        <form id="quickForm" action="{{app(CustomClass::class)->rootApp()}}/manajemenSubmenu/edit/proses" method="post" enctype="multipart/form-data">
        @else
        <form id="quickForm" action="{{app(CustomClass::class)->rootApp()}}/manajemenSubmenu/tambah/proses" method="post" enctype="multipart/form-data">
        @endif

        {{ csrf_field() }}
        
        @if(isset($stmtGetSubmenu))
        @foreach($stmtGetSubmenu as $dataGetSubmenu)
        <input type="hidden" name="id" value="{{ $dataGetSubmenu->id }}" class="form-control">
        @endforeach
        @endif

        @foreach($stmtListMenu as $dataListMenu)
        @endforeach

            <div class="card-body">
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Menu</label>
                    <div class="col-sm-3">
                    <select class="custom-select rounded-0" name="id_menu" required>
                        <option value="">--Pilih Menu--</option>
                        @if(isset($stmtGetSubmenu))
                            @foreach($stmtListMenu as $dataListMenu)
                            <option value="{{ $dataListMenu->id }}" {{ ($dataListMenu->id == $dataGetSubmenu->id_menu) ? 'selected' : '' }}>{{ $dataListMenu->nama }}</option>
                            @endforeach
                        @else
                            @foreach($stmtListMenu as $dataListMenu)
                            <option value="{{ $dataListMenu->id }}">{{ $dataListMenu->nama }}</option>
                            @endforeach
                        @endif
                    </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Nama Submenu</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="nama" value="{{ (isset($stmtGetSubmenu)) ? $dataGetSubmenu->nama : '' }}" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Link</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="link" value="{{ (isset($stmtGetSubmenu)) ? $dataGetSubmenu->link : '' }}" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Urutan Submenu</label>
                    <div class="col-sm-3">
                        <input type="number" class="form-control" name="urutan" value="{{ (isset($stmtGetSubmenu)) ? $dataGetSubmenu->urutan : '' }}" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Status Data</label>
                    <div class="col-sm-3">
                    <select class="custom-select rounded-0" name="status_data" required>
                        <option value="">--Pilih Status Data--</option>
                        <option value="1" {{ (isset($stmtGetSubmenu) && $dataGetSubmenu->status_data == 1) ? 'selected' : '' }}>Aktif</option>
                        <option value="0" {{ (isset($stmtGetSubmenu) && $dataGetSubmenu->status_data == 0) ? 'selected' : '' }}>Tidak Aktif</option>
                    </select>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button type="reset" class="btn btn-default">Reset</button>
                <button type="submit" class="btn btn-primary" name="button" value="submit">{{ (isset($stmtGetMenu)) ? 'Update' : 'Submit' }}</button>
                @if(isset($stmtGetSubmenu))
                    @if($cekRoleSubmenu[0]->jum_submenu == 0)
                    <a href='{{app(CustomClass::class)->rootApp()}}/manajemenSubmenu/hapus/{{ app(CustomClass::class)->enkrip($dataGetSubmenu->id) }}' class='btn btn-danger float-right' onclick="return confirm('Apakah Anda yakin untuk menghapus data ini ?')">
                        <i class='fa fa-trash'></i>
                    </a>
                    @else
                    <span class='float-right'>
                        Tidak bisa dihapus karena submenu ini masih digunakan oleh Role lain
                    </span>
                    @endif
                @endif
            </div>
        </form>

    </div>
@endif

@endsection
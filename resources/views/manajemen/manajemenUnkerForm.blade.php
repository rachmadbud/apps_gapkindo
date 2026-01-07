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

        
        @if(isset($stmtGetUnitKerja))
        <form id="quickForm" action="{{app(CustomClass::class)->rootApp()}}/manajemenUnker/edit/proses" method="post" enctype="multipart/form-data">
        @else
        <form id="quickForm" action="{{app(CustomClass::class)->rootApp()}}/manajemenUnker/tambah/proses" method="post" enctype="multipart/form-data">
        @endif

        {{ csrf_field() }}
        
        @if(isset($stmtGetUnitKerja))
        @foreach($stmtGetUnitKerja as $dataGetUnitKerja)
        <input type="hidden" name="id" value="{{ $dataGetUnitKerja->id }}" class="form-control">
        @endforeach
        @endif

            <div class="card-body">
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Nama Unit Kerja</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="nama" value="{{ (isset($dataGetUnitKerja)) ? $dataGetUnitKerja->nama : '' }}" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Singkatan</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="singkatan" value="{{ (isset($dataGetUnitKerja)) ? $dataGetUnitKerja->singkatan : ''}}" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="email" value="{{ (isset($dataGetUnitKerja)) ? $dataGetUnitKerja->email : ''}}" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Status Data</label>
                    <div class="col-sm-3">
                    <select class="custom-select rounded-0" name="status_data" required>
                        <option value="">--Pilih Status Data--</option>
                        @if(isset($stmtGetUnitKerja))
                            @foreach($stmtGetUnitKerja as $dataGetUnitKerja)
                            <option value="1" {{ ($dataGetUnitKerja->status_data == 1) ? 'selected' : '' }}>Aktif</option>
                            <option value="0" {{ ($dataGetUnitKerja->status_data == 0) ? 'selected' : '' }}>Tidak Aktif</option>
                            @endforeach
                        @else
                        <option value="1">Aktif</option>
                        <option value="0">Tidak Aktif</option>
                        @endif
                    </select>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button type="reset" class="btn btn-default">Reset</button>
                <button type="submit" class="btn btn-primary" name="button" value="submit">{{ (isset($stmtGetUnitKerja)) ? 'Update' : 'Submit' }}</button>
                @if(isset($stmtGetUnitKerja))
                    @if($cekRoleMenu[0]->jum_menu == 0)
                    <a href='{{app(CustomClass::class)->rootApp()}}/manajemenUnker/hapus/{{ app(CustomClass::class)->enkrip($dataGetUnitKerja->id) }}' class='btn btn-danger float-right' onclick="return confirm('Apakah Anda yakin untuk menghapus data ini ?')">
                        <i class='fa fa-trash'></i>
                    </a>
                    @else
                    <span class='float-right'>
                        Tidak bisa dihapus karena menu ini masih digunakan oleh Role lain
                    </span>
                    @endif
                @endif
            </div>
        </form>

    </div>
@endif

@endsection
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


    @if(isset($stmtGetLevelJabatan))
    <form id="quickForm" action="{{app(CustomClass::class)->rootApp()}}/manajemenLevelJabatan/edit/proses" method="post"
        enctype="multipart/form-data">
        @else
        <form id="quickForm" action="{{app(CustomClass::class)->rootApp()}}/manajemenLevelJabatan/tambah/proses"
            method="post" enctype="multipart/form-data">
            @endif

            {{ csrf_field() }}

            @if(isset($stmtGetLevelJabatan))
            @foreach($stmtGetLevelJabatan as $dataGetLevelJabatan)
            <input type="hidden" name="id" value="{{ $dataGetLevelJabatan->id }}" class="form-control">
            @endforeach
            @endif

            <div class="card-body">
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Nama Level Jabatan</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="nama"
                            value="{{ (isset($dataGetLevelJabatan)) ? $dataGetLevelJabatan->nama : '' }}" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Hak Akses Jabatan</label>
                    <div class="col-sm-6">
                        <ul>
                            @foreach($stmtListAksesJabatan as $dataListAksesJabatan)
                            <li>
                                <label class="container">
                                    <input type="checkbox" name="id_akses_jabatan[]"
                                        value="{{ $dataListAksesJabatan->id }}" @if(isset($stmtGetLevelJabatan))
                                        @foreach(explode(',', $dataGetLevelJabatan->id_akses_jabatan) as
                                    $id_akses_jabatan)
                                    @if($id_akses_jabatan != 0 && $id_akses_jabatan == $dataListAksesJabatan->id)
                                    checked
                                    @endif
                                    @endforeach
                                    @endif
                                    >
                                    {{ $dataListAksesJabatan->nama }}
                                    <span class="checkmark"></span>
                                </label>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Status Data</label>
                    <div class="col-sm-3">
                        <select class="custom-select rounded-0" name="status_data" required>
                            <option value="">--Pilih Status Data--</option>
                            @if(isset($stmtGetLevelJabatan))
                            @foreach($stmtGetLevelJabatan as $dataGetLevelJabatan)
                            <option value="1" {{ ($dataGetLevelJabatan->status_data == 1) ? 'selected' : '' }}>Aktif
                            </option>
                            <option value="0" {{ ($dataGetLevelJabatan->status_data == 0) ? 'selected' : '' }}>Tidak
                                Aktif
                            </option>
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
                <button type="submit" class="btn btn-primary" name="button"
                    value="submit">{{ (isset($stmtGetLevelJabatan)) ? 'Update' : 'Submit' }}</button>
            </div>
        </form>

</div>
@endif

@endsection
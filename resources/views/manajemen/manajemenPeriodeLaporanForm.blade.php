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

        
        @if(isset($stmtGetPeriodeLaporan))
        <form id="quickForm" action="{{app(CustomClass::class)->rootApp()}}/manajemenPeriodeLaporan/edit/proses" method="post" enctype="multipart/form-data">
        @else
        <form id="quickForm" action="{{app(CustomClass::class)->rootApp()}}/manajemenPeriodeLaporan/tambah/proses" method="post" enctype="multipart/form-data">
        @endif

        {{ csrf_field() }}
        
        @if(isset($stmtGetPeriodeLaporan))
        @foreach($stmtGetPeriodeLaporan as $dataGetPeriodeLaporan)
        <input type="hidden" name="id" value="{{ $dataGetPeriodeLaporan->id }}" class="form-control">
        @endforeach
        @endif

            <div class="card-body">
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Nama Periode Laporan</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="nama" value="{{ (isset($dataGetPeriodeLaporan)) ? $dataGetPeriodeLaporan->nama : '' }}" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Reminder Pertama</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control" name="reminder_1" value="{{ (isset($dataGetPeriodeLaporan)) ? $dataGetPeriodeLaporan->reminder_1 : ''}}" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Reminder Kedua</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control" name="reminder_2" value="{{ (isset($dataGetPeriodeLaporan)) ? $dataGetPeriodeLaporan->reminder_2 : ''}}" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Reminder Ketiga</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control" name="reminder_3" value="{{ (isset($dataGetPeriodeLaporan)) ? $dataGetPeriodeLaporan->reminder_3 : ''}}" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Reminder Keempat</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control" name="reminder_4" value="{{ (isset($dataGetPeriodeLaporan)) ? $dataGetPeriodeLaporan->reminder_4 : ''}}" required>
                    </div>
                </div>
          
            {{-- <div class="form-group row">
                <label class="col-sm-2 col-form-label">Time Reminder</label>
                <div class="col-sm-10">
                    <input type="time" class="form-control" name="time_reminder" value="{{ (isset($dataGetPeriodeLaporan)) ? $dataGetPeriodeLaporan->time_reminder : ''}}" required>
                </div>
            </div> --}}
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Status Data</label>
                    <div class="col-sm-3">
                    <select class="custom-select rounded-0" name="status_data" required>
                        <option value="">--Pilih Status Data--</option>
                        @if(isset($stmtGetPeriodeLaporan))
                            @foreach($stmtGetPeriodeLaporan as $dataGetPeriodeLaporan)
                            <option value="1" {{ ($dataGetPeriodeLaporan->status_data == 1) ? 'selected' : '' }}>Aktif</option>
                            <option value="0" {{ ($dataGetPeriodeLaporan->status_data == 0) ? 'selected' : '' }}>Tidak Aktif</option>
                            @endforeach
                        @else
                        <option value="1">Aktif</option>
                        <option value="0">Tidak Aktif</option>
                        @endif
                    </select>
                    </div>
                </div>
            </div>
        </div>
            <div class="card-footer">
                <button type="reset" class="btn btn-default">Reset</button>
                <button type="submit" class="btn btn-primary" name="button" value="submit">{{ (isset($stmtGetPeriodeLaporan)) ? 'Update' : 'Submit' }}</button>
                @if(isset($stmtGetPeriodeLaporan))
                    <a href='{{app(CustomClass::class)->rootApp()}}/manajemenPeriodeLaporan/hapus/{{ app(CustomClass::class)->enkrip($dataGetPeriodeLaporan->id) }}' class='btn btn-danger float-right' onclick="return confirm('Apakah Anda yakin untuk menghapus data ini ?')">
                        <i class='fa fa-trash'></i>
                    </a>
                @endif
                    {{-- <span class='float-right'>
                        Tidak bisa dihapus karena menu ini masih digunakan oleh Role lain
                    </span> --}}
                    @endif
            
            </div>
        </form>

    </div>


@endsection
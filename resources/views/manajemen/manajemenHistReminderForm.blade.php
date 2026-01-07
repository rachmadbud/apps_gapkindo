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

        
        @if(isset($stmtGetHistReminder))
        <form id="quickForm" action="{{app(CustomClass::class)->rootApp()}}/manajemenHistReminder/edit/proses" method="post" enctype="multipart/form-data">
        @else
        <form id="quickForm" action="{{app(CustomClass::class)->rootApp()}}/manajemenHistReminder/tambah/proses" method="post" enctype="multipart/form-data">
        @endif

        {{ csrf_field() }}
        
        @if(isset($stmtGetHistReminder))
        @foreach($stmtGetHistReminder as $dataGetHistReminder)
        <input type="hidden" name="id" value="{{ $dataGetHistReminder->id }}" class="form-control">
        @endforeach
        @endif

        <div class="card-body">
            <div class="card-body">
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Jenis Laporan</label>
                    <div class="col-sm-3">
                    <select class="custom-select rounded-0" name="id_jenis_laporan" required>
                        <option value="">--Pilih Jenis Laporan--</option>
                        @if(isset($stmtGetHistReminder))
                            @foreach($stmtListJenisLaporan as $dataListJenisLaporan)
                            <option value="{{ $dataListJenisLaporan->id }}" {{ ($dataListJenisLaporan->id == $dataGetHistReminder->id_jenis_laporan) ? 'selected' : '' }}>{{ $dataListJenisLaporan->nama }}</option>
                            @endforeach
                        @else
                            @foreach($stmtListJenisLaporan as $dataListJenisLaporan)
                            <option value="{{ $dataListJenisLaporan->id }}">{{ $dataListJenisLaporan->nama }}</option>
                            @endforeach
                        @endif
                    </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Unit Kerja</label>
                    <div class="col-sm-3">
                    <select class="custom-select rounded-0" name="id_unit_kerja" required>
                        <option value="">--Pilih Unit Kerja--</option>
                        @if(isset($stmtGetHistReminder))
                            @foreach($stmtListUnitKerja as $dataListUnitKerja)
                            <option value="{{ $dataListUnitKerja->id }}" {{ ($dataListUnitKerja->id == $dataGetHistReminder->id_unit_kerja) ? 'selected' : '' }}>{{ $dataListUnitKerja->nama }}</option>
                            @endforeach
                        @else
                            @foreach($stmtListUnitKerja as $dataListUnitKerja)
                            <option value="{{ $dataListUnitKerja->id }}">{{ $dataListUnitKerja->nama }}</option>
                            @endforeach
                        @endif
                    </select>
                    </div>
                </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="email" value="{{ (isset($dataGetHistReminder)) ? $dataGetHistReminder->email : '' }}" required>
                        </div>
                    </div>
                {{-- <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Periode Laporan</label>
                    <div class="col-sm-3">
                    <select class="custom-select rounded-0" name="id_periode_laporan" required>
                        <option value="">--Pilih Periode Laporan--</option>
                        @if(isset($stmtGetJenisLaporan))
                            @foreach($stmtListPeriodeLaporan as $dataListPeriodeLaporan)
                            <option value="{{ $dataListPeriodeLaporan->id }}" {{ ($dataListPeriodeLaporan->id == $dataGetJenisLaporan->id_periode_laporan) ? 'selected' : '' }}>{{ $dataListPeriodeLaporan->nama }}</option>
                            @endforeach
                        @else
                            @foreach($stmtListPeriodeLaporan as $dataListPeriodeLaporan)
                            <option value="{{ $dataListPeriodeLaporan->id }}">{{ $dataListPeriodeLaporan->nama }}</option>
                            @endforeach
                        @endif
                    </select>
                    </div>
                </div> --}}
                     <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Tanggal Jatuh Tempo</label>
                        <div class="col-sm-3">
                            <input type="date" class="form-control" name="tanggal_reminder" value="{{ (isset($dataGetHistReminder)) ? $dataGetHistReminder->tanggal_reminder : '' }}" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Waktu Reminder</label>
                        <div class="col-sm-3">
                            <input type="time" class="form-control" name="time_reminder" value="{{ (isset($dataGetHistReminder)) ? $dataGetHistReminder->time_reminder : '' }}" required>
                        </div>
                    </div>
                
                {{-- <div class="form-group row">
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
            </div> --}}
            <div class="card-footer">
                <button type="reset" class="btn btn-default">Reset</button>
                <button type="submit" class="btn btn-primary" name="button" value="submit">{{ (isset($stmtGetHistReminder)) ? 'Update' : 'Submit' }}</button>
                @if(isset($stmtGetHistReminder))
                    <a href='{{app(CustomClass::class)->rootApp()}}/manajemenJenisLaporan/hapus/{{ app(CustomClass::class)->enkrip($dataGetHistReminder->id) }}' class='btn btn-danger float-right' onclick="return confirm('Apakah Anda yakin untuk menghapus data ini ?')">
                        <i class='fa fa-trash'></i>
                    </a>
                @endif
            </div>
        </form>

    </div>
@endif

@endsection
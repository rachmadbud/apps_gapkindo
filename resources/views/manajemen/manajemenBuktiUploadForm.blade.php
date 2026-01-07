@extends('layouts.master')
@section('content')

    @php
        use App\Models\CustomClass;
    @endphp

    @if ($aksesSubMenu != 1)
        @include('errors.405')
    @else
        <div class="card card-dark">
            <div class="card-header">
                <h3 class="card-title"></h3>
            </div>

            @if (count($errors) > 0)
                <div class="card-footer">
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif


            @if (isset($stmtGetHistLaporan))
                <form id="quickForm" action="{{ app(CustomClass::class)->rootApp() }}/manajemenBuktiUpload/edit/proses"
                    method="post" enctype="multipart/form-data">
                @else
                    <form id="quickForm" action="{{ app(CustomClass::class)->rootApp() }}/manajemenBuktiUpload/tambah/proses"
                        method="post" enctype="multipart/form-data">
            @endif

            {{ csrf_field() }}

            @if (isset($stmtGetHistLaporan))
                @foreach ($stmtGetHistLaporan as $dataGetHistLaporan)
                    <input type="hidden" name="id" value="{{ $dataGetHistLaporan->id }}" class="form-control">
                @endforeach
            @endif

            <div class="card-body">
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Jenis Laporan</label>
                    <div class="col-sm-3">
                        <select class="custom-select rounded-0" name="id_jenis_laporan" required>
                            <option value="">--Pilih Jenis Laporan--</option>
                            @if (isset($stmtGetHistLaporan))
                                @foreach ($stmtListJenisLaporan as $dataListJenisLaporan)
                                    <option value="{{ $dataListJenisLaporan->id }}"
                                        {{ $dataListJenisLaporan->id == $dataGetHistLaporan->id_jenis_laporan ? 'selected' : '' }}>
                                        {{ $dataListJenisLaporan->nama }}</option>
                                @endforeach
                            @else
                                @foreach ($stmtListJenisLaporan as $dataListJenisLaporan)
                                    <option value="{{ $dataListJenisLaporan->id }}">{{ $dataListJenisLaporan->nama }}
                                    </option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Periode</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="datepicker" name="periode"
                            value="{{ isset($dataGetHistLaporan) ? $dataGetHistLaporan->periode : '' }}" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Upload Bukti Kirim</label>
                    <div class="col-sm-10">
                        <input type="file" class="form-control" name="nama_file_bukti_kirim"
                            value="{{ isset($dataGetHistLaporan) ? $dataGetHistLaporan->nama_file_bukti_kirim : '' }}"
                            required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Keterangan</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="keterangan"
                            value="{{ isset($dataGetHistLaporan) ? $dataGetHistLaporan->keterangan : '' }}" required>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="reset" class="btn btn-default">Reset</button>
                    <button type="submit" class="btn btn-primary" name="button"
                        value="submit">{{ isset($stmtGetHistLaporan) ? 'Update' : 'Submit' }}</button>
                    @if (isset($stmtGetHistLaporan))
                        <a href='{{ app(CustomClass::class)->rootApp() }}/manajemenBuktiUploadLaporan/hapus/{{ app(CustomClass::class)->enkrip($dataGetHistLaporan->id) }}'
                            class='btn btn-danger float-right'
                            onclick="return confirm('Apakah Anda yakin untuk menghapus data ini ?')">
                            <i class='fa fa-trash'></i>
                        </a>
                    @endif
                </div>
                </form>

            </div>
    @endif

@endsection

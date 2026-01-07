@extends('layouts.master')
@section('content')
    @php
        use App\Models\CustomClass;
    @endphp
    @if ($aksesSubMenu != 0)
        @include('errors.405')
    @else
        <div class="card card-dark">
            <div class="card-header">
                <h3 class="card-title">Form Surat Keluar</h3>
            </div>

            @if (isset($stmtGetUnitKerja))
                <form id="quickForm" action="{{ app(CustomClass::class)->rootApp() }}/form/suratKeluar/submit" method="post"
                    enctype="multipart/form-data">
                @else
                    <form id="quickForm" action="{{ app(CustomClass::class)->rootApp() }}/form/suratKeluar/submit"
                        method="post" enctype="multipart/form-data">
            @endif

            {{ csrf_field() }}
            <div class="card-body">
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Tanggal</label>
                    <div class="col-sm-4">
                        <input type="date" class="form-control @if ($errors->has('tanggal')) is-invalid @endif "
                            name="tanggal"
                            value="{{ isset($dataGetUnitKerja) ? $dataGetUnitKerja->tanggal : '' }} {{ old('tanggal') }}"
                            required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Nomor Surat</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control @if ($errors->has('nomorSurat')) is-invalid @endif"
                            name="nomorSurat"
                            value="{{ isset($dataGetUnitKerja) ? $dataGetUnitKerja->nomor_surat : '' }} {{ old('nomorSurat') }}"
                            required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Perihal</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control @if ($errors->has('perihal')) is-invalid @endif"
                            name="perihal"
                            value="{{ isset($dataGetUnitKerja) ? $dataGetUnitKerja->perihal : '' }} {{ old('perihal') }}"
                            required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Ditujukan</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control @if ($errors->has('ditujukan')) is-invalid @endif"
                            name="ditujukan"
                            value="{{ isset($dataGetUnitKerja) ? $dataGetUnitKerja->ditujukan : '' }} {{ old('ditujukan') }}"
                            required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Lampiran</label>
                    <div class="col-sm-10">
                        <input type="file" class="form-control @if ($errors->has('lampiran')) is-invalid @endif"
                            name="lampiran" value="{{ isset($dataGetUnitKerja) ? $dataGetUnitKerja->ditujukan : '' }}">
                        <div class="invalid-feedback">
                            @error('lampiran')
                                {{ $message }}
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button type="reset" class="btn btn-default">Reset</button>
                <button type="submit" class="btn btn-primary" name="button"
                    value="submit">{{ isset($stmtGetUnitKerja) ? 'Update' : 'Submit' }}</button>
                @if (isset($stmtGetUnitKerja))
                    @if ($cekRoleMenu[0]->jum_menu == 0)
                        <a href='{{ app(CustomClass::class)->rootApp() }}/manajemenUnker/hapus/{{ app(CustomClass::class)->enkrip($dataGetUnitKerja->id) }}'
                            class='btn btn-danger float-right'
                            onclick="return confirm('Apakah Anda yakin untuk menghapus data ini ?')">
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

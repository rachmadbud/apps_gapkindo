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
                <h3 class="card-title">Form Publikasi</h3>
            </div>

            @if (isset($dataBuletin))
                <form id="quickForm" action="{{ app(CustomClass::class)->rootApp() }}/form/publikasi/edit" method="post"
                    enctype="multipart/form-data">
                    <input type="hidden" name="lampiran_lama" value="{{ $dataBuletin->lampiran }}">
                    <input type="hidden" name="id" value="{{ $dataBuletin->id }}">
                @else
                    <form id="quickForm" action="{{ app(CustomClass::class)->rootApp() }}/form/publikasi/submit"
                        method="post" enctype="multipart/form-data">
            @endif

            {{ csrf_field() }}
            <div class="card-body">
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Tanggal</label>
                    <div class="col-sm-10">
                        <input type="date" class="form-control @if ($errors->has('tanggal')) is-invalid @endif"
                            name="tanggal" placeholder="Tanggal"
                            value="{{ old('tanggal', isset($dataBuletin) ? $dataBuletin->tanggal : '') }}" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Judul</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control @if ($errors->has('judul')) is-invalid @endif"
                            name="judul" placeholder="Judul"
                            value="{{ old('judul', isset($dataBuletin) ? $dataBuletin->judul : '') }}" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Lampiran</label>
                    <div class="col-sm-10">
                        <input type="file" class="form-control @if ($errors->has('lampiran')) is-invalid @endif"
                            name="lampiran">
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
                    value="update">{{ isset($stmtGetUnitKerja) ? 'Update' : 'Submit' }}</button>
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

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


    <form id="quickForm" action="{{app(CustomClass::class)->rootApp()}}/manajemenSekuritiProses" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}

        <div class="card-body">
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Panjang Password Minimum</label>
                <div class="col-sm-10">
                    <div class="row">
                        <div class="col-sm-1">
                            <input type="number" class="form-control" name="min_pass" value="{{ config('secure.APP_SEKURITI_LENGTH_PASS_MIN') }}" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-10">
                            <small class="form-text text-muted">Jumlah karakter minimal ketika pembuatan password</small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Maksimal Kesalahan Login</label>
                <div class="col-sm-10">
                    <div class="row">
                        <div class="col-sm-1">
                            <input type="number" class="form-control" name="max_fail_login" value="{{ config('secure.APP_SEKURITI_FAIL_LOGIN') }}" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-10">
                            <small class="form-text text-muted">Jumlah maksimal kesalahan login yang dilakukan sebelum user di blokir</small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Lama Expired Password</label>
                <div class="col-sm-10">
                    <div class="row">
                        <div class="col-sm-1">
                            <input type="number" class="form-control" name="exp_pass" value="{{ config('secure.APP_SEKURITI_PASSWORD_EXP') }}" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-10">
                            <small class="form-text text-muted">Lamanya sebuah password menjadi usang (*dalam bulan)</small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Session Timeout</label>
                <div class="col-sm-10">
                    <div class="row">
                        <div class="col-sm-1">
                            <input type="number" class="form-control" name="session_timeout" value="{{ config('secure.APP_SEKURITI_SESSION_TIME') }}" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-10">
                            <small class="form-text text-muted">Lamanya durasi sebuah session (*dalam menit)</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary" name="button" value="submit">Update</button>
        </div>
    </form>

</div>
@endif

@endsection
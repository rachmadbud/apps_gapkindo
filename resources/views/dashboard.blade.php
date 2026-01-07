@extends('layouts.master')
@section('title', 'Dashboard')
@section('content')

@php
use App\Models\CustomClass;
@endphp

@if($aksesMenu != 1)
@include('errors.405')
@else

<div class="container-fluid">

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                Dashboard
            </h3>
        </div>
        <div class="card-body">
            <div class="row">
            </div>
        </div>
    </div>

</div>

@endif

@endsection
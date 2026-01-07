@extends('layouts.master')
@section('content')

@php
use App\Models\CustomClass;
@endphp

@if($aksesSubMenu != 1)
    @include('errors.405')
@else
    <div class="container-fluid">
        <h3 class="text-black-50">User Log Activiy</h3>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                    <h3 class="card-title">
                    {{-- <a href="/manajemenUnker/tambah" class="btn btn-info"><i class='fa fa-plus'></i></a> --}}
                    </h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">

                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr align="center" class="alert-dark">
                                    <th>No.</th>
                                    <th>IP Address</th>
                                    <th>User</th>
                                    <th>Activity Content</th>
                                    <th>Url</th>
                                    <th>User Agent</th>
                                    <th>Method</th>
                                    <th>Date Time</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $no = 1; @endphp
                                @foreach($stmtListUserLog as $dataListUserLog)
                                <tr>
                                    <td align="center">{{ $no++ }}</td>
                                    <td align="center">{{ $dataListUserLog->ip_access }}</td>
                                    <td align="center">{{ app(CustomClass::class)->getNamaUser($dataListUserLog->id_user) }}</td>
                                    {{-- <td align="center">{{ $dataListUserLog->id_user }}</td> --}}
                                    <td align="center">{{ $dataListUserLog->activity_content }}</td>
                                    <td align="center">{{ $dataListUserLog->url }}</td>
                                    <td align="center">{{ $dataListUserLog->user_agent }}</td>
                                    <td align="center">{{ $dataListUserLog->method }}</td>
                                    <td align="center">{{ $dataListUserLog->date_time }}</td>
                                    {{-- <td align="left">{{ $dataListMasterUnitKerja->status_data }}</td> --}}
                                    {{-- <td align="center">{{ app(CustomClass::class)->ketStatusData($dataListUnker->status_data) }}</td> --}}
                                    {{-- <td align="center">{{ app(CustomClass::class)->getNamaUnitKerja($dataListUser->id_unit_kerja) }}</td> --}}
                                    {{-- <td align="center"><a href="/manajemenUnker/edit/{{ app(CustomClass::class)->enkrip($dataListUnker->id) }}" class="btn btn-info"><i class='fa fa-pen'></i></a></td> --}}
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>

                    <!-- /.card-body -->
                </div>
            </div>
        </div>

    </div>
@endif

@endsection
@extends('layouts.master')
@section('content')
    @php
        use App\Models\CustomClass;
    @endphp

    @if ($aksesMenu != 0)
        @include('errors.405')
    @else
        <div class="container-fluid">
            <h3 class="text-black-50">Manajemen Form</h3>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                <a href="{{ app(CustomClass::class)->rootApp() }}/form/suratMasuk" class="btn btn-info"><i
                                        class='fa fa-plus'></i></a>
                            </h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">

                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr align="center" class="alert-dark">
                                        <th>No.</th>
                                        <th>Tanggal</th>
                                        <th>Email</th>
                                        <th>Tantangan</th>
                                        <th>Usulan/Solusi/Harapan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($dataForm as $forms)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ \Carbon\Carbon::parse($forms->created_at)->format('d-m-Y') }}</td>
                                            <td>{!! $forms->email !!}</td>
                                            <td>{!! $forms->permasalahan !!}</td>
                                            <td>{!! $forms->harapan !!}</td>
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

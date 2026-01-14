@extends('layouts.master')
@section('content')
    <style>
        .hover-underline:hover {
            text-decoration: underline;
            color: #007bff;
            /* warna primary AdminLTE */
        }
    </style>
    @php
        use App\Models\CustomClass;
    @endphp

    @if ($aksesMenu != 1)
        @include('errors.405')
    @else
        <div class="container-fluid">
            <h3 class="text-black-50">Data Karet Alam</h3>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            I. STATISTIK KARET ALAM
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr class="alert-dark">
                                        <th>No.</th>
                                        <th>Data</th </tr>
                                </thead>
                                <tbody>
                                    @foreach ($dataStatistikKaret as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td><a href="{{ $item->links }}" class="text-dark text-decoration-none">
                                                    <h6 class="font-weight-bold mb-0 hover-underline">
                                                        {{ $item->tabel }}
                                                    </h6>
                                                </a></td>
                                            </h6>
                                            </a></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- /.card-body -->
                    </div>
                </div>
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            Data Example
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example3" class="table table-bordered table-striped">
                                <thead>
                                    <tr align="center" class="alert-dark">
                                        <th>No.</th>
                                        <th>Tanggal</th>
                                        <th>Nomor Agenda</th>
                                        <th>Nomor Surat</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>01-01-2024</td>
                                        <td>AGD-001</td>
                                        <td>NS-001</td>
                                    </tr>
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

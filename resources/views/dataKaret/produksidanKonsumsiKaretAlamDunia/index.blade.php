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

    @if ($aksesMenu != 0)
        @include('errors.405')
    @else
        <div class="container-fluid">
            <h3 class="text-black-50">Data Karet Alam</h3>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title font-weight-bold">Produksi dan Konsumsi Karet Alam Dunia</h3>
                            <br>
                            <div class="col-md-6">
                                <form action="{{ app(CustomClass::class)->rootApp() }}/produksidanKonsumsiKaretAlamDuniaPost"
                                    method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <p>Update <code>apabila ada perubahan data</code></p>
                                    <div class="input-group input-group-sm">
                                        <input type="file" class="form-control" name="csv_file" required>
                                        <span class="input-group-append">
                                            <button type="submit" class="btn btn-info btn-flat">upload !</button>
                                        </span>
                                    </div>
                                </form>
                                <p><code>Download file sample (.csv) <a
                                            href="{{ app(CustomClass::class)->rootApp() }}/download-sample-produksi-konsumsi-karet">di
                                            sini</a></code></p>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr class="alert-dark">
                                        <th>No.</th>
                                        <th>Tahun</th>
                                        <th>Produksi (000 ton)</th>
                                        <th>Pertmb (%)</th>
                                        <th>Konsumsi (000 ton)</th>
                                        <th>Pertmb (%)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($stmtDataKaretKonnsumsiDunia as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->tahun }}</td>
                                            <td>{{ CustomClass::formatRibuan($item->produksi_ton) }}</td>
                                            <td>{{ $item->pertumbuhan_produksi_ton_persentase }}</td>
                                            <td>{{ CustomClass::formatRibuan($item->konsumsi_ton) }}</td>
                                            <td>{{ $item->pertumbuhan_konsumsi_ton_persentase }}</td>
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

@extends('layouts.master')
@section('content')
    @php
        use App\Models\CustomClass;
    @endphp

    @if ($aksesSubMenu != 1)
        @include('errors.405')
    @else
        <div class="container-fluid">
            <h3 class="text-black-50">Manajemen Surat Keluar</h3>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                <a href="{{ app(CustomClass::class)->rootApp() }}/form/suratKeluar" class="btn btn-info"><i
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
                                        <th>No Surat</th>
                                        <th>Perihal</th>
                                        <th>Tujukan</th>
                                        <th>Lampiran</th>
                                        <th>created_by</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($dataSurat as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->tanggal }}</td>
                                            <td>{{ $item->nomor_surat }}</td>
                                            <td>{{ $item->perihal }}</td>
                                            <td>{{ $item->ditujukan }}</td>
                                            <td><a href="{{ app(CustomClass::class)->rootApp() }}/suratKeluar/lampiran/{{ $item->lampiran }}"
                                                    target="_blank" class="mailbox-attachment-name text-primary"><i
                                                        class="fas fa-paperclip"></i><u> Lampiran</u></a></td>
                                            <td>{{ $item->created_by }}</td>
                                            <td align="center"><a href="/suratMasuk/edit/" class="btn btn-warning"><i
                                                        class='fa fa-pen'></i></a></td>
                                            </td>
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

@extends('layouts.master')
@section('content')
    @php
        use App\Models\CustomClass;
    @endphp

    @if ($aksesSubMenu != 1)
        @include('errors.405')
    @else
        <div class="container-fluid">
            <h3 class="text-black-50">Manajemen Surat Masuk</h3>

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
                                        <th>Nomor Agenda</th>
                                        <th>Nomor Surat</th>
                                        <th>Pengirim</th>
                                        <th>Perihal</th>
                                        <th>Lampiran</th>
                                        <th>created_by</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($dataSurat as $item)
                                        <tr>
                                            <td align="center">{{ $loop->iteration }}</td>
                                            <td>{{ app(CustomClass::class)->formatTanggalIndo($item->tanggal_surat) }}</td>
                                            <td>{{ $item->nomor_agenda }}</td>
                                            <td>{{ $item->nomor_surat }}</td>
                                            <td>{{ $item->pengirim }}</td>
                                            <td>{{ $item->perihal }}</td>
                                            <td><a href="{{ app(CustomClass::class)->rootApp() }}/suratMasuk/lampiran/{{ $item->file_surat }}"
                                                    target="_blank" class="mailbox-attachment-name text-primary"><i
                                                        class="fas fa-paperclip"></i><u> Lampiran</u></a></td>
                                            <td>{{ $item->created_by }}</td>
                                            <td align="center"><a href="/suratMasuk/edit/" class="btn btn-info"><i
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

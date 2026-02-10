@extends('layouts.master')
@section('content')
    @php
        use App\Models\CustomClass;
    @endphp

    @if ($aksesSubMenu != 0)
        @include('errors.405')
    @else
        <div class="container-fluid">
            <h3 class="text-black-50">Volume Ekspor Berdasarkan Negara Produsen</h3>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-info" data-toggle="modal" data-target="#exampleModal">
                                    <i class='fa fa-plus'></i>
                                </button>
                            </h3>

                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form
                                            action="{{ app(CustomClass::class)->rootApp() }}/expor/volumeEksporBerdasarkanNegaraProdusen/upload"
                                            method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Upload Data</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label for="tahun">Tahun</label>
                                                    <input type="text" name="tahun" class="form-control" id="tahun"
                                                        aria-describedby="emailHelp">
                                                </div>
                                                <div class="form-group">
                                                    <label for="reriode">Periode</label>
                                                    <input type="text" name="periode" class="form-control"
                                                        id="reriode">
                                                </div>
                                                <div class="form-group">
                                                    <label for="reriode">File</label>
                                                    <input type="file" name="file" class="form-control"
                                                        id="file">
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Tututp</button>
                                                <button type="submit" class="btn btn-primary">Simpan</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">

                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr align="center" class="alert-dark">
                                        <th>No.</th>
                                        <th>Tahun</th>
                                        <th>Periode</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td align="center">{{ $item->tahun }}</td>
                                            <td align="center">{{ $item->periode }}</td>
                                            <td align="center">
                                                <a href="/fileExcel/{{ app(CustomClass::class)->enkrip($item->id) }}"
                                                    target="_blank" class="btn btn-secondary" title="lihat"><i
                                                        class='fa fa-eye'></i>
                                                </a>
                                                <a href="/fileExcel/{{ $item->file }}" target="_blank"
                                                    class="btn btn-info" title="download"><i class='fa fa-download'></i>
                                                </a>
                                                <button type="button" class="btn btn-warning" data-toggle="modal"
                                                    data-target="#exampleModal{{ $item->id }}" title="edit">
                                                    <i class='fa fa-edit'></i>
                                                </button>
                                                <!-- Modal -->
                                            </td>
                                            </td>
                                        </tr>
                                        <!-- Modal -->
                                        <div class="modal fade" id="exampleModal{{ $item->id }}" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <form
                                                        action="{{ app(CustomClass::class)->rootApp() }}/volumeEksporBerdasarkanNegaraProdusen/update/{{ app(CustomClass::class)->enkrip($item->id) }}"
                                                        method="POST" enctype="multipart/form-data">
                                                        @method('PUT')
                                                        @csrf
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Upload
                                                                Data {{ $item->id }}</h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="form-group">
                                                                <label for="tahun">Tahun</label>
                                                                <input type="text" name="tahun" class="form-control"
                                                                    id="tahun" value="{{ $item->tahun }}"
                                                                    aria-describedby="emailHelp">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="reriode">Periode</label>
                                                                <input type="text" name="periode" class="form-control"
                                                                    id="reriode" value="{{ $item->periode }}">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="reriode">File</label>
                                                                <input type="file" name="file" class="form-control"
                                                                    id="file">
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">Tututp</button>
                                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
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

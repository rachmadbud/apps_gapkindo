@extends('layouts.master')
@section('content')
    @php
        use App\Models\CustomClass;
    @endphp

    @if ($aksesSubMenu != 1)
        @include('errors.405')
    @else
        <div class="container-fluid">
            <h3 class="text-black-50">Buletin Karet Alam </h3>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                <a href="{{ app(CustomClass::class)->rootApp() }}/form/buletin" class="btn btn-info"><i
                                        class='fa fa-plus'></i></a>
                            </h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr align="center" class="alert-dark">
                                        <th>No.</th>
                                        <th>Edisi</th>
                                        <th>Lampiran</th>
                                        <th>Uploaded by</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($dataBuletin as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->edisi }}</td>
                                            <td><a href="{{ asset('buletin/lampiran/' . $item->lampiran) }}" target="_blank"
                                                    class="mailbox-attachment-name text-primary"><i
                                                        class="fas fa-paperclip"></i><u> Lampiran</u></a></td>
                                            <td>{{ $item->uploaded_by }}</td>
                                            <td align="center"><a
                                                    href="{{ app(CustomClass::class)->rootApp() }}/buletin/edit/{{ app(CustomClass::class)->enkrip($item->id) }}"
                                                    class="btn btn-warning"><i class='fa fa-pen'></i></a></td>
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

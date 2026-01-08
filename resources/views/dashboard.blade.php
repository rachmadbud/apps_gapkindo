@extends('layouts.master')
@section('title', 'Dashboard')
@section('content')

    @php
        use App\Models\CustomClass;
    @endphp

    @if ($aksesMenu != 1)
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
                    <!-- Small boxes (Stat box) -->
                    <div class="row">
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-info">
                                <div class="inner">
                                    <h3>{{ $stmtSuratMasuk }}</h3>

                                    <p>Surat Masuk</p>
                                </div>
                                <div class="icon">
                                    {{-- <i class="ion ion-stats-bars"></i> --}}
                                    <i class="fas fa-file-import"></i>
                                </div>
                                <a href="{{ app(CustomClass::class)->rootApp() }}/suratMasukx" class="small-box-footer">More
                                    info <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-success">
                                <div class="inner">
                                    <h3>{{ $stmtSuratKeluar }}</h3>

                                    <p>Surat Keluar</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-file-export"></i>
                                </div>
                                <a href="{{ app(CustomClass::class)->rootApp() }}/suratKeluarx"
                                    class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-warning">
                                <div class="inner">
                                    <h3>00</h3>

                                    <p>Soon</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-person-add"></i>
                                </div>
                                <a href="#" class="small-box-footer">More info <i
                                        class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-danger">
                                <div class="inner">
                                    <h3>00</h3>

                                    <p>Soon</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-pie-graph"></i>
                                </div>
                                <a href="#" class="small-box-footer">More info <i
                                        class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- ./col -->
                    </div>
                    <!-- /.row -->
                </div>
            </div>

        </div>
    @endif

@endsection

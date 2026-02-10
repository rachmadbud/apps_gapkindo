@extends('layouts.master')
@section('content')
    <style>
        .hover-underline:hover {
            text-decoration: underline;
            color: #007bff;
            /* warna primary AdminLTE */
        }

        a.link-nonaktif {
            text-decoration: line-through;
            /* garis coret */
            color: #999;
            /* abu-abu */
            pointer-events: none;
            /* tidak bisa diklik */
            cursor: not-allowed;
            /* kursor tanda dilarang */
        }
    </style>
    @php
        use App\Models\CustomClass;
    @endphp

    @if ($aksesMenu != 1)
        @include('errors.405')
    @else
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Data Industri Perkaretan</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Data Industri Perkaretan</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">

                <!-- Timelime example  -->
                <div class="row">
                    <div class="col-md-12">
                        <!-- The time line -->
                        <div class="timeline">
                            <!-- timeline time label -->
                            <div class="time-label">
                                <span class="bg-white">DATA INDUSTRI PERKARETAN NASIONAL</span>
                            </div>
                            <!-- /.timeline-label -->
                            <!-- timeline item -->
                            <div>
                                <i class="fas fa-arrow-right"></i>
                                <div class="timeline-item">
                                    <h3 class="timeline-header"><a href="#">A. </a>KEBUN DAN PROFILE KEBUN (Sumber:
                                        Statistik Perkebunan, Direktorat Jenderal Perkebunan)
                                    </h3>

                                    <div class="timeline-body">
                                        <a href="http://" class="link-nonaktif">1. Luas areal
                                            berdasarkan provinsi dan
                                            kabupaten</a>
                                        <br>
                                        <a href="http://" class="link-nonaktif">2. Luas areal berdasarkan satus pengusahaan
                                            (perkebunan
                                            rakyat,negara, swasta)</a> <br>
                                        <a href="http://" class="link-nonaktif">3. Luas areal berdasaarkan status tanman
                                            (tanaman
                                            menghasilkan,tanaman belum menghasilkan, tanamana tua dan rusak)</a> <br>
                                        <a href="http://" class="link-nonaktif">4. Produksi berdasarkan provinsi dan
                                            kabupaten</a> <br>
                                        <a href="http://" class="link-nonaktif">5. Produksi berdasarkan satus pengusahaan
                                            (perkebunan rakyat,
                                            negara, swasta)
                                        </a> <br>
                                        <a href="http://" class="link-nonaktif">6. Produktivitas berdasarkan provinsi dan
                                            kabupaten</a> <br>
                                        <a href="http://" class="link-nonaktif">7. Produktivitas berdasarkan satus
                                            pengusahaan (perkebunan rakyat,
                                            perkebunan negara, perkebunan swasta)</a> <br>
                                    </div>
                                </div>
                            </div>
                            <!-- END timeline item -->

                            <div>
                                <i class="fas fa-arrow-right bg-blue"></i>
                                <div class="timeline-item">
                                    <h3 class="timeline-header"><a href="#">B. </a>KEBUN DAN PROFILE KEBUN (Sumber:
                                        Statistik Perkebunan, Direktorat Jenderal Perkebunan)
                                    </h3>

                                    <div class="timeline-body">
                                        <a href="http://" class="link-nonaktif">1. Jumlah kelompok tani karet berdasarkan
                                            provinsi</a> <br>
                                        <a href="http://" class="link-nonaktif">2. Jumlah unit UPPB (Unit Pengolahan dan
                                            Pemasaran Bokar)
                                            berdasarkan provinsi</a> <br>
                                        <a href="http://" class="link-nonaktif">3. Jumlah koperasi petani karet berdasarkan
                                            provinsi</a> <br>
                                        <a href="http://" class="link-nonaktif">4. Jumlah unit pasar lelang berdasarkan
                                            provinsi dan lokasi
                                            unitnya
                                        </a> <br>
                                    </div>
                                </div>
                            </div>
                            <!-- END timeline item -->

                            <div>
                                <i class="fas fa-arrow-right bg-blue"></i>
                                <div class="timeline-item">
                                    <h3 class="timeline-header"><a href="#">C. </a>UNIT PENGOLAHAN KARET: crumb rubber
                                        (SIR), ribed smoked Sheet (RSS) dan lateks pekat (Sumber: GAPKINDO)
                                    </h3>

                                    <div class="timeline-body">
                                        <a href="http://" class="link-nonaktif">1. Daftar pabrik crumb rubber, RSS dan
                                            lateks pekat berdasarkan
                                            kabupaten, provinsi: nama perusahaan, kapasitas, lokasi pabrik, TPP untuk
                                            SIR</a> <br>
                                        <a href="http://" class="link-nonaktif">2. Daftar dinamika pabrik beroperasi dan
                                            stop operasi</a> <br>
                                        <a href="http://" class="link-nonaktif">3. Produksi, penjualan ekspor, penjualan
                                            dalam negeri, stok
                                        </a> <br>
                                    </div>
                                </div>
                            </div>
                            <!-- END timeline item -->

                            <div>
                                <i class="fas fa-arrow-right bg-blue"></i>
                                <div class="timeline-item">
                                    <h3 class="timeline-header"><a href="#">D. </a>EKSPOR DAN IMPOR (Sumber: Badan
                                        Pusat Statistik)
                                    </h3>

                                    <div class="timeline-body">
                                        <a
                                            href="{{ app(CustomClass::class)->rootApp() }}/ekspor-dan-impor-berdasarkan-kode-hs">1.
                                            Ekspor berasakran kode HS</a> <br>
                                        <a
                                            href="{{ app(CustomClass::class)->rootApp() }}/ekspor-berdasarkan-pelabuhan-ekspor">2.
                                            Ekspor Berdasarkan Pelabuhan Ekspor</a>
                                        <br>
                                        <a href="{{ app(CustomClass::class)->rootApp() }}/ekspor-berdasarkan-negara-tujuan">3.
                                            Ekspor berdasarkan negara tujuan</a> <br>
                                        <a href="http://" class="link-nonaktif">4. Impor berdasarkan kode HS</a> <br>
                                        <a href="http://" class="link-nonaktif">5. Impor berdasarkan negara asal </a> <br>
                                        <a href="http://" class="link-nonaktif">6. Impor berdasarkan pelabuhan
                                            kedatangan</a> <br>
                                    </div>
                                </div>
                            </div>
                            <!-- END timeline item -->

                            <div>
                                <i class="fas fa-arrow-right bg-blue"></i>
                                <div class="timeline-item">
                                    <h3 class="timeline-header"><a href="#">E. </a>DATA DINAMIKS HARGA BAHAN OLAH
                                        KARET (Sumber: Hasil Lelang di UPPB)
                                    </h3>

                                    <div class="timeline-body">
                                        <a href="http://" class="link-nonaktif">1. Tanggal transaksi lelang</a> <br>
                                        <a href="http://" class="link-nonaktif">2. Nama UPPB </a> <br>
                                        <a href="http://" class="link-nonaktif">3. Alamat UPPB</a> <br>
                                        <a href="http://" class="link-nonaktif">4. Status bokar (mingguan, dua mingguan,
                                            bulanan)</a> <br>
                                        <a href="http://" class="link-nonaktif">5. Harga tertinggi sebagai pemenang
                                            lelang</a> <br>
                                    </div>
                                </div>
                            </div>
                            <!-- END timeline item -->
                            <div>
                                <i class="fas fa-arrow-right bg-blue"></i>
                                <div class="timeline-item">
                                    <h3 class="timeline-header"><a href="#">F. </a>PERKEBANGAN HARGA DI BURSA (Sumber:
                                        SICOM Futures)
                                    </h3>

                                    <div class="timeline-body">
                                        <a href="http://" class="link-nonaktif">1. Data harga harian (setlemen price) untuk
                                            jenis TSR 20</a> <br>
                                        <a href="http://" class="link-nonaktif">2. Data harga harian (setlemen price) untuk
                                            jenis RSS 3</a> <br>
                                        <a href="http://" class="link-nonaktif">3. Volume lot yang ditransaksikan untuk
                                            jenis TSR 20</a> <br>
                                        <a href="http://" class="link-nonaktif">4. Volume lot yang ditransaksikan untuk
                                            jenis RSS 3</a> <br>
                                    </div>
                                </div>
                            </div>
                            <!-- END timeline item -->

                            <!-- timeline time label -->
                            <div class="time-label">
                                <span class="bg-white">DATA INDUSTRI PERKARETAN GLOBAL</span>
                            </div>
                            <!-- /.timeline-label -->
                            <!-- timeline item -->
                            <div>
                                <i class="fas fa-arrow-right bg-blue"></i>
                                <div class="timeline-item">
                                    <h3 class="timeline-header"><a href="#">A. </a>Luas, Produksi dan Produktivitas
                                    </h3>

                                    <div class="timeline-body">
                                        <a href="http://" class="link-nonaktif">1. Luas areal perkebunan karet berdasarkan
                                            negara produsen</a>
                                        <a href="http://" class="link-nonaktif">2. Produksi karet berdasarkan negara
                                            produsen: TSR, RSS, Lateks
                                            Pekat, dll</a>
                                        <a href="http://" class="link-nonaktif">3. Produktivitas perkebunan karet
                                            berdasarkan negara produsen</a>
                                        <br>
                                    </div>
                                </div>
                            </div>
                            <!-- END timeline item -->

                            <div>
                                <i class="fas fa-arrow-right bg-blue"></i>
                                <div class="timeline-item">
                                    <h3 class="timeline-header"><a href="#">B. </a>Ekspor

                                    </h3>

                                    <div class="timeline-body">
                                        <a
                                            href="{{ app(CustomClass::class)->rootApp() }}/volumeEksporBerdasarkanNegaraProdusen">1.
                                            Volume ekspor
                                            berdasarkan negara produsen</a> <br>
                                        <a href="http://" class="link-nonaktif">2. Negara tujuan ekspor berdasarkan negara
                                            produsen</a>
                                    </div>
                                </div>
                            </div>
                            <!-- END timeline item -->

                            <div>
                                <i class="fas fa-arrow-right bg-blue"></i>
                                <div class="timeline-item">
                                    <h3 class="timeline-header"><a href="#">C. </a>Kunsumsi</h3>

                                    <div class="timeline-body">
                                        <a href="http://" class="link-nonaktif">1. Konsumsi karet alam berdasarkan negara
                                            konsumen</a> <br>
                                        <a href="http://" class="link-nonaktif">2. INDUSTRI PENGGUNA KARET ALAM</a> <br>
                                    </div>
                                </div>
                            </div>
                            <!-- END timeline item -->

                            <div>
                                <i class="fas fa-arrow-right bg-blue"></i>
                                <div class="timeline-item">
                                    <h3 class="timeline-header"><a href="#">D. </a>INDUSTRI PENGGUNA KARET ALAM</h3>

                                    <div class="timeline-body">
                                        <a href="http://" class="link-nonaktif">1. Daftar pabrik ban dan nama perusahaan
                                            serta kapasitas
                                            pabrik</a> <br>
                                        <a href="http://" class="link-nonaktif">2. Daftar perusahaan lain pengguna karet
                                            alam di luar ban yang
                                            cukup signifikan</a> <br>
                                    </div>
                                </div>
                            </div>
                            <!-- END timeline item -->
                        </div>
                    </div>
                    <!-- /.col -->
                </div>
            </div>
            <!-- /.timeline -->

        </section>
        <!-- /.content -->
    @endif
@endsection

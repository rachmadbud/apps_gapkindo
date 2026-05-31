<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('masaspptsni', function (Blueprint $table) {
            $table->id();
            $table->string('cabang')->nullable();
            $table->string('name')->nullable();
            $table->string('no_spptsni')->nullable();
            $table->date('tgl_awal')->nullable();
            $table->date('tgl_akhir')->nullable();
            $table->timestamp('reminder_sent_at')->nullable();
            $table->string('reminder_status')->nullable();
            $table->timestamps();
        });

        DB::table('masaspptsni')->insert(['cabang' => 'Sumatera Utara',  'name' => 'PT Abaisiat Raya', 'no_spptsni' => 'JPA 009 098', 'tgl_awal' => '2025-12-04', 'tgl_akhir' => '2029-12-04']);
        DB::table('masaspptsni')->insert(['cabang' => 'Sumatera Utara',  'name' => 'PT Anugrah Sibolga Lestari', 'no_spptsni' => 'JPA 009 194', 'tgl_awal' => '2025-10-24', 'tgl_akhir' => '2029-10-23']);
        DB::table('masaspptsni')->insert(['cabang' => 'Sumatera Utara',  'name' => 'PT Bakrie Sumatera Plantations Tbk', 'no_spptsni' => 'JPA 009 197', 'tgl_awal' => '2022-01-20', 'tgl_akhir' => '2026-01-19']);
        DB::table('masaspptsni')->insert(['cabang' => 'Sumatera Utara',  'name' => 'PT Bridgestone Sumatra Rubber Estate', 'no_spptsni' => 'JPA 009 201', 'tgl_awal' => '2026-02-18', 'tgl_akhir' => '2030-02-17']);
        DB::table('masaspptsni')->insert(['cabang' => 'Sumatera Utara',  'name' => 'PT Darmasindo Intikaret', 'no_spptsni' => 'JPA 009 154', 'tgl_awal' => '2026-02-23', 'tgl_akhir' => '2030-02-22']);
        DB::table('masaspptsni')->insert(['cabang' => 'Sumatera Utara',  'name' => 'PT Family Raya', 'no_spptsni' => 'JPA 009 146', 'tgl_awal' => '2026-02-23', 'tgl_akhir' => '2030-02-22']);
        DB::table('masaspptsni')->insert(['cabang' => 'Sumatera Utara',  'name' => 'PT Kapuas Besar', 'no_spptsni' => 'JPA 009 133', 'tgl_awal' => '2025-02-25', 'tgl_akhir' => '2029-02-24']);
        DB::table('masaspptsni')->insert(['cabang' => 'Sumatera Utara',  'name' => 'PT Kilang Lima Gunung', 'no_spptsni' => 'JPA 009 148', 'tgl_awal' => '2022-04-19', 'tgl_akhir' => '2026-04-18']);
        DB::table('masaspptsni')->insert(['cabang' => 'Sumatera Utara',  'name' => 'PT Kirana Sapta', 'no_spptsni' => '824 260019', 'tgl_awal' => '2026-03-04', 'tgl_akhir' => '2031-03-03']);
        DB::table('masaspptsni')->insert(['cabang' => 'Sumatera Utara',  'name' => 'PT Madjin Crumb Rubber Factory', 'no_spptsni' => 'JPA 009 153', 'tgl_awal' => '2026-02-18', 'tgl_akhir' => '2030-02-17']);
        DB::table('masaspptsni')->insert(['cabang' => 'Sumatera Utara',  'name' => 'PT Nusira', 'no_spptsni' => '824 260022', 'tgl_awal' => '2026-03-02', 'tgl_akhir' => '2031-03-01']);
        DB::table('masaspptsni')->insert(['cabang' => 'Sumatera Utara',  'name' => 'PT PP London Sumatra Indonesia Tbk - P. Isang', 'no_spptsni' => 'JPA 009 020', 'tgl_awal' => '2023-03-28', 'tgl_akhir' => '2027-03-27']);
        DB::table('masaspptsni')->insert(['cabang' => 'Sumatera Utara',  'name' => 'PT PP London Sumatra Indonesia Tbk - S. Rumbiya', 'no_spptsni' => 'JPA 009 002', 'tgl_awal' => '2024-01-25', 'tgl_akhir' => '2028-01-24']);
        DB::table('masaspptsni')->insert(['cabang' => 'Sumatera Utara',  'name' => 'PT Pantja Surya', 'no_spptsni' => '824 220059', 'tgl_awal' => '2022-06-06', 'tgl_akhir' => '2026-06-05']);
        DB::table('masaspptsni')->insert(['cabang' => 'Sumatera Utara',  'name' => 'PT Perkebunan Nusantara-IV Regional-1 - G. Para', 'no_spptsni' => '138/S/RE/B/II/.2/2015', 'tgl_awal' => '2022-11-22', 'tgl_akhir' => '2027-02-21']);
        DB::table('masaspptsni')->insert(['cabang' => 'Sumatera Utara',  'name' => 'PT Perkebunan Nusantara-IV Regional-1 - M. Muda', 'no_spptsni' => '136/S/RE/B/II/.2/2015', 'tgl_awal' => '2022-12-05', 'tgl_akhir' => '2027-02-26']);
        DB::table('masaspptsni')->insert(['cabang' => 'Sumatera Utara',  'name' => 'PT Perkebunan Nusantara-IV Regional-3', 'no_spptsni' => '215/S/RE/B/VI.6/2016', 'tgl_awal' => '2024-09-03', 'tgl_akhir' => '2028-09-02']);
        DB::table('masaspptsni')->insert(['cabang' => 'Sumatera Utara',  'name' => 'PT Poly Bangkinang Raya', 'no_spptsni' => 'JPA 009 198', 'tgl_awal' => '2926-01-21', 'tgl_akhir' => '2030-01-20']);
        DB::table('masaspptsni')->insert(['cabang' => 'Sumatera Utara',  'name' => 'PT Polykencana Raya', 'no_spptsni' => 'JPA 009 127', 'tgl_awal' => '2025-01-13', 'tgl_akhir' => '2029-02-12']);
        DB::table('masaspptsni')->insert(['cabang' => 'Sumatera Utara',  'name' => 'PT Potensi Bumi Sakti', 'no_spptsni' => 'JPA 009 237', 'tgl_awal' => '2025-12-23', 'tgl_akhir' => '2029-12-22']);
        DB::table('masaspptsni')->insert(['cabang' => 'Sumatera Utara',  'name' => 'PT Prima Indo Rubber', 'no_spptsni' => '001/PSMB-LSPr.SPPT.A 1/2025', 'tgl_awal' => '2025-04-25', 'tgl_akhir' => '2029-01-08']);
        DB::table('masaspptsni')->insert(['cabang' => 'Sumatera Utara',  'name' => 'PT Rubber Hock Lie - Rantau Prapat', 'no_spptsni' => 'JPA 009 165', 'tgl_awal' => '2026-02-09', 'tgl_akhir' => '2030-02-08']);
        DB::table('masaspptsni')->insert(['cabang' => 'Sumatera Utara',  'name' => 'PT Rubber Hock Lie - Sunggal', 'no_spptsni' => 'JPA 009 164', 'tgl_awal' => '2030-02-23', 'tgl_akhir' => '2030-02-22']);
        DB::table('masaspptsni')->insert(['cabang' => 'Sumatera Utara',  'name' => 'PT Socfin Indonesia - Aek Pamienke', 'no_spptsni' => 'JPA 009 234', 'tgl_awal' => '2025-09-01', 'tgl_akhir' => '2029-08-31']);
        DB::table('masaspptsni')->insert(['cabang' => 'Sumatera Utara',  'name' => 'PT Socfin Indonesia - Tanah Besih', 'no_spptsni' => 'JPA 009 233', 'tgl_awal' => '2025-08-29', 'tgl_akhir' => '2029-08-28']);
        DB::table('masaspptsni')->insert(['cabang' => 'Sumatera Utara',  'name' => 'PT Teluk Luas', 'no_spptsni' => 'JPA 009 150', 'tgl_awal' => '2022-04-20', 'tgl_akhir' => '2026-04-19']);
        DB::table('masaspptsni')->insert(['cabang' => 'Sumatera Utara',  'name' => 'PT Tirta Sari Surya', 'no_spptsni' => '824 260020', 'tgl_awal' => '2026-03-10', 'tgl_akhir' => '2031-03-09']);
        DB::table('masaspptsni')->insert(['cabang' => 'Sumatera Utara',  'name' => 'PT Virginia Rubber Indonesia Company (VIRCO)', 'no_spptsni' => 'JPA 009 068', 'tgl_awal' => '2012-04-14', 'tgl_akhir' => '2028-03-13']);
        DB::table('masaspptsni')->insert(['cabang' => 'Sumatera Utara',  'name' => 'PT Wipolimex Raya', 'no_spptsni' => 'JPA 009 145', 'tgl_awal' => '2026-03-04', 'tgl_akhir' => '2030-03-03']);
        DB::table('masaspptsni')->insert(['cabang' => 'Sumatera Utara',  'name' => 'PT ABC', 'no_spptsni' => 'JPA 009 145', 'tgl_awal' => '2026-03-04', 'tgl_akhir' => '2026-07-02']);

        // Jawaa
        DB::table('masaspptsni')->insert(['cabang' => 'Jawa', 'name' => 'PT Bitung Gunasejahtera', 'no_spptsni' => 'JPA 009 026', 'tgl_awal' => '2023-10-26', 'tgl_akhir' => '2027-10-22']);
        DB::table('masaspptsni')->insert(['cabang' => 'Jawa', 'name' => 'CV Jadi Jaya Makmur', 'no_spptsni' => 'JPA 009 062', 'tgl_awal' => '2011-06-05', 'tgl_akhir' => '2027-04-01']);
        DB::table('masaspptsni')->insert(['cabang' => 'Jawa', 'name' => 'PT Indo Java Rubber Planting', 'no_spptsni' => 'JPA 009 081', 'tgl_awal' => '2026-01-26', 'tgl_akhir' => '2030-01-25']);
        DB::table('masaspptsni')->insert(['cabang' => 'Jawa', 'name' => 'PT Kaliduren Estates', 'no_spptsni' => 'JPA 009 082', 'tgl_awal' => '2025-11-14', 'tgl_akhir' => '2029-11-13']);
        DB::table('masaspptsni')->insert(['cabang' => 'Jawa', 'name' => 'PT Nusa Alam Rubber', 'no_spptsni' => '403/S/SA/B/XI.11/2016', 'tgl_awal' => '2024-07-15', 'tgl_akhir' => '2028-07-14']);
        DB::table('masaspptsni')->insert(['cabang' => 'Jawa', 'name' => 'PT Perkebunan Nusantara I Regional 2', 'no_spptsni' => '04520DN-643-LSPro PPMB', 'tgl_awal' => '2020-09-24', 'tgl_akhir' => '2024-09-23']);
        DB::table('masaspptsni')->insert(['cabang' => 'Jawa', 'name' => 'PT Raberindo Pratama', 'no_spptsni' => 'JPA 009 013', 'tgl_awal' => '2006-08-18', 'tgl_akhir' => '2026-08-15']);
        DB::table('masaspptsni')->insert(['cabang' => 'Jawa', 'name' => 'CV Semesta Jaya Lestarie', 'no_spptsni' => 'JPA 009 074', 'tgl_awal' => '2012-11-10', 'tgl_akhir' => '2028-11-21']);
        DB::table('masaspptsni')->insert(['cabang' => 'Jawa', 'name' => 'CV Sinar Jaya', 'no_spptsni' => '2122DN-35A.1-034-LSPr-001-IDN', 'tgl_awal' => '2022-03-17', 'tgl_akhir' => '2026-03-16']);

        // KALSEL
        DB::table('masaspptsni')->insert(['cabang' => 'KALSEL', 'name' => 'PT Bumi Jaya', 'no_spptsni' => 'JPA 009 101', 'tgl_awal' => '2022-11-14', 'tgl_akhir' => '2026-11-13']);
        DB::table('masaspptsni')->insert(['cabang' => 'KALSEL', 'name' => 'PT Darma Kalimantan Jaya', 'no_spptsni' => 'JPA 009 040', 'tgl_awal' => '2024-04-24', 'tgl_akhir' => '2028-04-23']);
        DB::table('masaspptsni')->insert(['cabang' => 'KALSEL', 'name' => 'PT Insan Bonafide', 'no_spptsni' => 'JPA 009 039', 'tgl_awal' => '2024-09-09', 'tgl_akhir' => '2028-09-08']);
        DB::table('masaspptsni')->insert(['cabang' => 'KALSEL', 'name' => 'PT Jhonlin Agro Mandiri', 'no_spptsni' => '4522DN-35A.1-067-LSPr-001-IDN', 'tgl_awal' => '2022-05-13', 'tgl_akhir' => '2026-05-12']);
        DB::table('masaspptsni')->insert(['cabang' => 'KALSEL', 'name' => 'PT Karias Tabing Kencana', 'no_spptsni' => 'JPA 009 045', 'tgl_awal' => '2024-09-05', 'tgl_akhir' => '2028-09-04']);
        DB::table('masaspptsni')->insert(['cabang' => 'KALSEL', 'name' => 'PT Kintap Jaya Wattindo', 'no_spptsni' => 'JPA 009 085', 'tgl_awal' => '2025-11-11', 'tgl_akhir' => '2029-11-10']);
        DB::table('masaspptsni')->insert(['cabang' => 'KALSEL', 'name' => 'PT Nusantara Batulicin', 'no_spptsni' => 'JPA 009 089', 'tgl_awal' => '2022-07-08', 'tgl_akhir' => '2026-07-07']);
        DB::table('masaspptsni')->insert(['cabang' => 'KALSEL', 'name' => 'PT Wilson Lautan Karet', 'no_spptsni' => 'JPA 009 218', 'tgl_awal' => '2024-07-29', 'tgl_akhir' => '2028-07-28']);
        DB::table('masaspptsni')->insert(['cabang' => 'KALSEL', 'name' => 'PT Borneo Makmur Lestari', 'no_spptsni' => 'JPA 009 043', 'tgl_awal' => '2025-06-16', 'tgl_akhir' => '2029-06-15']);
        DB::table('masaspptsni')->insert(['cabang' => 'KALSEL', 'name' => 'PT Bumi Asri Pasamman', 'no_spptsni' => 'JPA 009 041', 'tgl_awal' => '2024-08-12', 'tgl_akhir' => '2029-08-11']);
        DB::table('masaspptsni')->insert(['cabang' => 'KALSEL', 'name' => 'PT Kahayan Berseri', 'no_spptsni' => 'JPA 009 199', 'tgl_awal' => '2026-02-20', 'tgl_akhir' => '2030-02-19']);
        DB::table('masaspptsni')->insert(['cabang' => 'KALSEL', 'name' => 'PT Multi Kusuma Cemerlang', 'no_spptsni' => 'JPA 009 138', 'tgl_awal' => '2025-10-24', 'tgl_akhir' => '2029-10-23']);

        // Seumatera Selatan
        DB::table('masaspptsni')->insert(['cabang' => 'Sumatera Selatan', 'name' => 'PT. Aneka Bumi Pratama', 'no_spptsni' => '008/BSPJI-Palembang/MS.1/X/2026', 'tgl_awal' => '2024-09-01', 'tgl_akhir' => '2028-08-01']);
        DB::table('masaspptsni')->insert(['cabang' => 'Sumatera Selatan', 'name' => 'PT. Asa Rubber', 'no_spptsni' => '', 'tgl_awal' => null, 'tgl_akhir' => null]);
        DB::table('masaspptsni')->insert(['cabang' => 'Sumatera Selatan', 'name' => 'PT.Bintang Agung Persada', 'no_spptsni' => '824 200016', 'tgl_awal' => '2016-09-03', 'tgl_akhir' => '2031-08-03']);
        DB::table('masaspptsni')->insert(['cabang' => 'Sumatera Selatan', 'name' => 'PT. Bintang Gasing Persada', 'no_spptsni' => '029/BSPJI-Palembang/MS.1/V/2024', 'tgl_awal' => '2024-02-15', 'tgl_akhir' => '2028-02-14']);
        DB::table('masaspptsni')->insert(['cabang' => 'Sumatera Selatan', 'name' => 'PT. Bumi Beliti Abadi', 'no_spptsni' => 'JPA 009 190', 'tgl_awal' => '2025-10-04', 'tgl_akhir' => '2029-09-04']);
        DB::table('masaspptsni')->insert(['cabang' => 'Sumatera Selatan', 'name' => 'PT. Fajar Berseri', 'no_spptsni' => '', 'tgl_awal' => null, 'tgl_akhir' => null]);
        DB::table('masaspptsni')->insert(['cabang' => 'Sumatera Selatan', 'name' => 'PT Gadjah Ruku', 'no_spptsni' => '054/BSPJI-Palembang/MS.1/X/2023', 'tgl_awal' => '2024-02-01', 'tgl_akhir' => '2028-01-01']);
        DB::table('masaspptsni')->insert(['cabang' => 'Sumatera Selatan', 'name' => 'PT. Hevea MK  I', 'no_spptsni' => '', 'tgl_awal' => null, 'tgl_akhir' => null]);
        DB::table('masaspptsni')->insert(['cabang' => 'Sumatera Selatan', 'name' => 'PT. Hevea MK II', 'no_spptsni' => '014/BSPJI-Palembang/MS.1/V/2025', 'tgl_awal' => '2025-05-19', 'tgl_akhir' => '2029-05-18']);
        DB::table('masaspptsni')->insert(['cabang' => 'Sumatera Selatan', 'name' => 'PT. Hok Tong ', 'no_spptsni' => '', 'tgl_awal' => null, 'tgl_akhir' => null]);
        DB::table('masaspptsni')->insert(['cabang' => 'Sumatera Selatan', 'name' => 'PT. Hok Tong II', 'no_spptsni' => '039/BSPJI Palembang/MS.1/VII/2023', 'tgl_awal' => '2023-03-07', 'tgl_akhir' => '2027-10-27']);
        DB::table('masaspptsni')->insert(['cabang' => 'Sumatera Selatan', 'name' => 'PT. Kirana Musi Persada', 'no_spptsni' => '824 260014', 'tgl_awal' => '2026-10-03', 'tgl_akhir' => '2031-09-03']);
        DB::table('masaspptsni')->insert(['cabang' => 'Sumatera Selatan', 'name' => 'PT. Kirana Permata', 'no_spptsni' => '824 260013', 'tgl_awal' => '2026-10-03', 'tgl_akhir' => '2031-09-03']);
        DB::table('masaspptsni')->insert(['cabang' => 'Sumatera Selatan', 'name' => 'PT. Kirana Windu', 'no_spptsni' => '824 260025', 'tgl_awal' => '2026-05-03', 'tgl_akhir' => '2031-03-04']);
        DB::table('masaspptsni')->insert(['cabang' => 'Sumatera Selatan', 'name' => 'PT. Karini Utama', 'no_spptsni' => '824260018', 'tgl_awal' => '2026-03-11', 'tgl_akhir' => '2031-10-03']);
        DB::table('masaspptsni')->insert(['cabang' => 'Sumatera Selatan', 'name' => 'PT.  Lingga Djaya', 'no_spptsni' => '026/BSPJI-Palembang/MS.1/V/2024', 'tgl_awal' => '2024-05-13', 'tgl_akhir' => '2028-05-12']);
        DB::table('masaspptsni')->insert(['cabang' => 'Sumatera Selatan', 'name' => 'PT. PP London Sumatra Indonesia, Tbk', 'no_spptsni' => '', 'tgl_awal' => null, 'tgl_akhir' => null]);
        DB::table('masaspptsni')->insert(['cabang' => 'Sumatera Selatan', 'name' => 'PT. Mardec Musi Lestari', 'no_spptsni' => '', 'tgl_awal' => null, 'tgl_akhir' => null]);
        DB::table('masaspptsni')->insert(['cabang' => 'Sumatera Selatan', 'name' => 'PT. Pancasamudera Simpati', 'no_spptsni' => '005/BSPJI-Palembang/MS.1/I/2024', 'tgl_awal' => '2024-05-02', 'tgl_akhir' => '2028-04-02']);
        DB::table('masaspptsni')->insert(['cabang' => 'Sumatera Selatan', 'name' => 'PT. Pinago Utama, Tbk', 'no_spptsni' => 'JPA 009 129', 'tgl_awal' => '2025-01-15', 'tgl_akhir' => '2029-01-04']);
        DB::table('masaspptsni')->insert(['cabang' => 'Sumatera Selatan', 'name' => 'PT. Prasida Aneka Niaga', 'no_spptsni' => '', 'tgl_awal' => null, 'tgl_akhir' => null]);
        DB::table('masaspptsni')->insert(['cabang' => 'Sumatera Selatan', 'name' => 'PT. Prasida Aneka Niaga Unit II', 'no_spptsni' => '', 'tgl_awal' => null, 'tgl_akhir' => null]);
        DB::table('masaspptsni')->insert(['cabang' => 'Sumatera Selatan', 'name' => 'PT Remco Rubber Indonesia', 'no_spptsni' => '057/BSPJI-Palembang/MS.1/X/2023', 'tgl_awal' => '2023-11-11', 'tgl_akhir' => '2027-11-10']);
        DB::table('masaspptsni')->insert(['cabang' => 'Sumatera Selatan', 'name' => 'PT. Sri Trang Lingga Indonesia', 'no_spptsni' => '023/BSPJI-Palembang/MS.1/IV/2024', 'tgl_awal' => '2024-05-10', 'tgl_akhir' => '2028-05-09']);
        DB::table('masaspptsni')->insert(['cabang' => 'Sumatera Selatan', 'name' => 'PT. Sunan Rubber', 'no_spptsni' => 'JPA 009 161', 'tgl_awal' => '2022-10-13', 'tgl_akhir' => '2026-12-10']);
        DB::table('masaspptsni')->insert(['cabang' => 'Sumatera Selatan', 'name' => 'PT. Warna Agung Selatan', 'no_spptsni' => '053/BSPJI-Palembang/MS.1/X/2024', 'tgl_awal' => '2025-06-16', 'tgl_akhir' => '2029-06-05']);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('masaspptsni');
    }
};

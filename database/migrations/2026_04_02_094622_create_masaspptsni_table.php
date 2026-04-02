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
            $table->string('cabang');
            $table->string('name');
            $table->string('no_spptsni');
            $table->date('tgl_awal');
            $table->date('tgl_akhir');
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
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('masaspptsni');
    }
};

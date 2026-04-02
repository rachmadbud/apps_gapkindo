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
        Schema::create('masatpp', function (Blueprint $table) {
            $table->id();
            $table->string('cabang');
            $table->string('name');
            $table->string('no_tpp');
            $table->date('tgl_terbit');
            $table->date('tgl_berakhir');
            $table->timestamp('reminder_sent_at')->nullable();
            $table->string('reminder_status')->nullable();
            $table->timestamps();
        });

        DB::table('masatpp')->insert(['cabang' => 'Sumatera Utara', 'name' => 'PT Abaisiat Raya', 'no_tpp' => '033/SFB/2025', 'tgl_terbit' => '2025-12-10', 'tgl_berakhir' => '2029-12-03']);
        DB::table('masatpp')->insert(['cabang' => 'Sumatera Utara', 'name' => 'PT Anugrah Sibolga Lestari', 'no_tpp' => '021/SFU/2025', 'tgl_terbit' => '2025-10-27', 'tgl_berakhir' => '2029-10-23']);
        DB::table('masatpp')->insert(['cabang' => 'Sumatera Utara', 'name' => 'PT Bakrie Sumatera Plantations Tbk', 'no_tpp' => '149/SBZ/2022', 'tgl_terbit' => '2022-02-10', 'tgl_berakhir' => '2026-01-19']);
        DB::table('masatpp')->insert(['cabang' => 'Sumatera Utara', 'name' => 'PT Bridgestone Sumatra Rubber Estate', 'no_tpp' => '013/SAU/2026', 'tgl_terbit' => '2026-02-27', 'tgl_berakhir' => '2030-02-17']);
        DB::table('masatpp')->insert(['cabang' => 'Sumatera Utara', 'name' => 'PT Darmasindo Intikaret', 'no_tpp' => '028/SBX/2026', 'tgl_terbit' => '2026-03-16', 'tgl_berakhir' => '2030-02-22']);
        DB::table('masatpp')->insert(['cabang' => 'Sumatera Utara', 'name' => 'PT Family Raya', 'no_tpp' => '010/SAZ/2026', 'tgl_terbit' => '2026-02-26', 'tgl_berakhir' => '2030-02-22']);
        DB::table('masatpp')->insert(['cabang' => 'Sumatera Utara', 'name' => 'PT Kapuas Besar', 'no_tpp' => '006/SEY/2025', 'tgl_terbit' => '2025-03-05', 'tgl_berakhir' => '2029-02-24']);
        DB::table('masatpp')->insert(['cabang' => 'Sumatera Utara', 'name' => 'PT Kilang Lima Gunung', 'no_tpp' => '245/SCA/2022', 'tgl_terbit' => '2022-04-22', 'tgl_berakhir' => '2026-04-18']);
        DB::table('masatpp')->insert(['cabang' => 'Sumatera Utara', 'name' => 'PT Kirana Sapta', 'no_tpp' => '016/SFF/2026', 'tgl_terbit' => '2026-03-05', 'tgl_berakhir' => '2031-03-03']);
        DB::table('masatpp')->insert(['cabang' => 'Sumatera Utara', 'name' => 'PT Madjin Crumb Rubber Factory', 'no_tpp' => '009/SCR/2026', 'tgl_terbit' => '2026-02-26', 'tgl_berakhir' => '2030-02-17']);
        DB::table('masatpp')->insert(['cabang' => 'Sumatera Utara', 'name' => 'PT Nusira', 'no_tpp' => '018/SAD/2026', 'tgl_terbit' => '2026-03-06', 'tgl_berakhir' => '2031-03-01']);
        DB::table('masatpp')->insert(['cabang' => 'Sumatera Utara', 'name' => 'PT PP London Sumatra Indonesia Tbk - P. Isang', 'no_tpp' => '003/CAA/2023', 'tgl_terbit' => '2023-03-31', 'tgl_berakhir' => '2027-03-27']);
        DB::table('masatpp')->insert(['cabang' => 'Sumatera Utara', 'name' => 'PT PP London Sumatra Indonesia Tbk - S. Rumbiya', 'no_tpp' => '005/SBT/2024', 'tgl_terbit' => '2024-02-05', 'tgl_berakhir' => '2028-01-24']);
        DB::table('masatpp')->insert(['cabang' => 'Sumatera Utara', 'name' => 'PT Pantja Surya', 'no_tpp' => '249/SBV/2022', 'tgl_terbit' => '2022-07-06', 'tgl_berakhir' => '2026-05-06']);
        DB::table('masatpp')->insert(['cabang' => 'Sumatera Utara', 'name' => 'PT Perkebunan Nusantara-IV Regional-1 - G. Para', 'no_tpp' => '004/SCS/2026', 'tgl_terbit' => '2026-01-30', 'tgl_berakhir' => '2027-02-21']);
        DB::table('masatpp')->insert(['cabang' => 'Sumatera Utara', 'name' => 'PT Perkebunan Nusantara-IV Regional-1 - M. Muda', 'no_tpp' => '003/SBM/2026', 'tgl_terbit' => '2026-01-29', 'tgl_berakhir' => '2027-02-26']);
        DB::table('masatpp')->insert(['cabang' => 'Sumatera Utara', 'name' => 'PT Perkebunan Nusantara-IV Regional-3', 'no_tpp' => '239/SES/2022', 'tgl_terbit' => '2022-04-06', 'tgl_berakhir' => '2024-02-01']);
        DB::table('masatpp')->insert(['cabang' => 'Sumatera Utara', 'name' => 'PT Poly Bangkinang Raya', 'no_tpp' => '002/SGF/2026', 'tgl_terbit' => '2026-01-22', 'tgl_berakhir' => '2030-01-20']);
        DB::table('masatpp')->insert(['cabang' => 'Sumatera Utara', 'name' => 'PT Polykencana Raya', 'no_tpp' => '001/SGY/2025', 'tgl_terbit' => '2025-01-19', 'tgl_berakhir' => '2029-01-12']);
        DB::table('masatpp')->insert(['cabang' => 'Sumatera Utara', 'name' => 'PT Potensi Bumi Sakti', 'no_tpp' => '001/SHY/2026', 'tgl_terbit' => '2026-01-09', 'tgl_berakhir' => '2029-12-22']);
        DB::table('masatpp')->insert(['cabang' => 'Sumatera Utara', 'name' => 'PT Prima Indo Rubber', 'no_tpp' => '31123007225300000000', 'tgl_terbit' => '2025-02-21', 'tgl_berakhir' => '2029-02-20']);
        DB::table('masatpp')->insert(['cabang' => 'Sumatera Utara', 'name' => 'PT Rubber Hock Lie - Rantau Prapat', 'no_tpp' => '005/SCM/2026', 'tgl_terbit' => '2026-02-12', 'tgl_berakhir' => '2030-02-08']);
        DB::table('masatpp')->insert(['cabang' => 'Sumatera Utara', 'name' => 'PT Rubber Hock Lie - Sunggal', 'no_tpp' => '011/SDH/2026', 'tgl_terbit' => '2026-02-26', 'tgl_berakhir' => '2030-02-22']);
        DB::table('masatpp')->insert(['cabang' => 'Sumatera Utara', 'name' => 'PT Socfin Indonesia - Aek Pamienke', 'no_tpp' => '017/SDM/2025', 'tgl_terbit' => '2025-09-03', 'tgl_berakhir' => '2029-08-31']);
        DB::table('masatpp')->insert(['cabang' => 'Sumatera Utara', 'name' => 'PT Socfin Indonesia - Tanah Besih', 'no_tpp' => '016/SBU/2025', 'tgl_terbit' => '2025-09-03', 'tgl_berakhir' => '2029-08-28']);
        DB::table('masatpp')->insert(['cabang' => 'Sumatera Utara', 'name' => 'PT Teluk Luas', 'no_tpp' => '244/SCB/2022', 'tgl_terbit' => '2022-04-22', 'tgl_berakhir' => '2026-04-19']);
        DB::table('masatpp')->insert(['cabang' => 'Sumatera Utara', 'name' => 'PT Tirta Sari Surya', 'no_tpp' => '026/SCE/2026', 'tgl_terbit' => '2026-03-16', 'tgl_berakhir' => '2031-03-09']);
        DB::table('masatpp')->insert(['cabang' => 'Sumatera Utara', 'name' => 'PT Virginia Rubber Indonesia Company (VIRCO)', 'no_tpp' => '012/SAH/2024', 'tgl_terbit' => '2024-04-17', 'tgl_berakhir' => '2028-03-13']);
        DB::table('masatpp')->insert(['cabang' => 'Sumatera Utara', 'name' => 'PT Wipolimex Raya', 'no_tpp' => '017/SBI/2026', 'tgl_terbit' => '2026-03-06', 'tgl_berakhir' => '2030-03-03']);
        DB::table('masatpp')->insert(['cabang' => 'Sumatera Utara', 'name' => 'PT Wipolimex Raya', 'no_tpp' => '017/SBI/2026', 'tgl_terbit' => '2026-03-06', 'tgl_berakhir' => '2026-07-02']);
        DB::table('masatpp')->insert(['cabang' => 'Sumatera Utara', 'name' => 'PT ABC', 'no_tpp' => '017/SBI/2026', 'tgl_terbit' => '2026-03-06', 'tgl_berakhir' => '2026-07-02']);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('masatpp');
    }
};

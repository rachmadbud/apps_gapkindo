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
        Schema::create('statistik_karet', function (Blueprint $table) {
            $table->id();
            $table->string('tabel');
            $table->string('links');
            $table->timestamps();
        });

        DB::table('statistik_karet')->insert(['tabel' => 'Produksi dan Konsumsi Karet Alam Dunia', 'links' => '/produksidanKonsumsiKaretAlamDunia']);
        DB::table('statistik_karet')->insert(['tabel' => 'Produksi karet alam dunia (000 ton)', 'links' => '/produksiKaretAlamDuniaTon']);
        DB::table('statistik_karet')->insert(['tabel' => 'Konsumsi karet alam dunia (000 ton )', 'links' => '/konsumsiKaretAlamDuniaTon']);
        DB::table('statistik_karet')->insert(['tabel' => 'Neraca karet alam dunia (000 ton) dan harga SICOM', 'links' => '/neracaKaretAlamDuniaTondanHargaSICOM']);
        DB::table('statistik_karet')->insert(['tabel' => 'Perkembangan areal karet negara ANRPC(000 Ha)', 'links' => '/perkembanganArealKaretNegaraANRPCHa']);
        DB::table('statistik_karet')->insert(['tabel' => 'Perkembangan produksi negara ANRPC (000 ton)', 'links' => '/perkembanganProduksiKaretNegaraANRPCTon']);
        DB::table('statistik_karet')->insert(['tabel' => 'Perkembangan produktivitas negara ANRPC (Kg/Ha)', 'links' => '/perkembanganProduktivitasKaretNegaraANRPCKgHa']);
        DB::table('statistik_karet')->insert(['tabel' => 'Perkembangan konsumsi negara ANRPC (000 ton)', 'links' => '/perkembanganKonsumsiKaretNegaraANRPCTon']);
        DB::table('statistik_karet')->insert(['tabel' => 'Perkembangan ekspor negara ANRPC (000 ton)', 'links' => '/perkembanganEksporKaretNegaraANRPCTon']);
        DB::table('statistik_karet')->insert(['tabel' => 'Perkembangan impor negara ANRPC (000 ton)', 'links' => '/perkembanganImporKaretNegaraANRPCTon']);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('statistik_karet');
    }
};

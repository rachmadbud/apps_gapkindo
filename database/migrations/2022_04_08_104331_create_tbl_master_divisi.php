<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblMasterDivisi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_master_divisi', function (Blueprint $table) {
            $table->id();
            $table->integer('unit_kerja_id');
            $table->text('nama_divisi');
        });

        //insertDatatoTable'tbl_master_divisi'
        DB::table('tbl_master_divisi')->insert(['unit_kerja_id' => '22', 'nama_divisi' => 'Divisi Transaksi Pinjaman']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_master_divisi');
    }
}

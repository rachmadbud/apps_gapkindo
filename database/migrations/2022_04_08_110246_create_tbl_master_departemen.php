<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblMasterDepartemen extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_master_departemen', function (Blueprint $table) {
            $table->id();
            $table->integer('unit_kerja_id');
            $table->integer('divisi_id');
            $table->text('nama_departemen');
        });

        //insert data to table
        DB::table('tbl_master_departemen')->insert(['unit_kerja_id' => '22', 'divisi_id' => '1', 'nama_departemen' => 'Departemen Pencairan Pinjaman']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_master_departemen');
    }
}

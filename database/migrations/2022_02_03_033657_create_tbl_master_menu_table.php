<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblMasterMenuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_master_menu', function (Blueprint $table) {
            $table->id();
            $table->string('nama', 100);
            $table->text('link');
            $table->smallInteger('status_data');
            $table->integer('urutan');
            $table->timestamps();
        });

        DB::table('tbl_master_menu')->insert(['id' => '1', 'nama' => 'Dashboard', 'link' => '/dashboard', 'status_data' => '1', 'urutan' => '1']);
        DB::table('tbl_master_menu')->insert(['id' => '2', 'nama' => 'Manajemen', 'link' => '#', 'status_data' => '1', 'urutan' => '2']);
        DB::table('tbl_master_menu')->insert(['id' => '3', 'nama' => 'Konfigurasi', 'link' => '#', 'status_data' => '1', 'urutan' => '3']);
        DB::table('tbl_master_menu')->insert(['id' => '4', 'nama' => 'Surat', 'link' => '#', 'status_data' => '1', 'urutan' => '4']);

        DB::table('tbl_master_menu')->insert(['id' => '5', 'nama' => 'Ekspor & Impor', 'link' => '#', 'status_data' => '1', 'urutan' => '5']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_master_menu');
    }
}

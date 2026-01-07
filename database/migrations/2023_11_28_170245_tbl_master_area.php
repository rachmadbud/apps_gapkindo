<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class TblMasterArea extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_master_area', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('nama');
            $table->integer('status_data');
        });

        // Insert Data Master Area
        DB::table('tbl_master_area')->insert(['nama' => 'Utara', 'status_data' => 1]);
        DB::table('tbl_master_area')->insert(['nama' => 'Timur', 'status_data' => 1]);
        DB::table('tbl_master_area')->insert(['nama' => 'Selatan', 'status_data' => 1]);
        DB::table('tbl_master_area')->insert(['nama' => 'Barat', 'status_data' => 1]);
        DB::table('tbl_master_area')->insert(['nama' => 'Pusat', 'status_data' => 1]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_master_area');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblMasterUnitKerjaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_master_unit_kerja', function (Blueprint $table) {
            $table->id();
            $table->string('nama', 100);
            $table->string('singkatan', 10);
            $table->text('email');
            $table->smallInteger('status_data');
            $table->timestamps();
        });

        DB::table('tbl_master_unit_kerja')->insert(['id' => 1, 'nama' => 'Teknologi Informasi', 'singkatan' => 'TI', 'email' => 'test@gmail.com', 'status_data' => 1]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_master_unit_kerja');
    }
}

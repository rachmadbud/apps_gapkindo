<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblMasterSubmenuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_master_submenu', function (Blueprint $table) {
            $table->id();
            $table->string('nama', 100);
            $table->bigInteger('id_menu');
            $table->text('link');
            $table->smallInteger('status_data');
            $table->integer('urutan');
            $table->timestamps();
        });

        DB::table('tbl_master_submenu')->insert(['id' => '1', 'nama' => 'Menu', 'id_menu' => '2', 'link' => '/manajemenMenu', 'status_data' => '1', 'urutan' => '1']);
        DB::table('tbl_master_submenu')->insert(['id' => '2', 'nama' => 'Submenu', 'id_menu' => '2', 'link' => '/manajemenSubmenu', 'status_data' => '1', 'urutan' => '2']);
        DB::table('tbl_master_submenu')->insert(['id' => '3', 'nama' => 'Unit Kerja', 'id_menu' => '2', 'link' => '/manajemenUnker', 'status_data' => '1', 'urutan' => '3']);
        DB::table('tbl_master_submenu')->insert(['id' => '4', 'nama' => 'Role', 'id_menu' => '2', 'link' => '/manajemenRole', 'status_data' => '1', 'urutan' => '4']);
        DB::table('tbl_master_submenu')->insert(['id' => '5', 'nama' => 'User', 'id_menu' => '2', 'link' => '/manajemenUser', 'status_data' => '1', 'urutan' => '5']);
        DB::table('tbl_master_submenu')->insert(['id' => '6', 'nama' => 'Sekuriti', 'id_menu' => '2', 'link' => '/manajemenSekuriti', 'status_data' => '1', 'urutan' => '6']);
        DB::table('tbl_master_submenu')->insert(['id' => '7', 'nama' => 'Online User', 'id_menu' => '3', 'link' => '/users', 'status_data' => '1', 'urutan' => '7']);
        DB::table('tbl_master_submenu')->insert(['id' => '8', 'nama' => 'LogActivity', 'id_menu' => '3', 'link' => '/manajemenUserActivity', 'status_data' => '1', 'urutan' => '8']);
        DB::table('tbl_master_submenu')->insert(['id' => '9', 'nama' => 'Surat Masuk', 'id_menu' => '4', 'link' => '/suratMasukx', 'status_data' => '1', 'urutan' => '9']);
        DB::table('tbl_master_submenu')->insert(['id' => '10', 'nama' => 'Surat Keluar', 'id_menu' => '4', 'link' => '/suratKeluarx', 'status_data' => '1', 'urutan' => '10']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_master_submenu');
    }
}

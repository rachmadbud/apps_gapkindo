<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblMasterRoleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_master_role', function (Blueprint $table) {
            $table->id();
            $table->text('nama');
            $table->text('id_menu')->nullable();
            $table->text('id_submenu')->nullable();
            $table->timestamps();
        });

        DB::table('tbl_master_role')->insert(['nama' => 'Superuser', 'id_menu' => '1,2,3,4,5', 'id_submenu' => '1,2,3,4,5,6,7,8']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_master_role');
    }
}

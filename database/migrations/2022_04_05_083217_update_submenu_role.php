<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateSubmenuRole extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('tbl_master_role')
            ->where('nama', 'Superuser')
            ->update(['id_submenu' => '1,2,3,4,5,6,7,8,9,10']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('tbl_master_role')
            ->where('nama', 'Superuser')
            ->update(['id_submenu' => '1,2,3,4,5,6,7,8,9,10']);
    }
}

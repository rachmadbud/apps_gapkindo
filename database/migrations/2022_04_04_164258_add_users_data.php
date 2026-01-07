<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUsersData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->smallInteger('is_blokir')->nullable()->change();
            $table->string('ip_address')->nullable()->change();
        });
        DB::table('users')->insert(['name' => 'administrator', 'email' => 'admin@mail.com', 'password' => '$2y$10$TduAo1xyJ33aAD.JKuBGf.F4k4nwuy9oMc8Oy9Fa5cCkH53c2w20W', 'id_unit_kerja' => '1', 'id_role' => '1', 'expired_password' => '9999-12-30', 'tanggal_lahir' => '1998-08-30', 'id_level_jabatan' => '6',]);
        //password P@ssword321
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('users')->where('nrik', '=', '80690222')->delete();
        Schema::table('users', function (Blueprint $table) {
            $table->smallInteger('is_blokir')->nullable(false)->change();
            $table->string('ip_address')->nullable(false)->change();
        });
    }
}

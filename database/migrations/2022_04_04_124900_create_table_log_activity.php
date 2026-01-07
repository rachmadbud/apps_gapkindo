<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableLogActivity extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('log_activity', function (Blueprint $table) {
            $table->id();
            $table->text('subject');
            $table->text('url');
            $table->string('method');
            $table->string('ip');
            $table->string('agent');
            $table->integer('user_id');
            $table->timestamps();
        });

        Schema::create('tbl_user_activity_log', function (Blueprint $table) {
            $table->id();
            $table->string('ip_access');
            $table->bigInteger('user_id');
            $table->text('activity_content');
            $table->text('url');
            $table->text('user_agent');
            $table->string('method');
            $table->string('date_time');
        });

        Schema::create('user_activity_log', function (Blueprint $table) {
            $table->id();
            $table->string('subject');
            $table->string('url');
            $table->string('method');
            $table->string('ip');
            $table->string('user_agent');
            $table->string('user_id');
            $table->string('date_time');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('log_activity');
        Schema::dropIfExists('tbl_user_activity_log');
        Schema::dropIfExists('user_activity_log');
    }
}

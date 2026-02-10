<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('ekspor_dan_impor_berdasarkan_kode_hs', function (Blueprint $table) {
            $table->id();
            $table->integer('tahun');
            $table->string('periode');
            $table->string('file');
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ekspor_dan_impor_berdasarkan_kode_hs');
    }
};

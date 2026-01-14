<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('produksidan_konsumsi_karet_alam_dunia', function (Blueprint $table) {
            $table->id();
            $table->string('tahun');
            $table->integer('produksi_ton');
            $table->decimal('pertumbuhan_produksi_ton_persentase', 5, 2);
            $table->integer('konsumsi_ton');
            $table->decimal('pertumbuhan_konsumsi_ton_persentase', 5, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produksidan_konsumsi_karet_alam_dunia');
    }
};

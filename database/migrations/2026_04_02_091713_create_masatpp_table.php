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
        Schema::create('masatpp', function (Blueprint $table) {
            $table->id();
            $table->string('cabang')->nullable();
            $table->string('name')->nullable();
            $table->string('no_tpp')->nullable();
            $table->date('tgl_terbit')->nullable();
            $table->date('tgl_berakhir')->nullable();
            $table->timestamp('reminder_sent_at')->nullable();
            $table->string('reminder_status')->nullable();
            $table->timestamps();
        });

        DB::table('masatpp')->insert(['cabang' => 'Sumatera Utara', 'name' => 'PT Abaisiat Raya', 'no_tpp' => '033/SFB/2025', 'tgl_terbit' => '2025-12-10', 'tgl_berakhir' => '2029-12-03']);
        DB::table('masatpp')->insert(['cabang' => 'Sumatera Utara', 'name' => 'PT Anugrah Sibolga Lestari', 'no_tpp' => '021/SFU/2025', 'tgl_terbit' => '2025-10-27', 'tgl_berakhir' => '2029-10-23']);
        DB::table('masatpp')->insert(['cabang' => 'Sumatera Utara', 'name' => 'PT Bakrie Sumatera Plantations Tbk', 'no_tpp' => '149/SBZ/2022', 'tgl_terbit' => '2022-02-10', 'tgl_berakhir' => '2026-01-19']);
        DB::table('masatpp')->insert(['cabang' => 'Sumatera Utara', 'name' => 'PT Bridgestone Sumatra Rubber Estate', 'no_tpp' => '013/SAU/2026', 'tgl_terbit' => '2026-02-27', 'tgl_berakhir' => '2030-02-17']);
        DB::table('masatpp')->insert(['cabang' => 'Sumatera Utara', 'name' => 'PT Darmasindo Intikaret', 'no_tpp' => '028/SBX/2026', 'tgl_terbit' => '2026-03-16', 'tgl_berakhir' => '2030-02-22']);
        DB::table('masatpp')->insert(['cabang' => 'Sumatera Utara', 'name' => 'PT Family Raya', 'no_tpp' => '010/SAZ/2026', 'tgl_terbit' => '2026-02-26', 'tgl_berakhir' => '2030-02-22']);
        DB::table('masatpp')->insert(['cabang' => 'Sumatera Utara', 'name' => 'PT Kapuas Besar', 'no_tpp' => '006/SEY/2025', 'tgl_terbit' => '2025-03-05', 'tgl_berakhir' => '2029-02-24']);
        DB::table('masatpp')->insert(['cabang' => 'Sumatera Utara', 'name' => 'PT Kilang Lima Gunung', 'no_tpp' => '245/SCA/2022', 'tgl_terbit' => '2022-04-22', 'tgl_berakhir' => '2026-04-18']);
        DB::table('masatpp')->insert(['cabang' => 'Sumatera Utara', 'name' => 'PT Kirana Sapta', 'no_tpp' => '016/SFF/2026', 'tgl_terbit' => '2026-03-05', 'tgl_berakhir' => '2031-03-03']);
        DB::table('masatpp')->insert(['cabang' => 'Sumatera Utara', 'name' => 'PT Madjin Crumb Rubber Factory', 'no_tpp' => '009/SCR/2026', 'tgl_terbit' => '2026-02-26', 'tgl_berakhir' => '2030-02-17']);
        DB::table('masatpp')->insert(['cabang' => 'Sumatera Utara', 'name' => 'PT Nusira', 'no_tpp' => '018/SAD/2026', 'tgl_terbit' => '2026-03-06', 'tgl_berakhir' => '2031-03-01']);
        DB::table('masatpp')->insert(['cabang' => 'Sumatera Utara', 'name' => 'PT PP London Sumatra Indonesia Tbk - P. Isang', 'no_tpp' => '003/CAA/2023', 'tgl_terbit' => '2023-03-31', 'tgl_berakhir' => '2027-03-27']);
        DB::table('masatpp')->insert(['cabang' => 'Sumatera Utara', 'name' => 'PT PP London Sumatra Indonesia Tbk - S. Rumbiya', 'no_tpp' => '005/SBT/2024', 'tgl_terbit' => '2024-02-05', 'tgl_berakhir' => '2028-01-24']);
        DB::table('masatpp')->insert(['cabang' => 'Sumatera Utara', 'name' => 'PT Pantja Surya', 'no_tpp' => '249/SBV/2022', 'tgl_terbit' => '2022-07-06', 'tgl_berakhir' => '2026-05-06']);
        DB::table('masatpp')->insert(['cabang' => 'Sumatera Utara', 'name' => 'PT Perkebunan Nusantara-IV Regional-1 - G. Para', 'no_tpp' => '004/SCS/2026', 'tgl_terbit' => '2026-01-30', 'tgl_berakhir' => '2027-02-21']);
        DB::table('masatpp')->insert(['cabang' => 'Sumatera Utara', 'name' => 'PT Perkebunan Nusantara-IV Regional-1 - M. Muda', 'no_tpp' => '003/SBM/2026', 'tgl_terbit' => '2026-01-29', 'tgl_berakhir' => '2027-02-26']);
        DB::table('masatpp')->insert(['cabang' => 'Sumatera Utara', 'name' => 'PT Perkebunan Nusantara-IV Regional-3', 'no_tpp' => '239/SES/2022', 'tgl_terbit' => '2022-04-06', 'tgl_berakhir' => '2024-02-01']);
        DB::table('masatpp')->insert(['cabang' => 'Sumatera Utara', 'name' => 'PT Poly Bangkinang Raya', 'no_tpp' => '002/SGF/2026', 'tgl_terbit' => '2026-01-22', 'tgl_berakhir' => '2030-01-20']);
        DB::table('masatpp')->insert(['cabang' => 'Sumatera Utara', 'name' => 'PT Polykencana Raya', 'no_tpp' => '001/SGY/2025', 'tgl_terbit' => '2025-01-19', 'tgl_berakhir' => '2029-01-12']);
        DB::table('masatpp')->insert(['cabang' => 'Sumatera Utara', 'name' => 'PT Potensi Bumi Sakti', 'no_tpp' => '001/SHY/2026', 'tgl_terbit' => '2026-01-09', 'tgl_berakhir' => '2029-12-22']);
        DB::table('masatpp')->insert(['cabang' => 'Sumatera Utara', 'name' => 'PT Prima Indo Rubber', 'no_tpp' => '31123007225300000000', 'tgl_terbit' => '2025-02-21', 'tgl_berakhir' => '2029-02-20']);
        DB::table('masatpp')->insert(['cabang' => 'Sumatera Utara', 'name' => 'PT Rubber Hock Lie - Rantau Prapat', 'no_tpp' => '005/SCM/2026', 'tgl_terbit' => '2026-02-12', 'tgl_berakhir' => '2030-02-08']);
        DB::table('masatpp')->insert(['cabang' => 'Sumatera Utara', 'name' => 'PT Rubber Hock Lie - Sunggal', 'no_tpp' => '011/SDH/2026', 'tgl_terbit' => '2026-02-26', 'tgl_berakhir' => '2030-02-22']);
        DB::table('masatpp')->insert(['cabang' => 'Sumatera Utara', 'name' => 'PT Socfin Indonesia - Aek Pamienke', 'no_tpp' => '017/SDM/2025', 'tgl_terbit' => '2025-09-03', 'tgl_berakhir' => '2029-08-31']);
        DB::table('masatpp')->insert(['cabang' => 'Sumatera Utara', 'name' => 'PT Socfin Indonesia - Tanah Besih', 'no_tpp' => '016/SBU/2025', 'tgl_terbit' => '2025-09-03', 'tgl_berakhir' => '2029-08-28']);
        DB::table('masatpp')->insert(['cabang' => 'Sumatera Utara', 'name' => 'PT Teluk Luas', 'no_tpp' => '244/SCB/2022', 'tgl_terbit' => '2022-04-22', 'tgl_berakhir' => '2026-04-19']);
        DB::table('masatpp')->insert(['cabang' => 'Sumatera Utara', 'name' => 'PT Tirta Sari Surya', 'no_tpp' => '026/SCE/2026', 'tgl_terbit' => '2026-03-16', 'tgl_berakhir' => '2031-03-09']);
        DB::table('masatpp')->insert(['cabang' => 'Sumatera Utara', 'name' => 'PT Virginia Rubber Indonesia Company (VIRCO)', 'no_tpp' => '012/SAH/2024', 'tgl_terbit' => '2024-04-17', 'tgl_berakhir' => '2028-03-13']);
        DB::table('masatpp')->insert(['cabang' => 'Sumatera Utara', 'name' => 'PT Wipolimex Raya', 'no_tpp' => '017/SBI/2026', 'tgl_terbit' => '2026-03-06', 'tgl_berakhir' => '2030-03-03']);

        // Jawa
        DB::table('masatpp')->insert(['cabang' => 'Jawa', 'name' => 'PT Bitung Gunasejahtera', 'no_tpp' => '014/DAN/2023', 'tgl_terbit' => '2023-10-26', 'tgl_berakhir' => '2027-10-22']);
        DB::table('masatpp')->insert(['cabang' => 'Jawa', 'name' => 'CV Jadi Jaya Makmur', 'no_tpp' => '005/DAU/2023', 'tgl_terbit' => '2023-04-14', 'tgl_berakhir' => '2027-04-01']);
        DB::table('masatpp')->insert(['cabang' => 'Jawa', 'name' => 'PT Indo Java Rubber Planting', 'no_tpp' => '002/DAO/2026', 'tgl_terbit' => '2026-01-27', 'tgl_berakhir' => '2030-01-25']);
        DB::table('masatpp')->insert(['cabang' => 'Jawa', 'name' => 'PT Kaliduren Estates', 'no_tpp' => '029/DAR/2025', 'tgl_terbit' => '2025-12-04', 'tgl_berakhir' => '2029-11-13']);
        DB::table('masatpp')->insert(['cabang' => 'Jawa', 'name' => 'PT Nusa Alam Rubber', 'no_tpp' => '016/DAY/2024', 'tgl_terbit' => '2024-08-14', 'tgl_berakhir' => '2028-07-14']);
        DB::table('masatpp')->insert(['cabang' => 'Jawa', 'name' => 'PT Perkebunan Nusantara I Regional 2', 'no_tpp' => '250/DAJ/2022', 'tgl_terbit' => '2022-07-06', 'tgl_berakhir' => '2024-09-23']);
        DB::table('masatpp')->insert(['cabang' => 'Jawa', 'name' => 'PT Raberindo Pratama', 'no_tpp' => '253/DAQ/2022', 'tgl_terbit' => '2022-08-19', 'tgl_berakhir' => '2026-08-15']);
        DB::table('masatpp')->insert(['cabang' => 'Jawa', 'name' => 'CV Semesta Jaya Lestarie', 'no_tpp' => '003/DAW/2025', 'tgl_terbit' => '2025-01-24', 'tgl_berakhir' => '2028-11-21']);
        DB::table('masatpp')->insert(['cabang' => 'Jawa', 'name' => 'CV Sinar Jaya', 'no_tpp' => '217/DAX/2022', 'tgl_terbit' => '2022-03-23', 'tgl_berakhir' => '2026-03-16']);

        //Kalsel
        DB::table('masatpp')->insert(['cabang' => 'KALSEL', 'name' => 'PT Bridgestone Kalimantan Plantation', 'no_tpp' => '006/KBQ/2023', 'tgl_terbit' => '1900-01-01', 'tgl_berakhir' => '1900-01-01']);
        DB::table('masatpp')->insert(['cabang' => 'KALSEL', 'name' => 'PT Bumi Jaya', 'no_tpp' => '019/KBG/2024', 'tgl_terbit' => '2023-06-05', 'tgl_berakhir' => '2026-11-13']);
        DB::table('masatpp')->insert(['cabang' => 'KALSEL', 'name' => 'PT Darma Kalimantan Jaya', 'no_tpp' => '018/KAV/2024', 'tgl_terbit' => '2024-09-20', 'tgl_berakhir' => '2028-04-23']);
        DB::table('masatpp')->insert(['cabang' => 'KALSEL', 'name' => 'PT Insan Bonafide', 'no_tpp' => '247/KCB/2022', 'tgl_terbit' => '2024-09-20', 'tgl_berakhir' => '2028-09-08']);
        DB::table('masatpp')->insert(['cabang' => 'KALSEL', 'name' => 'PT Jhonlin Agro Mandiri', 'no_tpp' => '024/KAY/2024', 'tgl_terbit' => '2022-05-18', 'tgl_berakhir' => '2026-05-12']);
        DB::table('masatpp')->insert(['cabang' => 'KALSEL', 'name' => 'PT Karias Tabing Kencana', 'no_tpp' => '027/KBX/2025', 'tgl_terbit' => '2024-12-19', 'tgl_berakhir' => '2028-09-04']);
        DB::table('masatpp')->insert(['cabang' => 'KALSEL', 'name' => 'PT Kintap Jaya Wattindo', 'no_tpp' => '251/KBY/2022', 'tgl_terbit' => '2025-11-25', 'tgl_berakhir' => '2029-11-10']);
        DB::table('masatpp')->insert(['cabang' => 'KALSEL', 'name' => 'PT Nusantara Batulicin', 'no_tpp' => '023/KAU/2024', 'tgl_terbit' => '2022-07-17', 'tgl_berakhir' => '2026-07-07']);
        DB::table('masatpp')->insert(['cabang' => 'KALSEL', 'name' => 'PT Wilson Lautan Karet', 'no_tpp' => '014/KBS/2025', 'tgl_terbit' => '2024-10-03', 'tgl_berakhir' => '2028-07-28']);
        DB::table('masatpp')->insert(['cabang' => 'KALSEL', 'name' => 'PT Borneo Makmur Lestari', 'no_tpp' => '020/KBK/2024', 'tgl_terbit' => '2025-07-26', 'tgl_berakhir' => '2026-06-15']);
        DB::table('masatpp')->insert(['cabang' => 'KALSEL', 'name' => 'PT Bumi Asri Pasamman', 'no_tpp' => '008/KCC/2026', 'tgl_terbit' => '2024-09-24', 'tgl_berakhir' => '2028-08-11']);
        DB::table('masatpp')->insert(['cabang' => 'KALSEL', 'name' => 'PT Kahayan Berseri', 'no_tpp' => '023/KCD/2025', 'tgl_terbit' => '2026-02-24', 'tgl_berakhir' => '2030-02-19']);
        DB::table('masatpp')->insert(['cabang' => 'KALSEL', 'name' => 'PT Multi Kusuma Cemerlang', 'no_tpp' => null, 'tgl_terbit' => '2025-10-30', 'tgl_berakhir' => '2029-10-23']);

        // Sumatera Selatan
        DB::table('masatpp')->insert(['cabang' => 'Sumatera Selatan', 'name' => 'PT. Aneka Bumi Pratama', 'no_tpp' => ' 006/SED/2026', 'tgl_terbit' => '2026-02-19', 'tgl_berakhir' => '2028-08-01']);
        DB::table('masatpp')->insert(['cabang' => 'Sumatera Selatan', 'name' => 'PT. Asa Rubber', 'no_tpp' => null, 'tgl_terbit' => null, 'tgl_berakhir' => null]);
        DB::table('masatpp')->insert(['cabang' => 'Sumatera Selatan', 'name' => 'PT.Bintang Agung Persada', 'no_tpp' => '022/SGX/2026', 'tgl_terbit' => '2026-10-03', 'tgl_berakhir' => '2031-08-03']);
        DB::table('masatpp')->insert(['cabang' => 'Sumatera Selatan', 'name' => 'PT. Bintang Gasing Persada', 'no_tpp' => '008/SFX/2024', 'tgl_terbit' => '2024-02-16', 'tgl_berakhir' => '2028-02-14']);
        DB::table('masatpp')->insert(['cabang' => 'Sumatera Selatan', 'name' => 'PT. Bumi Beliti Abadi', 'no_tpp' => '011/SGG/2025', 'tgl_terbit' => '2025-04-16', 'tgl_berakhir' => '2029-09-04']);
        DB::table('masatpp')->insert(['cabang' => 'Sumatera Selatan', 'name' => 'PT. Fajar Berseri', 'no_tpp' => null, 'tgl_terbit' => null, 'tgl_berakhir' => null]);
        DB::table('masatpp')->insert(['cabang' => 'Sumatera Selatan', 'name' => 'PT Gadjah Ruku', 'no_tpp' => '001/SBF/2024', 'tgl_terbit' => '2024-01-03', 'tgl_berakhir' => '2028-01-01']);
        DB::table('masatpp')->insert(['cabang' => 'Sumatera Selatan', 'name' => 'PT. Hevea MK  I', 'no_tpp' => null, 'tgl_terbit' => '1900-01-01', 'tgl_berakhir' => '1900-01-01']);
        DB::table('masatpp')->insert(['cabang' => 'Sumatera Selatan', 'name' => 'PT. Hevea MK II', 'no_tpp' => '007/SEA/2026', 'tgl_terbit' => '2023-02-26', 'tgl_berakhir' => '2029-05-18']);
        DB::table('masatpp')->insert(['cabang' => 'Sumatera Selatan', 'name' => 'PT. Hok Tong ', 'no_tpp' => null, 'tgl_terbit' => '1900-01-01', 'tgl_berakhir' => '1900-01-01']);
        DB::table('masatpp')->insert(['cabang' => 'Sumatera Selatan', 'name' => 'PT. Hok Tong II', 'no_tpp' => '016/SGO/2023', 'tgl_terbit' => '2023-01-11', 'tgl_berakhir' => '2027-10-27']);
        DB::table('masatpp')->insert(['cabang' => 'Sumatera Selatan', 'name' => 'PT. Kirana Musi Persada', 'no_tpp' => ' 025/SFN/2026', 'tgl_terbit' => '2026-03-16', 'tgl_berakhir' => '2031-09-03']);
        DB::table('masatpp')->insert(['cabang' => 'Sumatera Selatan', 'name' => 'PT. Kirana Permata', 'no_tpp' => '023/SGP/2026', 'tgl_terbit' => '2026-03-16', 'tgl_berakhir' => '2031-09-03']);
        DB::table('masatpp')->insert(['cabang' => 'Sumatera Selatan', 'name' => 'PT. Kirana Windu', 'no_tpp' => '019/SFW/2026', 'tgl_terbit' => '2026-06-03', 'tgl_berakhir' => '2031-04-03']);
        DB::table('masatpp')->insert(['cabang' => 'Sumatera Selatan', 'name' => 'PT. Karini Utama', 'no_tpp' => '024/SFA/2026', 'tgl_terbit' => '2026-03-16', 'tgl_berakhir' => '2031-03-10']);
        DB::table('masatpp')->insert(['cabang' => 'Sumatera Selatan', 'name' => 'PT.  Lingga Djaya', 'no_tpp' => '014/SEE/2024', 'tgl_terbit' => '2024-05-15', 'tgl_berakhir' => '2028-05-12']);
        DB::table('masatpp')->insert(['cabang' => 'Sumatera Selatan', 'name' => 'PT. PP London Sumatra Indonesia, Tbk', 'no_tpp' => null, 'tgl_terbit' => null, 'tgl_berakhir' => null]);
        DB::table('masatpp')->insert(['cabang' => 'Sumatera Selatan', 'name' => 'PT. Mardec Musi Lestari', 'no_tpp' => null, 'tgl_terbit' => null, 'tgl_berakhir' => null]);
        DB::table('masatpp')->insert(['cabang' => 'Sumatera Selatan', 'name' => 'PT. Pancasamudera Simpati', 'no_tpp' => '006/SDO/2024', 'tgl_terbit' => '2024-12-02', 'tgl_berakhir' => '2028-04-02']);
        DB::table('masatpp')->insert(['cabang' => 'Sumatera Selatan', 'name' => 'PT. Pinago Utama, Tbk', 'no_tpp' => '004/sfk/2025', 'tgl_terbit' => '2025-02-05', 'tgl_berakhir' => '2029-01-14']);
        DB::table('masatpp')->insert(['cabang' => 'Sumatera Selatan', 'name' => 'PT. Prasida Aneka Niaga', 'no_tpp' => null, 'tgl_terbit' => null, 'tgl_berakhir' => null]);
        DB::table('masatpp')->insert(['cabang' => 'Sumatera Selatan', 'name' => 'PT. Prasida Aneka Niaga Unit II', 'no_tpp' => null, 'tgl_terbit' => null, 'tgl_berakhir' => null]);
        DB::table('masatpp')->insert(['cabang' => 'Sumatera Selatan', 'name' => 'PT Remco Rubber Indonesia', 'no_tpp' => '018/SDQ/2023', 'tgl_terbit' => '2023-11-27', 'tgl_berakhir' => '2027-11-10']);
        DB::table('masatpp')->insert(['cabang' => 'Sumatera Selatan', 'name' => 'PT. Sri Trang Lingga Indonesia', 'no_tpp' => '0036/TPP-SIR/05/2024', 'tgl_terbit' => '2024-05-08', 'tgl_berakhir' => '2028-04-30']);
        DB::table('masatpp')->insert(['cabang' => 'Sumatera Selatan', 'name' => 'PT. Sunan Rubber', 'no_tpp' => '015/SCY/2023', 'tgl_terbit' => '2023-10-30', 'tgl_berakhir' => '2026-12-10']);
        DB::table('masatpp')->insert(['cabang' => 'Sumatera Selatan', 'name' => 'PT. Warna Agung Selatan', 'no_tpp' => ' 012/SHA/2025', 'tgl_terbit' => '2025-06-18', 'tgl_berakhir' => ' 2029/6/15']);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('masatpp');
    }
};

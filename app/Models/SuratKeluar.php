<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class SuratKeluar extends Model
{
    use HasFactory;

    public function getDataSurat()
    {
        $data = DB::table('surat_keluar')
            ->orderBy('id', 'asc')
            ->get();

        return $data;
    }

    public function getData()
    {
        // Mengambil 2 data surat keluar paling baru berdasarkan id/tanggal input terbaru
        $suratKeluarTerbaru = DB::table('surat_keluar')
            ->orderBy('id', 'desc') // atau gunakan 'created_at' jika ada
            ->limit(2)
            ->get();

        return $suratKeluarTerbaru;
    }

    public function getDataRow()
    {
        // row
        $dataRow = DB::table('surat_keluar')->count();
        return $dataRow;
    }

    public function findSuratKeluar($id)
    {
        $surat = DB::table('surat_keluar')->where('id', $id)->first();
        return $surat;
    }
}

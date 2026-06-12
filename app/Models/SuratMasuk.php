<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class SuratMasuk extends Model
{
    use HasFactory;

    public function getDataSurat()
    {
        $data = DB::table('surat_masuks')
            ->latest('id')
            ->get();

        return $data;
    }

    public function getData()
    {
        $get = DB::table('surat_masuks')->orderBy('id', 'desc') // atau gunakan 'created_at' jika ada
            ->limit(2)
            ->get();
        return $get;
    }

    public function getDataRow()
    {
        // row
        $dataRow = DB::table('surat_masuks')->count();
        return $dataRow;
    }

    public function findSuratMasuk($id)
    {
        $surat = DB::table('surat_masuks')->where('id', $id)->first();
        return $surat;
    }
}

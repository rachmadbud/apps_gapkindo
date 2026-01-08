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

    public function getDataRow()
    {
        $row = DB::table('surat_keluar')->count();
        return $row;
    }
}

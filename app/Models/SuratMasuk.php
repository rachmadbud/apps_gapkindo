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
            ->orderBy('id', 'asc')
            ->get();

        return $data;
    }
}

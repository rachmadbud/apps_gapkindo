<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Publikasi extends Model
{
    use HasFactory;

    public function getDataPublikasi()
    {
        // Implementation for fetching publikasi data
        $data = DB::table('publikasi')
            ->orderBy('id', 'asc')
            ->get();

        return $data;
    }
}

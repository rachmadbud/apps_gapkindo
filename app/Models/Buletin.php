<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Buletin extends Model
{
    use HasFactory;

    public function getDataBuletin()
    {
        $data = DB::table('buletins')
            ->orderBy('id', 'asc')
            ->get();

        return $data;
    }

    public function getDataBuletinById($id)
    {
        $data = DB::table('buletins')
            ->where('id', $id)
            ->first();

        return $data;
    }
}

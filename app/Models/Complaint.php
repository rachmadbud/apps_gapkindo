<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Complaint extends Model
{
    use HasFactory;
    protected $table = 'complaints';
    protected $fillable = [
        'email',
        'permasalahan',
        'harapan',
    ];

    public function getDataSurat()
    {
        $data = DB::table('complaints')
            ->orderBy('id', 'asc')
            ->get();

        return $data;
    }
}

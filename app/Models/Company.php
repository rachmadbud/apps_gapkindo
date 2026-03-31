<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'expired_at',
        'reminder_sent_at'
    ];

    protected $casts = [
        'expired_at' => 'datetime',
        'reminder_sent_at' => 'datetime',
    ];
}

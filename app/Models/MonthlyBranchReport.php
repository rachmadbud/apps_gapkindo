<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MonthlyBranchReport extends Model
{
    protected $fillable = [
        'branch_user_id',
        'report_month',
        'report_year',
        'status',
        'admin_note',
    ];

    public function branchUser(): BelongsTo
    {
        return $this->belongsTo(User::class, 'branch_user_id');
    }

    public function uploads(): HasMany
    {
        return $this->hasMany(MonthlyBranchReportUpload::class, 'report_id');
    }

    public function latestUpload()
    {
        return $this->hasOne(MonthlyBranchReportUpload::class, 'report_id')->latestOfMany();
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(MonthlyBranchReportReview::class, 'report_id');
    }
}

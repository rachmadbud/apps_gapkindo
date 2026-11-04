<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MonthlyBranchReportReview extends Model
{
    protected $fillable = [
        'report_id',
        'upload_id',
        'reviewer_id',
        'action',
        'note',
    ];

    public function report(): BelongsTo
    {
        return $this->belongsTo(MonthlyBranchReport::class, 'report_id');
    }

    public function upload(): BelongsTo
    {
        return $this->belongsTo(MonthlyBranchReportUpload::class, 'upload_id');
    }

    public function reviewer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'reviewer_id');
    }
}

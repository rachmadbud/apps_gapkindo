<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MonthlyBranchReportUpload extends Model
{
    protected $fillable = [
        'report_id',
        'uploaded_by',
        'original_filename',
        'stored_path',
        'file_size',
        'company_count',
        'totals',
        'source_totals',
        'warnings',
    ];

    protected $casts = [
        'totals' => 'array',
        'source_totals' => 'array',
        'warnings' => 'array',
    ];

    public function report(): BelongsTo
    {
        return $this->belongsTo(MonthlyBranchReport::class, 'report_id');
    }

    public function rows(): HasMany
    {
        return $this->hasMany(MonthlyBranchReportRow::class, 'upload_id');
    }
}

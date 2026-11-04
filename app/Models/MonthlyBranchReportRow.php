<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MonthlyBranchReportRow extends Model
{
    protected $fillable = [
        'upload_id',
        'source_row',
        'source_number',
        'company_name',
        'capacity',
        'tpp_code',
        'rubber_type',
        'operating_factor',
        'production',
        'local_sales',
        'export_sales',
        'total_sales',
        'raw_data',
    ];

    protected $casts = [
        'raw_data' => 'array',
    ];

    public function upload(): BelongsTo
    {
        return $this->belongsTo(MonthlyBranchReportUpload::class, 'upload_id');
    }
}

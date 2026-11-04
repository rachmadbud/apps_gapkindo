<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('monthly_branch_reports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('branch_user_id')->constrained('users');
            $table->unsignedTinyInteger('report_month');
            $table->unsignedSmallInteger('report_year');
            $table->string('status', 24)->default('pending_review');
            $table->text('admin_note')->nullable();
            $table->timestamps();

            $table->unique(['branch_user_id', 'report_year', 'report_month'], 'monthly_branch_report_period_unique');
            $table->index(['report_year', 'report_month', 'status'], 'monthly_branch_report_period_status_index');
        });

        Schema::create('monthly_branch_report_uploads', function (Blueprint $table) {
            $table->id();
            $table->foreignId('report_id')->constrained('monthly_branch_reports')->cascadeOnDelete();
            $table->foreignId('uploaded_by')->nullable()->constrained('users')->nullOnDelete();
            $table->text('original_filename');
            $table->string('stored_path');
            $table->unsignedBigInteger('file_size');
            $table->unsignedInteger('company_count');
            $table->json('totals');
            $table->json('source_totals')->nullable();
            $table->json('warnings')->nullable();
            $table->timestamps();
        });

        Schema::create('monthly_branch_report_rows', function (Blueprint $table) {
            $table->id();
            $table->foreignId('upload_id')->constrained('monthly_branch_report_uploads')->cascadeOnDelete();
            $table->unsignedInteger('source_row');
            $table->string('source_number')->nullable();
            $table->text('company_name');
            $table->decimal('capacity', 18, 3)->nullable();
            $table->string('tpp_code')->nullable();
            $table->string('rubber_type')->nullable();
            $table->decimal('operating_factor', 18, 3)->nullable();
            $table->decimal('production', 18, 3)->nullable();
            $table->decimal('local_sales', 18, 3)->nullable();
            $table->decimal('export_sales', 18, 3)->nullable();
            $table->decimal('total_sales', 18, 3)->nullable();
            $table->json('raw_data');
            $table->timestamps();
        });

        Schema::create('monthly_branch_report_reviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('report_id')->constrained('monthly_branch_reports')->cascadeOnDelete();
            $table->foreignId('upload_id')->nullable()->constrained('monthly_branch_report_uploads')->nullOnDelete();
            $table->foreignId('reviewer_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('action', 24);
            $table->text('note')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('monthly_branch_report_reviews');
        Schema::dropIfExists('monthly_branch_report_rows');
        Schema::dropIfExists('monthly_branch_report_uploads');
        Schema::dropIfExists('monthly_branch_reports');
    }
};

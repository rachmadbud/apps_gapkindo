<?php

namespace Tests\Feature;

use App\Http\Middleware\UserActivity;
use App\Models\User;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class MonthlyBranchReportAccessTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        config([
            'database.default' => 'sqlite',
            'database.connections.sqlite' => [
                'driver' => 'sqlite',
                'database' => ':memory:',
                'prefix' => '',
                'foreign_key_constraints' => true,
            ],
        ]);
        DB::purge('sqlite');

        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('password');
            $table->unsignedBigInteger('id_role');
            $table->unsignedBigInteger('id_unit_kerja');
            $table->timestamp('last_seen')->nullable();
        });
        Schema::create('tbl_master_role', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
        });
        Schema::create('monthly_branch_reports', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('branch_user_id');
            $table->unsignedTinyInteger('report_month');
            $table->unsignedSmallInteger('report_year');
            $table->string('status');
            $table->text('admin_note')->nullable();
        });

        DB::table('tbl_master_role')->insert(['id' => 2, 'nama' => 'CABANG']);
        DB::table('users')->insert([
            ['id' => 1, 'name' => 'SUMUT', 'email' => 'sumut@example.test', 'password' => 'unused', 'id_role' => 2, 'id_unit_kerja' => 2],
            ['id' => 2, 'name' => 'JATIM', 'email' => 'jatim@example.test', 'password' => 'unused', 'id_role' => 2, 'id_unit_kerja' => 2],
        ]);
        DB::table('monthly_branch_reports')->insert([
            'id' => 1,
            'branch_user_id' => 1,
            'report_month' => 7,
            'report_year' => 2026,
            'status' => 'pending_review',
        ]);

        $this->withoutMiddleware(UserActivity::class);
    }

    public function test_a_branch_cannot_open_another_branch_report(): void
    {
        $branchUser = new User();
        $branchUser->forceFill([
            'id' => 2,
            'name' => 'JATIM',
            'id_role' => 2,
            'id_unit_kerja' => 2,
        ]);

        $response = $this->actingAs($branchUser)->get('/laporanPenjualan/1');

        $response->assertForbidden();
    }

    public function test_a_branch_can_download_template_and_upload_guide(): void
    {
        $branchUser = new User();
        $branchUser->forceFill([
            'id' => 1,
            'name' => 'SUMUT',
            'id_role' => 2,
            'id_unit_kerja' => 2,
        ]);
        $this->actingAs($branchUser);

        $this->get('/laporanPenjualan/template')
            ->assertOk()
            ->assertHeader('content-type', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');

        $this->get('/laporanPenjualan/panduan')
            ->assertOk()
            ->assertHeader('content-type', 'application/pdf');
    }
}

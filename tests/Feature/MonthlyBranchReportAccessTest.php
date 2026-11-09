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
            $table->text('id_menu')->nullable();
            $table->text('id_submenu')->nullable();
        });
        Schema::create('tbl_master_unit_kerja', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
        });
        Schema::create('tbl_master_menu', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->text('link');
            $table->string('status_data');
            $table->integer('urutan');
        });
        Schema::create('tbl_master_submenu', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->unsignedBigInteger('id_menu');
            $table->text('link');
            $table->string('status_data');
            $table->integer('urutan');
        });
        Schema::create('monthly_branch_reports', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('branch_user_id');
            $table->unsignedTinyInteger('report_month');
            $table->unsignedSmallInteger('report_year');
            $table->string('status');
            $table->text('admin_note')->nullable();
        });
        Schema::create('monthly_branch_report_uploads', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('report_id');
            $table->string('original_filename');
            $table->timestamps();
        });

        DB::table('tbl_master_role')->insert([
            'id' => 2,
            'nama' => 'CABANG',
            'id_menu' => '1',
            'id_submenu' => '1',
        ]);
        DB::table('tbl_master_role')->insert([
            'id' => 3,
            'nama' => 'SEKRETARIAT PUSAT',
            'id_menu' => '1',
            'id_submenu' => '15',
        ]);
        DB::table('tbl_master_role')->insert([
            'id' => 4,
            'nama' => 'PENGGUNA TANPA AKSES LAPORAN',
            'id_menu' => '1',
            'id_submenu' => '1',
        ]);
        DB::table('tbl_master_unit_kerja')->insert(['id' => 2, 'nama' => 'Unit Cabang']);
        DB::table('tbl_master_menu')->insert([
            'id' => 1,
            'nama' => 'Laporan',
            'link' => '#',
            'status_data' => '1',
            'urutan' => 1,
        ]);
        DB::table('tbl_master_submenu')->insert([
            'id' => 1,
            'nama' => 'Rekapitulasi',
            'id_menu' => 1,
            'link' => '/not-laporan-penjualan',
            'status_data' => '1',
            'urutan' => 1,
        ]);
        DB::table('tbl_master_submenu')->insert([
            'id' => 15,
            'nama' => 'Laporan Penjualan',
            'id_menu' => 1,
            'link' => '/laporanPenjualan',
            'status_data' => '1',
            'urutan' => 15,
        ]);
        DB::table('users')->insert([
            ['id' => 1, 'name' => 'SUMUT', 'email' => 'sumut@example.test', 'password' => 'unused', 'id_role' => 2, 'id_unit_kerja' => 2],
            ['id' => 2, 'name' => 'JATIM', 'email' => 'jatim@example.test', 'password' => 'unused', 'id_role' => 2, 'id_unit_kerja' => 2],
            ['id' => 3, 'name' => 'Zarfian', 'email' => 'zarfian@example.test', 'password' => 'unused', 'id_role' => 3, 'id_unit_kerja' => 2],
            ['id' => 4, 'name' => 'Tanpa Akses', 'email' => 'no-access@example.test', 'password' => 'unused', 'id_role' => 4, 'id_unit_kerja' => 2],
        ]);
        DB::table('monthly_branch_reports')->insert([
            'id' => 1,
            'branch_user_id' => 1,
            'report_month' => 7,
            'report_year' => 2026,
            'status' => 'pending_review',
        ]);
        DB::table('monthly_branch_reports')->insert([
            'id' => 2,
            'branch_user_id' => 1,
            'report_month' => 8,
            'report_year' => 2025,
            'status' => 'approved',
        ]);
        DB::table('monthly_branch_reports')->insert([
            'id' => 3,
            'branch_user_id' => 2,
            'report_month' => 8,
            'report_year' => 2025,
            'status' => 'approved',
        ]);
        DB::table('monthly_branch_report_uploads')->insert([
            ['id' => 1, 'report_id' => 1, 'original_filename' => 'laporan-2026.xlsx'],
            ['id' => 2, 'report_id' => 2, 'original_filename' => 'laporan-2025.xlsx'],
            ['id' => 3, 'report_id' => 3, 'original_filename' => 'laporan-jatim-2025.xlsx'],
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

    public function test_a_branch_can_filter_report_history_by_year(): void
    {
        $branchUser = new User();
        $branchUser->forceFill([
            'id' => 1,
            'name' => 'SUMUT',
            'id_role' => 2,
            'id_unit_kerja' => 2,
        ]);

        $this->actingAs($branchUser)
            ->get('/laporanPenjualan?history_year=2025')
            ->assertOk()
            ->assertSee('type="number"', false)
            ->assertSee('min="2000"', false)
            ->assertSee('max="2100"', false)
            ->assertSee('laporan-2025.xlsx')
            ->assertDontSee('laporan-2026.xlsx')
            ->assertDontSee('laporan-jatim-2025.xlsx');
    }

    public function test_user_with_report_submenu_permission_can_open_the_admin_dashboard(): void
    {
        $secretariatUser = new User();
        $secretariatUser->forceFill([
            'id' => 3,
            'name' => 'Zarfian',
            'id_role' => 3,
            'id_unit_kerja' => 2,
        ]);

        $this->actingAs($secretariatUser)
            ->get('/laporanPenjualan')
            ->assertOk()
            ->assertSee('Monitoring Laporan Bulanan Cabang Admin');
    }

    public function test_user_without_report_submenu_permission_cannot_open_the_dashboard(): void
    {
        $user = new User();
        $user->forceFill([
            'id' => 4,
            'name' => 'Tanpa Akses',
            'id_role' => 4,
            'id_unit_kerja' => 2,
        ]);

        $this->actingAs($user)
            ->get('/laporanPenjualan')
            ->assertForbidden();
    }
}

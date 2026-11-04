<?php

namespace App\Http\Controllers;

use App\Models\MonthlyBranchReport;
use App\Models\MonthlyBranchReportUpload;
use App\Models\SidebarModel;
use App\Services\MonthlyBranchReportExcelParser;
use App\Services\MonthlyBranchReportTemplate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use RuntimeException;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Throwable;

class MonthlyBranchReportController extends Controller
{
    private const STATUS_PENDING = 'pending_review';
    private const STATUS_REVISION = 'needs_revision';
    private const STATUS_APPROVED = 'approved';

    public function index(Request $request)
    {
        $role = $this->roleName();
        abort_unless($this->isBranchRole($role) || $this->isAdminRole($role), 403);

        if ($this->isBranchRole($role)) {
            return $this->branchDashboard($request);
        }

        return $this->adminDashboard($request);
    }

    public function downloadTemplate()
    {
        $this->ensureBranch();
        $spreadsheet = app(MonthlyBranchReportTemplate::class)->create(auth()->user()->name);
        $filename = 'Template_Laporan_Bulanan_' . Str::slug(auth()->user()->name) . '.xlsx';

        return response()->streamDownload(function () use ($spreadsheet) {
            (new Xlsx($spreadsheet))->save('php://output');
            $spreadsheet->disconnectWorksheets();
        }, $filename, [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        ]);
    }

    public function downloadGuide()
    {
        $this->ensureBranch();

        return \Barryvdh\DomPDF\Facade\Pdf::loadView('laporanPenjualan.guide')
            ->setPaper('a4')
            ->download('Panduan_Upload_Laporan_Bulanan.pdf');
    }

    public function preview(Request $request, MonthlyBranchReportExcelParser $parser)
    {
        $this->ensureBranch();
        $validated = $request->validate([
            'report_month' => ['required', 'integer', 'between:1,12'],
            'report_year' => ['required', 'integer', 'between:2000,2100'],
            'file' => ['required', 'file', 'mimes:xlsx,xls', 'max:10240'],
        ], [
            'file.mimes' => 'Format file harus .xlsx atau .xls.',
            'file.max' => 'Ukuran file maksimal 10 MB.',
        ]);

        $this->assertCanUpload((int) $validated['report_month'], (int) $validated['report_year']);

        try {
            $preview = $parser->parse($request->file('file')->getRealPath());
        } catch (RuntimeException $exception) {
            return redirect()->route('laporanPenjualan.index')
                ->withInput()
                ->withErrors(['file' => $exception->getMessage()]);
        }

        $previewToken = null;
        if ($preview['errors'] === []) {
            $previewToken = (string) Str::uuid();
            $temporaryPath = $request->file('file')->storeAs(
                'branch-reports/tmp/' . auth()->id(),
                $previewToken . '.' . strtolower($request->file('file')->getClientOriginalExtension()),
                'local'
            );
            if ($temporaryPath === false) {
                throw new RuntimeException('File sementara tidak dapat disimpan. Silakan coba kembali.');
            }

            $request->session()->put('branch_report_previews.' . $previewToken, [
                'path' => $temporaryPath,
                'original_filename' => $request->file('file')->getClientOriginalName(),
                'file_size' => $request->file('file')->getSize(),
                'report_month' => (int) $validated['report_month'],
                'report_year' => (int) $validated['report_year'],
            ]);
        }

        toast(
            $preview['errors'] === []
                ? 'File Excel berhasil dibaca. Silakan periksa preview sebelum mengirim laporan.'
                : 'Preview selesai, tetapi ada data tidak valid yang harus diperbaiki.',
            $preview['errors'] === [] ? 'success' : 'warning'
        );

        return $this->branchDashboard($request, $preview, $previewToken, array_merge($validated, [
            'original_filename' => $request->file('file')->getClientOriginalName(),
            'file_size' => $request->file('file')->getSize(),
        ]));
    }

    public function store(Request $request, MonthlyBranchReportExcelParser $parser)
    {
        $this->ensureBranch();
        $validated = $request->validate([
            'preview_token' => ['required', 'uuid'],
        ]);
        $previewKey = 'branch_report_previews.' . $validated['preview_token'];
        $temporary = $request->session()->get($previewKey);
        abort_unless(is_array($temporary) && !empty($temporary['path']), 422, 'Preview kedaluwarsa. Silakan pilih ulang file Excel.');
        abort_unless(Storage::disk('local')->exists($temporary['path']), 422, 'File preview tidak ditemukan. Silakan pilih ulang file Excel.');

        $month = (int) $temporary['report_month'];
        $year = (int) $temporary['report_year'];
        $this->assertCanUpload($month, $year);

        $parsed = $parser->parse(Storage::disk('local')->path($temporary['path']));
        if ($parsed['errors'] !== []) {
            throw ValidationException::withMessages([
                'file' => 'Data Excel mengandung nilai tidak valid. Perbaiki file lalu unggah ulang untuk preview.',
            ]);
        }

        $extension = strtolower(pathinfo($temporary['original_filename'], PATHINFO_EXTENSION));
        $storedPath = 'branch-reports/files/' . auth()->id() . '/' . $year . '/'
            . sprintf('%02d', $month) . '/' . Str::uuid() . '.' . $extension;
        $temporaryFile = new \Illuminate\Http\File(Storage::disk('local')->path($temporary['path']));
        $savedPath = Storage::disk('local')->putFileAs(dirname($storedPath), $temporaryFile, basename($storedPath));
        if ($savedPath === false) {
            throw new RuntimeException('File laporan tidak dapat disimpan. Silakan coba kembali.');
        }

        try {
            DB::transaction(function () use ($month, $year, $parsed, $temporary, $storedPath) {
                DB::table('users')->where('id', auth()->id())->lockForUpdate()->first();
                $report = MonthlyBranchReport::query()
                    ->where('branch_user_id', auth()->id())
                    ->where('report_month', $month)
                    ->where('report_year', $year)
                    ->lockForUpdate()
                    ->first();

                if ($report && $report->status !== self::STATUS_REVISION) {
                    throw ValidationException::withMessages([
                        'report_month' => 'Periode ini sudah diunggah dan tidak dapat diganti saat menunggu review atau setelah disetujui.',
                    ]);
                }

                if (!$report) {
                    $report = MonthlyBranchReport::create([
                        'branch_user_id' => auth()->id(),
                        'report_month' => $month,
                        'report_year' => $year,
                        'status' => self::STATUS_PENDING,
                    ]);
                    $action = 'uploaded';
                } else {
                    $report->status = self::STATUS_PENDING;
                    $report->admin_note = null;
                    $report->save();
                    $action = 'revised';
                }

                $upload = $report->uploads()->create([
                    'uploaded_by' => auth()->id(),
                    'original_filename' => $temporary['original_filename'],
                    'stored_path' => $storedPath,
                    'file_size' => $temporary['file_size'],
                    'company_count' => count($parsed['rows']),
                    'totals' => $parsed['totals'],
                    'source_totals' => $parsed['source_totals'],
                    'warnings' => $parsed['warnings'],
                ]);
                $upload->rows()->createMany($parsed['rows']);

                $report->reviews()->create([
                    'upload_id' => $upload->id,
                    'reviewer_id' => auth()->id(),
                    'action' => $action,
                    'note' => null,
                ]);
            });
        } catch (Throwable $exception) {
            Storage::disk('local')->delete($storedPath);
            throw $exception;
        }

        Storage::disk('local')->delete($temporary['path']);
        $request->session()->forget($previewKey);

        toast('Laporan berhasil diunggah dan menunggu review Pusat.', 'success');

        return redirect()->route('laporanPenjualan.index');
    }

    public function show(MonthlyBranchReport $report)
    {
        $this->authorizeReport($report);
        $report->load(['branchUser', 'latestUpload.rows', 'uploads', 'reviews.reviewer']);

        return view('laporanPenjualan.detail', array_merge($this->sidebarData(), [
            'report' => $report,
            'isAdmin' => $this->isAdminRole($this->roleName()),
        ]));
    }

    public function approve(MonthlyBranchReport $report)
    {
        $this->ensureAdmin();
        $this->review($report, self::STATUS_APPROVED, 'approved', null);

        toast('Laporan berhasil disetujui.', 'success');

        return redirect()->route('laporanPenjualan.show', $report);
    }

    public function requestRevision(Request $request, MonthlyBranchReport $report)
    {
        $this->ensureAdmin();
        $validated = $request->validate([
            'note' => ['required', 'string', 'min:5', 'max:2000'],
        ], [
            'note.required' => 'Catatan revisi wajib diisi.',
            'note.min' => 'Catatan revisi minimal 5 karakter.',
        ]);

        $this->review($report, self::STATUS_REVISION, 'revision_requested', $validated['note']);

        toast('Laporan dikembalikan kepada cabang untuk direvisi.', 'success');

        return redirect()->route('laporanPenjualan.show', $report);
    }

    public function download(MonthlyBranchReport $report, MonthlyBranchReportUpload $upload): StreamedResponse
    {
        $this->authorizeReport($report);
        abort_unless((int) $upload->report_id === (int) $report->id, 404);
        abort_unless(Storage::disk('local')->exists($upload->stored_path), 404, 'File laporan tidak ditemukan.');

        return Storage::disk('local')->download($upload->stored_path, $upload->original_filename);
    }

    private function branchDashboard(Request $request, ?array $preview = null, ?string $previewToken = null, array $selected = [])
    {
        $user = auth()->user();
        $revisionReport = MonthlyBranchReport::query()
            ->where('branch_user_id', $user->id)
            ->where('status', self::STATUS_REVISION)
            ->orderByDesc('report_year')
            ->orderByDesc('report_month')
            ->first();
        $selectedMonth = (int) ($selected['report_month'] ?? $request->old('report_month', $revisionReport->report_month ?? now()->month));
        $selectedYear = (int) ($selected['report_year'] ?? $request->old('report_year', $revisionReport->report_year ?? now()->year));
        $unitName = DB::table('tbl_master_unit_kerja')
            ->where('id', $user->id_unit_kerja)
            ->value('nama');

        $reports = MonthlyBranchReport::query()
            ->with('latestUpload')
            ->withCount('uploads')
            ->where('branch_user_id', $user->id)
            ->orderByDesc('report_year')
            ->orderByDesc('report_month')
            ->paginate(10);
        $currentReport = MonthlyBranchReport::query()
            ->where('branch_user_id', $user->id)
            ->where('report_month', $selectedMonth)
            ->where('report_year', $selectedYear)
            ->first();

        return view('laporanPenjualan.branch', array_merge($this->sidebarData(), [
            'branch' => [
                'name' => $user->name,
                'code' => $user->name,
                'unit_name' => $unitName ?: 'Cabang',
                'user_name' => $user->name,
            ],
            'reports' => $reports,
            'currentReport' => $currentReport,
            'preview' => $preview,
            'previewToken' => $previewToken,
            'previewFileName' => $selected['original_filename'] ?? null,
            'previewFileSize' => $selected['file_size'] ?? null,
            'selectedMonth' => $selectedMonth,
            'selectedYear' => $selectedYear,
        ]));
    }

    private function adminDashboard(Request $request)
    {
        $filters = [
            'month' => (int) $request->query('month', now()->month),
            'year' => (int) $request->query('year', now()->year),
            'branch' => $request->query('branch'),
            'status' => $request->query('status', ''),
        ];
        abort_if($filters['month'] < 1 || $filters['month'] > 12 || $filters['year'] < 2000 || $filters['year'] > 2100, 422);
        abort_if(!in_array($filters['status'], ['', 'not_uploaded', self::STATUS_PENDING, self::STATUS_REVISION, self::STATUS_APPROVED], true), 422);

        $branchRoleId = DB::table('tbl_master_role')->whereRaw('UPPER(nama) = ?', ['CABANG'])->value('id');
        abort_if(!$branchRoleId, 403, 'Role CABANG belum dikonfigurasi.');

        $branchUsers = DB::table('users')
            ->where('id_role', $branchRoleId)
            ->orderBy('name')
            ->get(['id', 'name']);
        $reportCounts = MonthlyBranchReport::query()
            ->where('report_month', $filters['month'])
            ->where('report_year', $filters['year']);

        $stats = [
            'branches' => $branchUsers->count(),
            'uploaded' => (clone $reportCounts)->count(),
            'pending' => (clone $reportCounts)->where('status', self::STATUS_PENDING)->count(),
            'approved' => (clone $reportCounts)->where('status', self::STATUS_APPROVED)->count(),
            'revision' => (clone $reportCounts)->where('status', self::STATUS_REVISION)->count(),
        ];
        $stats['not_uploaded'] = max(0, $stats['branches'] - $stats['uploaded']);

        $query = DB::table('users as u')
            ->join('tbl_master_role as role', 'role.id', '=', 'u.id_role')
            ->leftJoin('monthly_branch_reports as report', function ($join) use ($filters) {
                $join->on('report.branch_user_id', '=', 'u.id')
                    ->where('report.report_month', '=', $filters['month'])
                    ->where('report.report_year', '=', $filters['year']);
            })
            ->where('role.id', $branchRoleId)
            ->select([
                'u.id as branch_user_id',
                'u.name as branch_name',
                'report.id as report_id',
                'report.status',
                'report.admin_note',
                'report.report_month',
                'report.report_year',
            ])
            ->addSelect([
                'uploaded_at' => DB::table('monthly_branch_report_uploads')
                    ->select('created_at')
                    ->whereColumn('report_id', 'report.id')
                    ->orderByDesc('id')
                    ->limit(1),
                'filename' => DB::table('monthly_branch_report_uploads')
                    ->select('original_filename')
                    ->whereColumn('report_id', 'report.id')
                    ->orderByDesc('id')
                    ->limit(1),
            ]);

        if ($filters['branch'] !== null && $filters['branch'] !== '') {
            $query->where('u.id', (int) $filters['branch']);
        }
        if ($filters['status'] === 'not_uploaded') {
            $query->whereNull('report.id');
        } elseif ($filters['status'] !== '') {
            $query->where('report.status', $filters['status']);
        }

        $reports = $query->orderBy('u.name')->paginate(15)->withQueryString();

        return view('laporanPenjualan.admin', array_merge($this->sidebarData(), [
            'reports' => $reports,
            'branches' => $branchUsers,
            'filters' => $filters,
            'stats' => $stats,
        ]));
    }

    private function assertCanUpload(int $month, int $year): void
    {
        $report = MonthlyBranchReport::query()
            ->where('branch_user_id', auth()->id())
            ->where('report_month', $month)
            ->where('report_year', $year)
            ->first();

        if ($report && $report->status !== self::STATUS_REVISION) {
            throw ValidationException::withMessages([
                'report_month' => 'Periode ini sudah diunggah dan tidak dapat diganti saat menunggu review atau setelah disetujui.',
            ]);
        }
    }

    private function review(MonthlyBranchReport $report, string $status, string $action, ?string $note): void
    {
        DB::transaction(function () use ($report, $status, $action, $note) {
            $lockedReport = MonthlyBranchReport::query()->lockForUpdate()->findOrFail($report->id);
            if ($lockedReport->status !== self::STATUS_PENDING) {
                throw ValidationException::withMessages([
                    'report' => 'Hanya laporan yang menunggu review yang dapat diproses.',
                ]);
            }

            $latestUpload = $lockedReport->uploads()->latest('id')->first();
            if (!$latestUpload) {
                throw new RuntimeException('Laporan tidak memiliki file yang dapat direview.');
            }

            $lockedReport->update([
                'status' => $status,
                'admin_note' => $note,
            ]);
            $lockedReport->reviews()->create([
                'upload_id' => $latestUpload->id,
                'reviewer_id' => auth()->id(),
                'action' => $action,
                'note' => $note,
            ]);
        });
    }

    private function roleName(): string
    {
        return strtoupper(trim((string) DB::table('tbl_master_role')->where('id', auth()->user()->id_role)->value('nama')));
    }

    private function isBranchRole(string $role): bool
    {
        return $role === 'CABANG';
    }

    private function isAdminRole(string $role): bool
    {
        return in_array($role, ['SUPERUSER', 'ADMIN', 'ADMINISTRATOR'], true);
    }

    private function ensureBranch(): void
    {
        abort_unless($this->isBranchRole($this->roleName()), 403);
    }

    private function ensureAdmin(): void
    {
        abort_unless($this->isAdminRole($this->roleName()), 403);
    }

    private function sidebarData(): array
    {
        return (new SidebarModel())->getMenu();
    }

    private function authorizeReport(MonthlyBranchReport $report): void
    {
        $role = $this->roleName();
        abort_unless(
            $this->isAdminRole($role)
                || ($this->isBranchRole($role) && (int) $report->branch_user_id === (int) auth()->id()),
            403
        );
    }
}

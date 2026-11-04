<?php

namespace Tests\Unit;

use App\Services\MonthlyBranchReportExcelParser;
use App\Services\MonthlyBranchReportTemplate;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Cell\DataType;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Tests\TestCase;

class MonthlyBranchReportExcelParserTest extends TestCase
{
    public function test_report_views_compile(): void
    {
        foreach ([
            'resources/views/laporanPenjualan/branch.blade.php',
            'resources/views/laporanPenjualan/admin.blade.php',
            'resources/views/laporanPenjualan/detail.blade.php',
            'resources/views/laporanPenjualan/guide.blade.php',
            'resources/views/laporanPenjualan/_styles.blade.php',
            'resources/views/layouts/sidebar.blade.php',
        ] as $view) {
            $compiled = app('blade.compiler')->compileString(file_get_contents(base_path($view)));
            $this->assertNotEmpty($compiled, $view . ' should compile');
        }
    }

    public function test_it_reads_multi_row_headers_repeated_numbers_and_excludes_total_row(): void
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'CABANG SUMUT (JULI 2026)');
        $sheet->fromArray([
            ['NO', 'NAMA PERUSAHAAN', 'KAPASITAS TERPASANG (TON/THN)', 'KODE TPP', 'JENIS KARET', 'OPER. FACT.', 'PRODUKSI', 'LOKAL', 'EKSPOR', 'PENJUALAN'],
            ['', '', '', '', '', 'UNIT', 'KG', 'KG', 'KG', 'KG'],
            [1, 'PT Contoh Satu', '1.200', 'TPP-01', 'RSS', '1,5', '100.000', '50.000', '50.000', '100.000'],
            [1, 'PT Contoh Dua', '1.000', 'TPP-02', 'SIR', '-', '200.000', '100.000', '100.000', '200.000'],
            ['', 'TOTAL', '2.200', '', '', '', '300.000', '150.000', '150.000', '300.000'],
        ], null, 'A3');
        foreach ([
            'C5' => '1.200', 'F5' => '1,5', 'G5' => '100.000', 'H5' => '50.000', 'I5' => '50.000', 'J5' => '100.000',
            'C6' => '1.000', 'F6' => '-', 'G6' => '200.000', 'H6' => '100.000', 'I6' => '100.000', 'J6' => '200.000',
            'C7' => '2.200', 'G7' => '301.000', 'H7' => '150.000', 'I7' => '150.000', 'J7' => '300.000',
        ] as $cell => $value) {
            $sheet->setCellValueExplicit($cell, $value, DataType::TYPE_STRING);
        }

        $path = sys_get_temp_dir() . DIRECTORY_SEPARATOR . uniqid('branch-report-', true) . '.xlsx';
        try {
            (new Xlsx($spreadsheet))->save($path);
            $parsed = (new MonthlyBranchReportExcelParser())->parse($path);
        } finally {
            $spreadsheet->disconnectWorksheets();
            if (file_exists($path)) {
                unlink($path);
            }
        }

        $this->assertCount(2, $parsed['rows']);
        $this->assertSame('1', $parsed['rows'][0]['source_number']);
        $this->assertSame('1', $parsed['rows'][1]['source_number']);
        $this->assertSame('PT Contoh Satu', $parsed['rows'][0]['company_name']);
        $this->assertSame('PT Contoh Dua', $parsed['rows'][1]['company_name']);
        $this->assertEquals(0, $parsed['rows'][1]['operating_factor']);
        $this->assertSame(300000.0, $parsed['totals']['production']);
        $this->assertSame(150000.0, $parsed['totals']['local_sales']);
        $this->assertSame(150000.0, $parsed['totals']['export_sales']);
        $this->assertSame(300000.0, $parsed['totals']['total_sales']);
        $this->assertSame(301000.0, $parsed['source_totals']['production']);
        $this->assertSame([], $parsed['errors']);
        $this->assertStringContainsString('Total produksi', implode(' ', $parsed['warnings']));
    }

    public function test_it_reads_legacy_xls_files(): void
    {
        $spreadsheet = new Spreadsheet();
        $spreadsheet->getActiveSheet()->fromArray([
            ['NO', 'NAMA PERUSAHAAN', 'KAPASITAS TERPASANG', 'KODE TPP', 'JENIS KARET', 'OPER. FACT.', 'PRODUKSI', 'LOKAL', 'EKSPOR', 'PENJUALAN'],
            [1, 'PT Contoh', 500, 'TPP-01', 'RSS', 1, 1000, 400, 600, 1000],
            ['', 'TOTAL', 500, '', '', '', 1000, 400, 600, 1000],
        ]);
        $path = sys_get_temp_dir() . DIRECTORY_SEPARATOR . uniqid('branch-report-', true) . '.xls';

        try {
            (new Xls($spreadsheet))->save($path);
            $parsed = (new MonthlyBranchReportExcelParser())->parse($path);
        } finally {
            $spreadsheet->disconnectWorksheets();
            if (file_exists($path)) {
                unlink($path);
            }
        }

        $this->assertCount(1, $parsed['rows']);
        $this->assertSame(1000.0, $parsed['totals']['production']);
        $this->assertSame([], $parsed['errors']);
        $this->assertSame([], $parsed['warnings']);
    }

    public function test_it_reads_sample_with_merged_headers_and_spaced_total_label(): void
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        foreach (['A1:A3', 'B1:B3', 'C1:C3', 'D1:D3', 'E1:E3', 'F2:F3', 'G2:G3', 'H2:H3', 'I2:I3', 'J2:J3', 'G1:J1'] as $range) {
            $sheet->mergeCells($range);
        }

        $headers = [
            'A1' => 'NO',
            'B1' => 'NAMA PERUSAHAAN',
            'C1' => 'KAPASITAS TERPASANG (TON/THN)',
            'D1' => 'KODE TPP',
            'E1' => 'JENIS KARET',
            'G1' => 'Juli',
            'F2' => 'Oper. Fact. unit',
            'G2' => 'Produksi KG',
            'H2' => 'lokal KG',
            'I2' => 'Ekspor KG',
            'J2' => 'Penjualan KG',
        ];
        foreach ($headers as $cell => $value) {
            $sheet->setCellValue($cell, $value);
        }
        $sheet->fromArray([
            [1, 'PT ABAISIAT RAYA', '36,000', 'SFB', 'SIR, 10,20', 1, '2,520,000', '-', '2,520,000', '2,520,000'],
            [1, 'PT ANUGRAH SIBOLGA LESTARI', '18,000', 'SFU', 'SIR,10,20,VK,60', 1, '679,840', '-', '679,840', '679,840'],
            ['', 'T O T A L', '54,000', '-', '', 2, '3,199,840', '-', '3,199,840', '3,199,840'],
        ], null, 'A4');
        foreach (['C4' => '36,000', 'G4' => '2,520,000', 'I4' => '2,520,000', 'J4' => '2,520,000', 'C5' => '18,000', 'G5' => '679,840', 'I5' => '679,840', 'J5' => '679,840', 'C6' => '54,000', 'G6' => '3,199,840', 'I6' => '3,199,840', 'J6' => '3,199,840'] as $cell => $value) {
            $sheet->setCellValueExplicit($cell, $value, DataType::TYPE_STRING);
        }

        $path = sys_get_temp_dir() . DIRECTORY_SEPARATOR . uniqid('branch-report-', true) . '.xlsx';
        try {
            (new Xlsx($spreadsheet))->save($path);
            $parsed = (new MonthlyBranchReportExcelParser())->parse($path);
        } finally {
            $spreadsheet->disconnectWorksheets();
            if (file_exists($path)) {
                unlink($path);
            }
        }

        $this->assertCount(2, $parsed['rows']);
        $this->assertSame('PT ABAISIAT RAYA', $parsed['rows'][0]['company_name']);
        $this->assertSame('PT ANUGRAH SIBOLGA LESTARI', $parsed['rows'][1]['company_name']);
        $this->assertSame(3199840.0, $parsed['totals']['production']);
        $this->assertSame([], $parsed['errors']);
    }

    public function test_downloadable_template_header_is_accepted_by_the_parser(): void
    {
        $spreadsheet = app(MonthlyBranchReportTemplate::class)->create('SUMUT');
        $sheet = $spreadsheet->getSheetByName('Laporan Bulanan');
        $sheet->fromArray([
            [1, 'PT ABAISIAT RAYA', '36,000', 'SFB', 'SIR, 10,20', 1, '2,520,000', '-', '2,520,000', '2,520,000'],
        ], null, 'A7');
        foreach (['C7' => '36,000', 'G7' => '2,520,000', 'H7' => '-', 'I7' => '2,520,000', 'J7' => '2,520,000'] as $cell => $value) {
            $sheet->setCellValueExplicit($cell, $value, DataType::TYPE_STRING);
        }

        $path = sys_get_temp_dir() . DIRECTORY_SEPARATOR . uniqid('branch-template-', true) . '.xlsx';
        try {
            (new Xlsx($spreadsheet))->save($path);
            $parsed = (new MonthlyBranchReportExcelParser())->parse($path);
        } finally {
            $spreadsheet->disconnectWorksheets();
            if (file_exists($path)) {
                unlink($path);
            }
        }

        $this->assertCount(1, $parsed['rows']);
        $this->assertSame('PT ABAISIAT RAYA', $parsed['rows'][0]['company_name']);
        $this->assertSame(2520000.0, $parsed['totals']['production']);
        $this->assertEquals(0, $parsed['totals']['local_sales']);
    }
}

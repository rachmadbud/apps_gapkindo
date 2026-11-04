<?php

namespace App\Services;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class MonthlyBranchReportTemplate
{
    public function create(string $branchName): Spreadsheet
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle('Laporan Bulanan');
        $sheet->mergeCells('A1:J1');
        $sheet->setCellValue('A1', 'LAPORAN BULANAN CABANG - ' . strtoupper($branchName));
        $sheet->mergeCells('A2:J2');
        $sheet->setCellValue('A2', 'Pilih bulan dan tahun pada halaman upload. Isi data mulai baris 7; jangan mengubah header.');

        foreach (['A', 'B', 'C', 'D', 'E'] as $column) {
            $sheet->mergeCells($column . '4:' . $column . '6');
        }
        $sheet->mergeCells('G4:J4');
        $sheet->setCellValue('A4', 'NO');
        $sheet->setCellValue('B4', 'NAMA PERUSAHAAN');
        $sheet->setCellValue('C4', 'KAPASITAS TERPASANG (TON/THN)');
        $sheet->setCellValue('D4', 'KODE TPP');
        $sheet->setCellValue('E4', 'JENIS KARET');
        $sheet->setCellValue('G4', 'BULAN / TAHUN LAPORAN');
        $sheet->setCellValue('F5', 'OPER. FACT.');
        $sheet->setCellValue('F6', 'UNIT');

        foreach ([
            'G5' => 'PRODUKSI',
            'H5' => 'LOKAL',
            'I5' => 'EKSPOR',
            'J5' => 'PENJUALAN',
            'G6' => 'KG',
            'H6' => 'KG',
            'I6' => 'KG',
            'J6' => 'KG',
        ] as $cell => $value) {
            $sheet->setCellValue($cell, $value);
        }

        $sheet->getStyle('A4:J6')->applyFromArray([
            'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF']],
            'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => '245A73']],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER,
                'wrapText' => true,
            ],
            'borders' => [
                'allBorders' => ['borderStyle' => Border::BORDER_THIN, 'color' => ['rgb' => 'B7C9D0']],
            ],
        ]);
        $sheet->getStyle('A1:J1')->applyFromArray([
            'font' => ['bold' => true, 'size' => 16, 'color' => ['rgb' => '173B4D']],
            'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
        ]);
        $sheet->getStyle('A2:J2')->applyFromArray([
            'font' => ['italic' => true, 'color' => ['rgb' => '555555']],
            'alignment' => ['horizontal' => Alignment::HORIZONTAL_LEFT],
        ]);
        $sheet->getRowDimension(1)->setRowHeight(28);
        $sheet->getRowDimension(2)->setRowHeight(24);
        $sheet->getRowDimension(4)->setRowHeight(30);
        $sheet->getRowDimension(5)->setRowHeight(24);
        $sheet->getRowDimension(6)->setRowHeight(22);
        $sheet->getColumnDimension('A')->setWidth(8);
        $sheet->getColumnDimension('B')->setWidth(42);
        $sheet->getColumnDimension('C')->setWidth(20);
        $sheet->getColumnDimension('D')->setWidth(14);
        $sheet->getColumnDimension('E')->setWidth(28);
        $sheet->getColumnDimension('F')->setWidth(16);
        foreach (['G', 'H', 'I', 'J'] as $column) {
            $sheet->getColumnDimension($column)->setWidth(18);
        }
        $sheet->freezePane('A7');
        $sheet->setShowGridlines(false);

        $guide = $spreadsheet->createSheet();
        $guide->setTitle('Petunjuk');
        $guide->fromArray([
            ['PETUNJUK PENGISIAN TEMPLATE LAPORAN BULANAN'],
            ['1. Isi data perusahaan mulai baris 7 pada sheet Laporan Bulanan.'],
            ['2. Jangan mengubah, menghapus, memindahkan, atau menggabungkan ulang header kolom.'],
            ['3. Urutan nomor boleh berulang; setiap baris perusahaan tetap dibaca sebagai data tersendiri.'],
            ['4. Salin nama perusahaan, kode TPP, dan jenis karet persis seperti sumber.'],
            ['5. Kolom numerik: kapasitas, oper. fact., produksi, lokal, ekspor, dan penjualan.'],
            ['6. Angka boleh menggunakan pemisah ribuan. Tanda "-" dibaca sebagai nol; sel kosong ditampilkan sebagai data kosong.'],
            ['7. Jangan menambahkan baris TOTAL. Aplikasi menghitung ulang rekap dari baris perusahaan.'],
            ['8. Pilih bulan dan tahun laporan pada halaman upload, lalu pilih file template ini.'],
            ['9. Periksa preview dan peringatan total sebelum menekan Kirim Laporan.'],
            ['10. Format file .xlsx; ukuran maksimal 10 MB.'],
        ]);
        $guide->getColumnDimension('A')->setWidth(110);
        $guide->getStyle('A1:A11')->getAlignment()->setWrapText(true);
        $guide->getStyle('A1')->getFont()->setBold(true)->setSize(14);
        for ($row = 2; $row <= 11; $row++) {
            $guide->getRowDimension($row)->setRowHeight(28);
        }
        $guide->setShowGridlines(false);
        $spreadsheet->setActiveSheetIndex(0);

        return $spreadsheet;
    }
}

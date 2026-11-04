<?php

namespace App\Services;

use PhpOffice\PhpSpreadsheet\IOFactory;
use RuntimeException;

class MonthlyBranchReportExcelParser
{
    private const FIELDS = [
        'number',
        'company_name',
        'capacity',
        'tpp_code',
        'rubber_type',
        'operating_factor',
        'production',
        'local_sales',
        'export_sales',
        'total_sales',
    ];

    private const TOTAL_FIELDS = [
        'capacity',
        'production',
        'local_sales',
        'export_sales',
        'total_sales',
    ];

    public function parse(string $path): array
    {
        try {
            $reader = IOFactory::createReaderForFile($path);
            $reader->setReadDataOnly(true);
            $spreadsheet = $reader->load($path);
        } catch (\Throwable $exception) {
            throw new RuntimeException('File Excel tidak dapat dibaca. Pastikan file .xls atau .xlsx tidak rusak.', 0, $exception);
        }

        try {
            $sheet = $spreadsheet->getActiveSheet();
            $data = $sheet->toArray(null, true, false, false);
            $header = $this->findHeader($data);
            $result = $this->readRows($data, $header);

            if (count($result['rows']) === 0) {
                throw new RuntimeException('Tidak ditemukan baris data perusahaan setelah header Excel.');
            }

            $result['source_totals'] = $this->readSourceTotals($data, $header);
            $result['warnings'] = array_merge(
                $result['warnings'],
                $this->compareTotals($result['totals'], $result['source_totals'])
            );

            return $result;
        } finally {
            $spreadsheet->disconnectWorksheets();
        }
    }

    private function findHeader(array $data): array
    {
        $columnCount = 0;
        foreach (array_slice($data, 0, 35) as $row) {
            $columnCount = max($columnCount, count($row));
        }

        $columnCount = min($columnCount, 60);
        $limit = min(count($data), 35);

        for ($endRow = 0; $endRow < $limit; $endRow++) {
            $columns = [];
            for ($column = 0; $column < $columnCount; $column++) {
                $values = [];
                for ($row = 0; $row <= $endRow; $row++) {
                    $value = $data[$row][$column] ?? null;
                    if ($value !== null && trim((string) $value) !== '') {
                        $values[] = (string) $value;
                    }
                }
                $field = $this->matchHeader(implode(' ', $values));
                if ($field !== null && !isset($columns[$field])) {
                    $columns[$field] = $column;
                }
            }

            if (count($columns) === count(self::FIELDS) && count(array_unique($columns)) === count(self::FIELDS)) {
                return ['end_row' => $endRow, 'columns' => $columns];
            }
        }

        throw new RuntimeException(
            'Header Excel tidak sesuai. Sistem membutuhkan kolom NO, NAMA PERUSAHAAN, KAPASITAS TERPASANG, KODE TPP, JENIS KARET, OPER. FACT., PRODUKSI, LOKAL, EKSPOR, dan PENJUALAN.'
        );
    }

    private function matchHeader(string $value): ?string
    {
        $text = strtoupper($value);
        $text = preg_replace('/[^A-Z0-9]+/', ' ', $text);
        $text = trim(preg_replace('/\s+/', ' ', $text));

        if (str_contains($text, 'NAMA PERUSAHAAN')) {
            return 'company_name';
        }
        if (str_contains($text, 'KAPASITAS TERPASANG')) {
            return 'capacity';
        }
        if (str_contains($text, 'KODE TPP')) {
            return 'tpp_code';
        }
        if (str_contains($text, 'JENIS KARET')) {
            return 'rubber_type';
        }
        if (str_contains($text, 'OPER FACT') || str_contains($text, 'OPERASIONAL FACT')) {
            return 'operating_factor';
        }
        if (str_contains($text, 'LOKAL')) {
            return 'local_sales';
        }
        if (str_contains($text, 'EKSPOR') || str_contains($text, 'EXPORT')) {
            return 'export_sales';
        }
        if (str_contains($text, 'PENJUALAN')) {
            return 'total_sales';
        }
        if (str_contains($text, 'PRODUKSI')) {
            return 'production';
        }
        if (preg_match('/(?:^|\s)NO(?:$|\s)/', $text) || str_contains($text, 'NOMOR')) {
            return 'number';
        }

        return null;
    }

    private function readRows(array $data, array $header): array
    {
        $rows = [];
        $warnings = [];
        $errors = [];
        $totals = array_fill_keys(self::TOTAL_FIELDS, 0);

        for ($index = $header['end_row'] + 1; $index < count($data); $index++) {
            $source = $data[$index] ?? [];
            $values = [];
            foreach (self::FIELDS as $field) {
                $values[$field] = $source[$header['columns'][$field]] ?? null;
            }

            if ($this->isEmptyRow($values)) {
                continue;
            }

            if ($this->isTotalRow($values)) {
                continue;
            }

            $company = $this->text($values['company_name']);
            if ($company === '' && $this->isHeaderContinuation($values)) {
                continue;
            }
            if ($company === '') {
                $errors[] = 'Baris Excel ' . ($index + 1) . ': nama perusahaan kosong.';
            }
            if ($this->text($values['tpp_code']) === '') {
                $warnings[] = 'Baris Excel ' . ($index + 1) . ': kode TPP kosong.';
            }
            if ($this->text($values['rubber_type']) === '') {
                $warnings[] = 'Baris Excel ' . ($index + 1) . ': jenis karet kosong.';
            }

            $parsed = [];
            foreach (self::TOTAL_FIELDS as $field) {
                $number = $this->parseNumber($values[$field], false);
                if ($number === false) {
                    $errors[] = 'Baris Excel ' . ($index + 1) . ': nilai ' . $this->fieldLabel($field) . ' bukan angka yang valid.';
                    $parsed[$field] = null;
                } else {
                    $parsed[$field] = $number;
                    if ($number !== null) {
                        $totals[$field] += $number;
                    } elseif ($this->text($values[$field]) === '') {
                        $warnings[] = 'Baris Excel ' . ($index + 1) . ': nilai ' . $this->fieldLabel($field) . ' kosong.';
                    }
                }
            }

            $capacity = $this->parseNumber($values['capacity'], false);
            $operatingFactor = $this->parseNumber($values['operating_factor'], true);
            foreach (['capacity' => $capacity, 'operating_factor' => $operatingFactor] as $field => $number) {
                if ($number === false) {
                    $errors[] = 'Baris Excel ' . ($index + 1) . ': nilai ' . $this->fieldLabel($field) . ' bukan angka yang valid.';
                } elseif ($number === null && $this->text($values[$field]) === '') {
                    $warnings[] = 'Baris Excel ' . ($index + 1) . ': nilai ' . $this->fieldLabel($field) . ' kosong.';
                }
            }

            $rows[] = [
                'source_row' => $index + 1,
                'source_number' => $this->text($values['number']),
                'company_name' => $company,
                'capacity' => $capacity === false ? null : $capacity,
                'tpp_code' => $this->text($values['tpp_code']),
                'rubber_type' => $this->text($values['rubber_type']),
                'operating_factor' => $operatingFactor === false ? null : $operatingFactor,
                'production' => $parsed['production'],
                'local_sales' => $parsed['local_sales'],
                'export_sales' => $parsed['export_sales'],
                'total_sales' => $parsed['total_sales'],
                'raw_data' => array_map(fn ($value) => $value === null ? null : (string) $value, $values),
            ];
        }

        if ($errors !== []) {
            $warnings = array_merge($warnings, $errors);
        }

        return [
            'rows' => $rows,
            'totals' => $totals,
            'warnings' => array_values(array_unique($warnings)),
            'errors' => $errors,
        ];
    }

    private function readSourceTotals(array $data, array $header): ?array
    {
        foreach ($data as $index => $source) {
            if ($index <= $header['end_row']) {
                continue;
            }
            $values = [];
            foreach (self::FIELDS as $field) {
                $values[$field] = $source[$header['columns'][$field]] ?? null;
            }
            if (!$this->isTotalRow($values)) {
                continue;
            }

            $totals = [];
            foreach (self::TOTAL_FIELDS as $field) {
                $number = $this->parseNumber($values[$field], false);
                if ($number !== false && $number !== null) {
                    $totals[$field] = $number;
                }
            }

            return $totals === [] ? null : $totals;
        }

        return null;
    }

    private function compareTotals(array $calculated, ?array $source): array
    {
        if ($source === null) {
            return [];
        }

        $warnings = [];
        foreach ($source as $field => $sourceTotal) {
            $calculatedTotal = $calculated[$field] ?? 0;
            if (abs($calculatedTotal - $sourceTotal) > 0.0001) {
                $warnings[] = 'Total ' . $this->fieldLabel($field) . ' pada Excel (' . $sourceTotal
                    . ') berbeda dengan hasil hitung baris perusahaan (' . $calculatedTotal . ').';
            }
        }

        return $warnings;
    }

    private function parseNumber($value, bool $decimalComma)
    {
        if ($value === null || trim((string) $value) === '') {
            return null;
        }

        if (is_int($value) || is_float($value)) {
            return (float) $value;
        }

        $text = trim((string) $value);
        if (in_array($text, ['-', '—', '–'], true)) {
            return 0;
        }

        $text = str_replace(["\xc2\xa0", ' ', "'"], '', $text);
        $text = preg_replace('/[^0-9,.\-]/', '', $text);
        if ($text === '' || !preg_match('/^-?(?:\d+|\d{1,3}(?:[.,]\d{3})+)(?:[.,]\d+)?$/', $text)) {
            return false;
        }

        $hasComma = str_contains($text, ',');
        $hasDot = str_contains($text, '.');
        if ($hasComma && $hasDot) {
            $text = str_replace('.', '', $text);
            $text = str_replace(',', '.', $text);
        } elseif ($hasComma) {
            $digitsAfter = strlen(substr(strrchr($text, ','), 1));
            if (!$decimalComma && $digitsAfter === 3) {
                $text = str_replace(',', '', $text);
            } else {
                $text = str_replace(',', '.', $text);
            }
        } elseif ($hasDot) {
            $digitsAfter = strlen(substr(strrchr($text, '.'), 1));
            if ($digitsAfter === 3) {
                $text = str_replace('.', '', $text);
            }
        }

        return is_numeric($text) ? (float) $text : false;
    }

    private function isEmptyRow(array $values): bool
    {
        foreach ($values as $value) {
            if ($this->text($value) !== '') {
                return false;
            }
        }

        return true;
    }

    private function isHeaderContinuation(array $values): bool
    {
        $allowedLabels = ['KG', 'UNIT', 'TON', 'THN', 'TON THN'];
        $hasLabel = false;
        foreach ($values as $field => $value) {
            if ($field === 'company_name' || $this->text($value) === '') {
                continue;
            }
            $normalized = strtoupper(trim(preg_replace('/[^A-Z0-9]+/', ' ', (string) $value)));
            if (!in_array($normalized, $allowedLabels, true)) {
                return false;
            }
            $hasLabel = true;
        }

        return $hasLabel;
    }

    private function isTotalRow(array $values): bool
    {
        $company = strtoupper($this->text($values['company_name'] ?? null));
        $normalizedCompany = preg_replace('/[^A-Z]/', '', $company);
        if (in_array($normalizedCompany, ['TOTAL', 'TOTALKESELURUHAN', 'JUMLAH'], true)) {
            return true;
        }

        $number = strtoupper($this->text($values['number'] ?? null));
        $normalizedNumber = preg_replace('/[^A-Z]/', '', $number);
        return in_array($normalizedNumber, ['TOTAL', 'JUMLAH'], true);
    }

    private function text($value): string
    {
        return $value === null ? '' : trim((string) $value);
    }

    private function fieldLabel(string $field): string
    {
        return [
            'capacity' => 'kapasitas terpasang',
            'operating_factor' => 'oper. fact.',
            'production' => 'produksi',
            'local_sales' => 'lokal',
            'export_sales' => 'ekspor',
            'total_sales' => 'penjualan',
        ][$field] ?? $field;
    }
}

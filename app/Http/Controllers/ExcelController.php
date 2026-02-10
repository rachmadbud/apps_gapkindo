<?php

namespace App\Http\Controllers;

use PhpOffice\PhpSpreadsheet\IOFactory;

class ExcelController extends Controller
{
    public function index()
    {
        return view('excel');
    }

    public function data()
    {
        $path = storage_path('app/excel/laporan.xls');

        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($path);
        $sheet = $spreadsheet->getActiveSheet();

        // ubah ke array numerik
        $data = $sheet->toArray(null, true, false, false);

        return response()->json($data);
    }
}

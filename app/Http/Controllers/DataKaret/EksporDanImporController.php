<?php

namespace App\Http\Controllers\DataKaret;

use App\Http\Controllers\Controller;
use App\Models\CustomClass;
use App\Models\SidebarModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Writer\Html;
use Barryvdh\DomPDF\Facade\Pdf;

class EksporDanImporController extends Controller
{
    public function eksporDanImporBerdasarkanKodeHS()
    {
        $menuModel = new SidebarModel();
        $sidebarMenu = $menuModel->getMenu();

        $data = DB::table('ekspor_dan_impor_berdasarkan_kode_hs')->get();

        return view('dataKaret.eksporDanImpor.eksporDanImporBerdasarkanKodeHS')
            ->with($sidebarMenu)
            ->with('data', $data);
    }

    public function eksporDanImporBerdasarkanKodeHSPost(Request $request)
    {
        $this->validate(
            $request,
            [
                'tahun' => 'required|integer',
                'periode' => 'required',
                'file' => 'required|file|mimes:xlsx,csv,xls',
            ]
        );

        // menyimpan data file yang diupload ke variabel $file
        $file = $request->file('file');

        $nama_file =  $file->getClientOriginalName();
        // isi dengan nama folder tempat kemana file diupload
        $tujuan_upload = 'fileExcel';
        $file->move($tujuan_upload, $nama_file);
        // insert data ke table surat_masuk
        DB::table('ekspor_dan_impor_berdasarkan_kode_hs')->insert([
            'tahun' => $request->tahun,
            'periode' => $request->periode,
            'file' => $nama_file,
            'created_by' => auth()->user()->name,
            'updated_by' => auth()->user()->name,
            'created_at' => now(),
        ]);

        // Kembalikan respons atau redirect sesuai kebutuhan
        toast(app(CustomClass::class)->notifSuksesTambah(), 'success');
        return redirect()->back();
    }

    public function lihat($id)
    {
        $id = app(CustomClass::class)->dekrip($id);

        $data = DB::table('ekspor_dan_impor_berdasarkan_kode_hs')
            ->where('id', $id)
            ->first();

        // path file Excel (public/fileExcel)
        $excelPath = public_path('fileExcel/' . $data->file);

        if (!file_exists($excelPath)) {
            abort(404);
        }

        $spreadsheet = IOFactory::load($excelPath);

        $htmlContent = '';

        foreach ($spreadsheet->getAllSheets() as $index => $sheet) {

            // Set sheet aktif
            $spreadsheet->setActiveSheetIndex($index);

            $writer = new Html($spreadsheet);

            ob_start();
            $writer->save('php://output');
            $sheetHtml = ob_get_clean();

            // Judul sheet + page break
            $htmlContent .= "
            <h3 style='margin-top:30px'>Sheet: {$sheet->getTitle()}</h3>
            {$sheetHtml}
            <div style='page-break-after:always'></div>
        ";
        }

        $finalHtml = view('pdf.excel', [
            'html' => $htmlContent
        ])->render();

        $pdf = app('dompdf.wrapper');
        $pdf->loadHTML($finalHtml)->setPaper('A4', 'landscape');

        return $pdf->stream('preview-excel.pdf');
    }

    public function update(Request $request, $id)
    {
        $id = app(CustomClass::class)->dekrip($id);

        $request->validate([
            'tahun'   => 'required',
            'periode' => 'required',
            'file'    => 'nullable|file|mimes:pdf,xlsx,xls,doc,docx|max:2048',
        ]);

        // ambil data lama
        $laporan = DB::table('ekspor_dan_impor_berdasarkan_kode_hs')->where('id', $id)->first();

        if (!$laporan) {
            return redirect()->back()->with('error', 'Data tidak ditemukan');
        }

        $data = [
            'tahun'      => $request->tahun,
            'periode'    => $request->periode,
            'updated_by' => auth()->user()->name,
            'updated_at' => now(),
        ];

        // kalau upload file baru
        if ($request->hasFile('file')) {

            if (!empty($laporan->file)) {
                $file_lama = public_path('fileExcel/' . $laporan->file);

                if (file_exists($file_lama)) {
                    unlink($file_lama);
                }
            }

            $file = $request->file('file');
            $nama_file = $file->getClientOriginalName();
            $file->move('fileExcel', $nama_file);

            $data['file'] = $nama_file;
        }


        DB::table('ekspor_dan_impor_berdasarkan_kode_hs')
            ->where('id', $id)
            ->update($data);

        toast(app(CustomClass::class)->notifSuksesEdit(), 'success');

        return redirect()->back();
    }

    public function eksporBerdasarkanPelabuhanEkspor()
    {
        $menuModel = new SidebarModel();
        $sidebarMenu = $menuModel->getMenu();

        $data = DB::table('ekspor_berdasarkan_pelabuhan_ekspor')->get();

        return view('dataKaret.eksporDanImpor.eksporBerdasarkanPelabuhanEkspor')
            ->with($sidebarMenu)
            ->with('data', $data);
    }

    public function eksporBerdasarkanPelabuhanEksporPost(Request $request)
    {
        $this->validate(
            $request,
            [
                'tahun' => 'required|integer',
                'periode' => 'required',
                'file' => 'required|file|mimes:xlsx,csv,xls',
            ]
        );

        // menyimpan data file yang diupload ke variabel $file
        $file = $request->file('file');

        $nama_file =  $file->getClientOriginalName();
        // isi dengan nama folder tempat kemana file diupload
        $tujuan_upload = 'fileExcel';
        $file->move($tujuan_upload, $nama_file);
        // insert data ke table surat_masuk
        DB::table('ekspor_berdasarkan_pelabuhan_ekspor')->insert([
            'tahun' => $request->tahun,
            'periode' => $request->periode,
            'file' => $nama_file,
            'created_by' => auth()->user()->name,
            'updated_by' => auth()->user()->name,
            'created_at' => now(),
        ]);

        // Kembalikan respons atau redirect sesuai kebutuhan
        toast(app(CustomClass::class)->notifSuksesTambah(), 'success');
        return redirect()->back();
    }

    public function lihatEksporBerdasarkanPelabuhanEkspor($id)
    {
        $id = app(CustomClass::class)->dekrip($id);
        // dd($id);

        $data = DB::table('ekspor_berdasarkan_pelabuhan_ekspor')
            ->where('id', $id)
            ->first();

        // path file Excel (public/fileExcel)
        $excelPath = public_path('fileExcel/' . $data->file);

        if (!file_exists($excelPath)) {
            abort(404);
        }

        $spreadsheet = IOFactory::load($excelPath);

        $htmlContent = '';

        foreach ($spreadsheet->getAllSheets() as $index => $sheet) {

            // Set sheet aktif
            $spreadsheet->setActiveSheetIndex($index);

            $writer = new Html($spreadsheet);

            ob_start();
            $writer->save('php://output');
            $sheetHtml = ob_get_clean();

            // Judul sheet + page break
            $htmlContent .= "
                <h3 style='margin-top:30px'>Sheet: {$sheet->getTitle()}</h3>
                {$sheetHtml}
                <div style='page-break-after:always'></div>
            ";
        }

        $finalHtml = view('pdf.excel', [
            'html' => $htmlContent
        ])->render();

        $pdf = app('dompdf.wrapper');
        $pdf->loadHTML($finalHtml)->setPaper('A4', 'landscape');

        return $pdf->stream('preview-excel.pdf');
    }

    public function eksporBerdasarkanPelabuhanEksporUpdate(Request $request, $id)
    {
        $id = app(CustomClass::class)->dekrip($id);

        $this->validate(
            $request,
            [
                'tahun' => 'required|integer',
                'periode' => 'required',
                'file' => 'file|mimes:xlsx,csv,xls',
            ]
        );

        $data = [
            'tahun' => $request->tahun,
            'periode' => $request->periode,
            'updated_by' => auth()->user()->name,
            'updated_at' => now(),
        ];

        // kalau upload file baru
        if ($request->hasFile('file')) {

            if (!empty($laporan->file)) {
                $file_lama = public_path('fileExcel/' . $laporan->file);

                if (file_exists($file_lama)) {
                    unlink($file_lama);
                }
            }

            $file = $request->file('file');
            $nama_file = $file->getClientOriginalName();
            $file->move('fileExcel', $nama_file);

            $data['file'] = $nama_file;
        }


        DB::table('ekspor_berdasarkan_pelabuhan_ekspor')
            ->where('id', $id)
            ->update($data);

        toast(app(CustomClass::class)->notifSuksesEdit(), 'success');

        return redirect()->back();
    }

    public function eksporBerdasarkanNegaraTujuan()
    {
        $menuModel = new SidebarModel();
        $sidebarMenu = $menuModel->getMenu();

        $data = DB::table('ekspor_dan_impor_berdasarkan_negara_tujuan')->get();

        return view('dataKaret.eksporDanImpor.eksporDanImporBerdasarkanNegaraTujuan')
            ->with($sidebarMenu)
            ->with('data', $data);
    }

    public function eksporBerdasarkanNegaraTujuanPost(Request $request)
    {
        $this->validate(
            $request,
            [
                'tahun' => 'required|integer',
                'periode' => 'required',
                'file' => 'required|file|mimes:xlsx,csv,xls',
            ]
        );

        $file = $request->file('file');
        $nama_file = $file->getClientOriginalName();
        $file->move('fileExcel', $nama_file);

        // insert data ke table surat_masuk
        DB::table('ekspor_dan_impor_berdasarkan_negara_tujuan')->insert([
            'tahun' => $request->tahun,
            'periode' => $request->periode,
            'file' => $nama_file,
            'created_by' => auth()->user()->name,
            'updated_by' => auth()->user()->name,
            'created_at' => now(),
        ]);

        // Kembalikan respons atau redirect sesuai kebutuhan
        toast(app(CustomClass::class)->notifSuksesTambah(), 'success');
        return redirect()->back();
    }

    public function lihatEksporBerdasarkanNegaraTujuan($id)
    {
        $id = app(CustomClass::class)->dekrip($id);

        $data = DB::table('ekspor_dan_impor_berdasarkan_negara_tujuan')
            ->where('id', $id)
            ->first();

        // path file Excel (public/fileExcel)
        $excelPath = public_path('fileExcel/' . $data->file);

        if (!file_exists($excelPath)) {
            abort(404);
        }

        $spreadsheet = IOFactory::load($excelPath);

        $htmlContent = '';

        foreach ($spreadsheet->getAllSheets() as $index => $sheet) {

            // Set sheet aktif
            $spreadsheet->setActiveSheetIndex($index);

            $writer = new Html($spreadsheet);

            ob_start();
            $writer->save('php://output');
            $sheetHtml = ob_get_clean();

            // Judul sheet + page break
            $htmlContent .= "
            <h3 style='margin-top:30px'>Sheet: {$sheet->getTitle()}</h3>
            {$sheetHtml}
            <div style='page-break-after:always'></div>
        ";
        }

        $finalHtml = view('pdf.excel', [
            'html' => $htmlContent
        ])->render();

        $pdf = app('dompdf.wrapper');
        $pdf->loadHTML($finalHtml)->setPaper('A4', 'landscape');

        return $pdf->stream('preview-excel.pdf');
    }

    public function eksporBerdasarkanNegaraTujuanUpdate(Request $request, $id)
    {
        $id = app(CustomClass::class)->dekrip($id);

        $request->validate([
            'tahun'   => 'required',
            'periode' => 'required',
            'file'    => 'nullable|file|mimes:pdf,xlsx,xls,doc,docx|max:2048',
        ]);

        // ambil data lama
        $laporan = DB::table('ekspor_dan_impor_berdasarkan_negara_tujuan')->where('id', $id)->first();

        if (!$laporan) {
            return redirect()->back()->with('error', 'Data tidak ditemukan');
        }

        $data = [
            'tahun'      => $request->tahun,
            'periode'    => $request->periode,
            'updated_by' => auth()->user()->name,
            'updated_at' => now(),
        ];

        // kalau upload file baru
        if ($request->hasFile('file')) {

            if (!empty($laporan->file)) {
                $file_lama = public_path('fileExcel/' . $laporan->file);

                if (file_exists($file_lama)) {
                    unlink($file_lama);
                }
            }

            $file = $request->file('file');
            $nama_file = $file->getClientOriginalName();
            $file->move('fileExcel', $nama_file);

            $data['file'] = $nama_file;
        }


        DB::table('ekspor_dan_impor_berdasarkan_negara_tujuan')
            ->where('id', $id)
            ->update($data);

        toast(app(CustomClass::class)->notifSuksesEdit(), 'success');

        return redirect()->back();
    }
}

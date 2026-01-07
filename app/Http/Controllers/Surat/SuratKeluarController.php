<?php

namespace App\Http\Controllers\Surat;

use App\Http\Controllers\Controller;
use App\Models\CustomClass;
use App\Models\SidebarModel;
use App\Models\SuratKeluar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SuratKeluarController extends Controller
{
    public function index()
    {
        $menuModel = new SidebarModel();
        $sidebarMenu = $menuModel->getMenu();

        $suratKeluar = new SuratKeluar();
        $dataSurat = $suratKeluar->getDataSurat();

        return view('surat.suratKeluar.index')
            ->with($sidebarMenu)
            ->with('dataSurat', $dataSurat);
    }

    public function formSuratKeluar()
    {
        $menuModel = new SidebarModel();
        $sidebarMenu = $menuModel->getMenu();

        return view('surat.suratKeluar.formSuratKeluar')
            ->with($sidebarMenu);
    }

    public function formSuratKeluarSubmit(Request $request)
    {
        $this->validate(
            $request,
            [
                'tanggal' => 'required',
                'nomorSurat' => 'required',
                'perihal' => 'required',
                'lampiran' => 'required|mimes:pdf|max:5048',
                'ditujukan' => 'required',
            ]
        );

        // menyimpan data file yang diupload ke variabel $file
        $file = $request->file('lampiran');

        $nama_file = time() . "_" . $file->getClientOriginalName();
        // isi dengan nama folder tempat kemana file diupload
        $tujuan_upload = 'suratKeluar/lampiran';
        $file->move($tujuan_upload, $nama_file);
        // insert data ke table surat_keluar
        DB::table('surat_keluar')->insert([
            'tanggal' => $request->tanggal,
            'nomor_surat' => $request->nomorSurat,
            'perihal' => $request->perihal,
            'lampiran' => $nama_file,
            'ditujukan' => $request->ditujukan,
            'created_by' => auth()->user()->name,
            'created_at' => now(),
        ]);

        toast(app(CustomClass::class)->notifSuksesTambah(), 'success');
        return redirect()->action([SuratKeluarController::class, 'index']);
    }
}

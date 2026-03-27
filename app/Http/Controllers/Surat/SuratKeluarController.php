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

    public function formSuratKeluarEdit($id)
    {
        $id = app(CustomClass::class)->dekrip($id);
        $menuModel = new SidebarModel();
        $sidebarMenu = $menuModel->getMenu();

        $suratKeluar = new SuratKeluar();

        $suratKeluar = $suratKeluar->findSuratKeluar($id);

        return view('surat.suratKeluar.formSuratKeluar')
            ->with($sidebarMenu)
            ->with('suratKeluar', $suratKeluar);
    }

    public function formSuratKeluarUpdate(Request $request)
    {
        $request->validate([
            'id'          => 'required',
            'tanggal'     => 'required',
            'nomorSurat'  => 'required',
            'perihal'     => 'required',
            'ditujukan'   => 'required',
            'file_surat'  => 'nullable|file|mimes:pdf,doc,docx|max:2048',
        ]);

        // ambil data lama
        $surat = DB::table('surat_keluar')->where('id', $request->id)->first();

        if (!$surat) {
            return redirect()->back()->with('error', 'Data tidak ditemukan');
        }

        $data = [
            'tanggal'     => $request->tanggal,
            'nomor_surat' => $request->nomorSurat,
            'perihal'     => $request->perihal,
            'ditujukan'   => $request->ditujukan,
            'updated_at'  => now(),
        ];

        // kalau upload file baru
        if ($request->hasFile('lampiran')) {

            // hapus file lama
            if (!empty($surat->file)) {
                $file_lama = public_path('suratKeluar/lampiran/' . $surat->file);

                if (file_exists($file_lama)) {
                    unlink($file_lama);
                }
            }

            // upload file baru
            $file = $request->file('lampiran');
            $nama_file = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('suratKeluar/lampiran'), $nama_file);

            $data['lampiran'] = $nama_file;
        }

        DB::table('surat_keluar')
            ->where('id', $request->id)
            ->update($data);

        toast(app(CustomClass::class)->notifSuksesEdit(), 'success');

        return redirect()->action([SuratKeluarController::class, 'index']);
    }
}

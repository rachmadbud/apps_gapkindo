<?php

namespace App\Http\Controllers\Surat;

use App\Http\Controllers\Controller;
use App\Models\CustomClass;
use App\Models\SidebarModel;
use App\Models\SuratMasuk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SuratMasukController extends Controller
{
    public function index()
    {
        $menuModel = new SidebarModel();
        $sidebarMenu = $menuModel->getMenu();

        $suratMasuk = new SuratMasuk();
        $dataSurat = $suratMasuk->getDataSurat();

        return view('surat.suratMasuk.index')
            ->with($sidebarMenu)
            ->with('dataSurat', $dataSurat);
    }

    public function formSuratMasuk()
    {
        $menuModel = new SidebarModel();
        $sidebarMenu = $menuModel->getMenu();

        return view('surat.suratMasuk.formSuratMasuk')
            ->with($sidebarMenu);
    }

    public function formSuratMasukSubmit(Request $request)
    {
        // proses penyimpanan data surat masuk
        $this->validate(
            $request,
            [
                'tanggal' => 'required',
                'nomorAgenda' => 'required',
                'nomorSurat' => 'required',
                'pengirim' => 'required',
                'perihal' => 'required',
                'file_surat' => 'required|mimes:pdf|max:5048'
            ]
        );

        // menyimpan data file yang diupload ke variabel $file
        $file = $request->file('file_surat');

        $nama_file = time() . "_" . $file->getClientOriginalName();
        // isi dengan nama folder tempat kemana file diupload
        $tujuan_upload = 'suratMasuk/lampiran';
        $file->move($tujuan_upload, $nama_file);
        // insert data ke table surat_masuk
        DB::table('surat_masuks')->insert([
            'tanggal' => $request->tanggal,
            'nomor_agenda' => $request->nomorAgenda,
            'nomor_surat' => $request->nomorSurat,
            'pengirim' => $request->pengirim,
            'perihal' => $request->perihal,
            'file_surat' => $nama_file,
            'created_by' => auth()->user()->name,
            'updated_by' => auth()->user()->name,
            'created_at' => now(),
        ]);

        toast(app(CustomClass::class)->notifSuksesTambah(), 'success');
        return redirect()->action([SuratMasukController::class, 'index']);
    }

    public function formSuratMasukEdit($id)
    {
        $id = app(CustomClass::class)->dekrip($id);
        $menuModel = new SidebarModel();
        $sidebarMenu = $menuModel->getMenu();

        $suratMasuk = new SuratMasuk();

        $suratMasuk = $suratMasuk->findSuratMasuk($id);

        return view('surat.suratMasuk.formSuratMasuk')
            ->with($sidebarMenu)
            ->with('suratMasuk', $suratMasuk);
    }

    public function formSuratMasukUpdate(Request $request)
    {
        $this->validate(
            $request,
            [
                'tanggal' => 'required',
                'nomorAgenda' => 'required',
                'nomorSurat' => 'required',
                'pengirim' => 'required',
                'perihal' => 'required'
            ]
        );

        // ✅ ambil data lama
        $surat = DB::table('surat_masuks')->where('id', $request->id)->first();

        if (!$surat) {
            return back()->with('error', 'Data tidak ditemukan');
        }

        $dataUpdate = [
            'tanggal' => $request->tanggal,
            'nomor_agenda' => $request->nomorAgenda,
            'nomor_surat' => $request->nomorSurat,
            'pengirim' => $request->pengirim,
            'perihal' => $request->perihal,
            'updated_at' => now(),
        ];

        if ($request->hasFile('file_surat')) {

            // ✅ hapus file lama
            if (!empty($surat->file_surat)) {
                $file_lama = public_path('suratMasuk/lampiran/' . $surat->file_surat);

                if (file_exists($file_lama)) {
                    unlink($file_lama);
                }
            }

            // upload file baru
            $file = $request->file('file_surat');
            $nama_file = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('suratMasuk/lampiran'), $nama_file);

            // ❗ perbaiki juga ini
            $dataUpdate['file_surat'] = $nama_file;
        }

        DB::table('surat_masuks')
            ->where('id', $request->id)
            ->update($dataUpdate);

        toast(app(CustomClass::class)->notifSuksesEdit(), 'success');

        return redirect()->action([SuratMasukController::class, 'index']);
    }
}

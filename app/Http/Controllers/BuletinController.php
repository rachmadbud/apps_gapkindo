<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Buletin;
use App\Models\CustomClass;
use App\Models\SidebarModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

// use Illuminate\Http\Request;

class BuletinController extends Controller
{
    public function index()
    {
        $menuModel = new SidebarModel();
        $sidebarMenu = $menuModel->getMenu();

        $buletin = new Buletin();
        $dataBuletin = $buletin->getDataBuletin();

        return view('buletin.index')
            ->with('dataBuletin', $dataBuletin)
            ->with($sidebarMenu);
    }

    public function formBuletin()
    {
        $menuModel = new SidebarModel();
        $sidebarMenu = $menuModel->getMenu();

        return view('buletin.form')
            ->with($sidebarMenu);
    }

    public function formBuletinEdit($id)
    {
        $id = app(CustomClass::class)->dekrip($id);
        $menuModel = new SidebarModel();
        $sidebarMenu = $menuModel->getMenu();

        $buletin = new Buletin();
        $dataBuletin = $buletin->getDataBuletinById($id);

        return view('buletin.form')
            ->with('dataBuletin', $dataBuletin)
            ->with($sidebarMenu);
    }

    public function formBuletinPost(Request $request)
    {
        $request->validate([
            'edisi' => 'required',
            'lampiran' => 'required|mimes:pdf,doc,xls,xlsx|max:15048',
        ]);

        // menyimpan data file yang diupload ke variabel $file
        $file = $request->file('lampiran');

        $nama_file = Str::uuid() . '.' . $file->getClientOriginalExtension();
        // isi dengan nama folder tempat kemana file diupload
        $tujuan_upload = 'buletin/lampiran';
        $file->move($tujuan_upload, $nama_file);
        // insert data ke table surat_keluar
        DB::table('buletins')->insert([
            'edisi' => $request->edisi,
            'lampiran' => $nama_file,
            'uploaded_by' => auth()->user()->name,
            'created_at' => now(),
        ]);

        toast(app(CustomClass::class)->notifSuksesTambah(), 'success');
        return redirect()->action([BuletinController::class, 'index']);
    }

    public function formBuletinUpdate(Request $request)
    {
        $nama_file = $request->lampiran_lama;

        // cek apakah user upload file baru
        if ($request->hasFile('lampiran')) {

            // hapus file lama
            if ($request->lampiran_lama) {
                $path = public_path('buletin/lampiran/' . $request->lampiran_lama);

                if (file_exists($path)) {
                    unlink($path);
                }
            }

            // upload file baru
            $file = $request->file('lampiran');

            $nama_file = Str::uuid() . '.' . $file->getClientOriginalExtension();

            $tujuan_upload = public_path('buletin/lampiran');

            $file->move($tujuan_upload, $nama_file);
        }

        // update database
        DB::table('buletins')
            ->where('id', $request->id)
            ->update([
                'edisi' => $request->edisi,
                'lampiran' => $nama_file,
                'uploaded_by' => auth()->user()->name,
                'updated_at' => now(),
            ]);

        toast(app(CustomClass::class)->notifSuksesEdit(), 'success');
        return redirect()->action([BuletinController::class, 'index']);
    }
}

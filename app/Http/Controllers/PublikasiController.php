<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\CustomClass;
use App\Models\Publikasi;
use App\Models\SidebarModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PublikasiController extends Controller
{
    public function index()
    {
        $menuModel = new SidebarModel();
        $sidebarMenu = $menuModel->getMenu();

        $publikasi = new Publikasi();
        $dataPublikasi = $publikasi->getDataPublikasi();
        // dd($dataPublikasi);

        return view('publikasi.index')
            ->with($sidebarMenu)
            ->with('dataPublikasi', $dataPublikasi);
    }

    public function formPublikasi()
    {
        $menuModel = new SidebarModel();
        $sidebarMenu = $menuModel->getMenu();

        return view('publikasi.form')
            ->with($sidebarMenu);
    }

    public function formPublikasiPost(Request $request)
    {
        $request->validate([
            'tanggal' => 'required',
            'judul' => 'required',
            'lampiran' => 'required|mimes:pdf,doc,xls,xlsx|max:15048',
        ]);

        // menyimpan data file yang diupload ke variabel $file
        $file = $request->file('lampiran');
        // membuat nama file unik dengan menambahkan timestamp
        $namaFile = time() . '_' . $file->getClientOriginalName();
        // menyimpan file ke folder 'buletin/lampiran' di dalam public
        $file->move(public_path('publikasi/lampiran'), $namaFile);

        DB::table('publikasi')->insert([
            'tanggal' => $request->tanggal,
            'judul' => $request->judul,
            'lampiran' => $namaFile,
            'uploaded_by' => auth()->user()->name,
            'created_at' => now(),
        ]);

        toast(app(CustomClass::class)->notifSuksesTambah(), 'success');
        return redirect()->route('publikasi1');
    }
}

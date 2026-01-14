<?php

namespace App\Http\Controllers\DataKaret;

use App\Http\Controllers\Controller;
use App\Models\CustomClass;
use App\Models\SidebarModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProduksidanKonsumsiKaretAlamDuniaController extends Controller
{
    public function index()
    {
        $menuModel = new SidebarModel();
        $sidebarMenu = $menuModel->getMenu();

        $stmtDataKaretKonnsumsiDunia = DB::table('produksidan_konsumsi_karet_alam_dunia')->orderBy('id', 'desc')->get();

        return view('dataKaret.produksidanKonsumsiKaretAlamDunia.index')
            ->with($sidebarMenu)
            ->with('stmtDataKaretKonnsumsiDunia', $stmtDataKaretKonnsumsiDunia);
    }

    public function produksidanKonsumsiKaretAlamDuniaPost(Request $request)
    {
        // Handle file upload logic here
        $request->validate([
            'csv_file' => 'required|mimes:csv,txt'
        ]);

        $file = fopen($request->file('csv_file'), 'r');

        // Skip header
        fgetcsv($file);

        while (($row = fgetcsv($file, 1000, ',')) !== false) {

            $produksi = str_replace('.', '', $row[2]);
            $pertumbuhanProduksi = str_replace(',', '.', $row[3]);

            $konsumsi = str_replace('.', '', $row[4]);
            $pertumbuhanKonsumsi = str_replace(',', '.', $row[5]);

            DB::table('produksidan_konsumsi_karet_alam_dunia')->insert([
                'tahun' => $row[1],
                'produksi_ton' => (int) $produksi,
                'pertumbuhan_produksi_ton_persentase' => (float) $pertumbuhanProduksi,
                'konsumsi_ton' => (int) $konsumsi,
                'pertumbuhan_konsumsi_ton_persentase' => (float) $pertumbuhanKonsumsi,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        fclose($file);

        toast(app(CustomClass::class)->notifSuksesTambah(), 'success');
        return redirect()->action([ProduksidanKonsumsiKaretAlamDuniaController::class, 'index']);
    }
}

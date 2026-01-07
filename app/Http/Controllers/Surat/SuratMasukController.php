<?php

namespace App\Http\Controllers\Surat;

use App\Http\Controllers\Controller;
use App\Models\SidebarModel;
use Illuminate\Http\Request;

class SuratMasukController extends Controller
{
    public function index()
    {
        $menuModel = new SidebarModel();
        $sidebarMenu = $menuModel->getMenu();

        return view('surat.suratMasuk.index')
            ->with($sidebarMenu);
    }
}

<?php

namespace App\Http\Controllers\DataKaret;

use App\Http\Controllers\Controller;
use App\Models\SidebarModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DataController extends Controller
{
    public function index()
    {
        $menuModel = new SidebarModel();
        $sidebarMenu = $menuModel->getMenu();

        $dataStatistikKaret = DB::table('statistik_karet')->orderBy('id', 'asc')->get();

        return view('dataKaret.index')
            ->with('dataStatistikKaret', $dataStatistikKaret)
            ->with($sidebarMenu);
    }
}

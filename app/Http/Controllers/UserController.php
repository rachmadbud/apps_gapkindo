<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\SidebarModel;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $menuModel = new SidebarModel();
        $sidebarMenu = $menuModel->getMenu();

        $users = User::select("*")
            ->whereNotNull('last_seen')
            ->orderBy('last_seen', 'DESC')
            ->paginate(10);

        return view('manajemen.users')
            ->with($sidebarMenu)
            ->with('users', $users);
    }
}

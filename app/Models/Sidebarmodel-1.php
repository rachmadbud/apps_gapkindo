<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Request;
use Auth;
use DB;
use Route;

class SidebarModel extends Model
{
    use HasFactory;

    public function getMenu()
    {
        $id = Auth::user()->id;
        // $RouteName = Route::current()->uri();
        $RouteName = Request::segment(1);

        // cek menu & submenu apa saja yang dapat diakses oleh role yang login
        $stmtUsers = DB::table('users as a')
            ->join('tbl_master_role as b', 'a.id_role', '=', 'b.id')
            ->select('b.id_menu', 'b.id_submenu')
            ->where('a.id', $id)
            ->get();
        foreach ($stmtUsers as $dataUsers) {
            $idMenu = $dataUsers->id_menu;
            $idSubMenu = $dataUsers->id_submenu;
        }

        $stmtMenu = DB::table('tbl_master_menu')
            ->whereIn('id', explode(',', $idMenu))
            ->where('status_data', '1')
            ->orderBy('urutan', 'asc')
            ->get();

        $stmtSubMenu = DB::table('tbl_master_submenu')
            ->whereIn('id', explode(',', $idSubMenu))
            ->where('status_data', '1')
            ->orderBy('urutan', 'asc')
            ->get();

        // $stmtMenuId = DB::select('select id from tbl_master_menu where link = ?', [$RouteName]);
        // $stmtSubMenuId = DB::select('select id, id_menu from tbl_master_submenu where link = ?', [$RouteName]);

        $stmtMenuId = DB::select("select id from tbl_master_menu where link like '%" . $RouteName . "' ");
        $stmtSubMenuId = DB::select("select id, id_menu from tbl_master_submenu where link like '%" . $RouteName . "' ");
        $roleMenuIds = array_map('trim', explode(',', (string) $idMenu));
        $roleSubMenuIds = array_map('trim', explode(',', (string) $idSubMenu));

        foreach ($stmtMenuId as $dataMenuId) {
            $regIdMenu = $dataMenuId->id;
            $stmtRoleMenu = [(object) [
                'jum_menu' => in_array((string) $regIdMenu, $roleMenuIds, true) ? 1 : 0,
            ]];
        }

        foreach ($stmtSubMenuId as $dataSubMenuId) {
            $regIdSubMenu = $dataSubMenuId->id;
            $stmtRoleSubMenu = [(object) [
                'jum_submenu' => in_array((string) $regIdSubMenu, $roleSubMenuIds, true) ? 1 : 0,
            ]];
        }

        (isset($stmtRoleMenu[0]->jum_menu) && $stmtRoleMenu[0]->jum_menu > 0) ? $aksesMenu = 1 : $aksesMenu = 0;
        (isset($stmtRoleSubMenu[0]->jum_submenu) && $stmtRoleSubMenu[0]->jum_submenu > 0) ? $aksesSubMenu = 1 : $aksesSubMenu = 0;


        // dd([
        //     'stmtMenu' => $stmtMenu,
        //     'stmtSubMenu' => $stmtSubMenu,
        //     'stmtMenuId' => $stmtMenuId,
        //     'stmtSubMenuId' => $stmtSubMenuId,
        //     'aksesMenu' => $aksesMenu,
        //     'aksesSubMenu' => $aksesSubMenu
        // ]);
        return [
            'stmtMenu' => $stmtMenu,
            'stmtSubMenu' => $stmtSubMenu,
            'stmtMenuId' => $stmtMenuId,
            'stmtSubMenuId' => $stmtSubMenuId,
            'aksesMenu' => $aksesMenu,
            'aksesSubMenu' => $aksesSubMenu
        ];
    }
}

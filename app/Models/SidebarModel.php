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
        // $RouteName = Request::segment(1);
        $RouteName = Request::path();

        // cek menu & submenu apa saja yang dapat diakses oleh role yang login
        $stmtUsers = DB::table('users as a')
            ->join('tbl_master_role as b', 'a.id_role', '=', 'b.id')
            ->select('a.id_role', 'b.id_menu', 'b.id_submenu')
            ->where('a.id', $id)
            ->get();
        foreach ($stmtUsers as $dataUsers) {
            $idRole = $dataUsers->id_role;
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

        // $stmtMenuId = DB::select("select id from tbl_master_menu where link like '%" . $RouteName . "' ");
        $stmtMenuId = DB::select("
    SELECT id
    FROM tbl_master_menu
    WHERE link = ?
", ['/' . $RouteName]);


        // $stmtSubMenuId = DB::select("select id, id_menu from tbl_master_submenu where link like '%" . $RouteName . "' ");
        $stmtSubMenuId = DB::select("
    SELECT id, id_menu
    FROM tbl_master_submenu
    WHERE link = ?
", ['/' . $RouteName]);

        foreach ($stmtMenuId as $dataMenuId) {
            $regIdMenu = $dataMenuId->id;

            $stmtRoleMenu = DB::select("
        SELECT COUNT(id) AS jum_menu
        FROM tbl_master_role
        WHERE id = ?
          AND ? = ANY (string_to_array(id_menu, ',')::int[])
    ", [
                $idRole,
                $regIdMenu
            ]);

            if (($stmtRoleMenu[0]->jum_menu ?? 0) > 0) {
                $aksesMenu = 1;
                break;
            }
        }

        foreach ($stmtSubMenuId as $dataSubMenuId) {
            $regIdSubMenu = $dataSubMenuId->id;

            $stmtRoleSubMenu = DB::select("
        SELECT COUNT(id) AS jum_submenu
        FROM tbl_master_role
        WHERE id = ?
          AND ? = ANY (string_to_array(id_submenu, ',')::int[])
    ", [
                $idRole,
                $regIdSubMenu
            ]);

            if (($stmtRoleSubMenu[0]->jum_submenu ?? 0) > 0) {
                $aksesSubMenu = 1;
                break;
            }
        }

        $aksesMenu = (isset($stmtRoleMenu[0]->jum_menu) && $stmtRoleMenu[0]->jum_menu > 0) ? 1 : 0;

        $aksesSubMenu = (isset($stmtRoleSubMenu[0]->jum_submenu) && $stmtRoleSubMenu[0]->jum_submenu > 0) ? 1 : 0;

        // dd($stmtMenuId);
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

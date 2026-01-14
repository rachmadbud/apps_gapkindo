<?php

namespace App\Models;

use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

class CustomClass
{
    public function rootApp()
    {
        return "";
    }

    public function enkrip($id)
    {
        $enkripString = Crypt::encryptString($id);
        return $enkripString;
    }

    public function dekrip($id)
    {
        $dekripString = Crypt::decryptString($id);
        return $dekripString;
    }

    public function ketStatusData($id)
    {
        if ($id == 1) {
            $ketStatusData = "Aktif";
        } elseif ($id == 0) {
            $ketStatusData = "Tidak Aktif";
        } else {
            $ketStatusData = "-";
        }
        return $ketStatusData;
    }

    public function notifSuksesTambah()
    {
        return "Data berhasil diinput";
    }

    public function notifTidakSesuai()
    {
        return "Data gagal diinput";
    }

    public function notifPasswordTidakSesuai()
    {
        return "Data gagal diinput. Password yang Anda masukkan tidak sesuai";
    }

    public function notifSuksesEdit()
    {
        return "Data berhasil diubah";
    }

    public function notifSuksesHapus()
    {
        return "Data berhasil dihapus";
    }

    public function notifHeaderForbiddenAkses()
    {
        return "Anda tidak berhak mengakses halaman ini";
    }

    public function notifBodyForbiddenAkses()
    {
        return "Hubungi administrator aplikasi";
    }

    public function getNamaMenu($id)
    {
        global $stmt;
        $stmt = DB::table('tbl_master_menu')
            ->select('nama')
            ->where('id', $id)
            ->get();
        foreach ($stmt as $data) {
            $namaMenu = $data->nama;
        }
        // dd($namaMenu);
        return $namaMenu;
    }

    public function getNamaSubmenu($id)
    {
        global $stmt;
        if ($id == "0") {
            return "";
            exit;
        }
        $stmt = DB::table('tbl_master_submenu')
            ->select('nama')
            ->where('id', $id)
            ->get();
        foreach ($stmt as $data) {
            $namaSubmenu = $data->nama;
        }
        return $namaSubmenu;
    }

    public function getNamaMenuFromSubmenu($id)
    {
        global $stmt;
        if ($id == "0") {
            return "";
            exit;
        }
        $stmt = DB::table('tbl_master_submenu as a')
            ->join('tbl_master_menu as b', 'a.id_menu', '=', 'b.id')
            ->select('b.nama')
            ->where('a.id', '=', $id)
            ->get();
        foreach ($stmt as $data) {
            $namaMenuFromSubmenu = $data->nama;
        }
        return $namaMenuFromSubmenu;
    }

    public function getNamaRole($id)
    {
        global $stmt;
        $stmt = DB::table('tbl_master_role')
            ->select('nama')
            ->where('id', $id)
            ->get();
        foreach ($stmt as $data) {
            $namaRole = $data->nama;
        }
        return $namaRole;
    }

    public function getNamaUnitKerja($id)
    {
        global $stmt;
        $stmt = DB::table('tbl_master_unit_kerja')
            ->select('nama')
            ->where('id', $id)
            ->get();
        foreach ($stmt as $data) {
            $namaUnitKerja = $data->nama;
        }
        return $namaUnitKerja;
    }

    public function kosongkanPassword()
    {
        return "Kosongkan kolom jika tidak ada perubahan password";
    }

    public function getNamaUser($id)
    {
        global $stmt;
        $stmt = DB::table('users')
            ->select('name')
            ->where('id', $id)
            ->get();
        foreach ($stmt as $data) {
            $namaUser = $data->name;
        }
        return $namaUser;
    }

    public function folderGambar()
    {
        return "document/";
    }
    public function folderFileUpload()
    {
        return "document/MRI";
    }


    public function getNamaKaryawan($id)
    {
        global $stmt;
        $stmt = DB::table('users')
            ->select('name')
            ->where('id', $id)
            ->get();
        foreach ($stmt as $data) {
            $namaKaryawan = $data->name;
        }
        return $namaKaryawan;
    }

    public function notifGagalLogin()
    {
        // return "Login gagal. Email / Password salah atau User tidak terdaftar.";
        return "Login gagal. NRIK / Password salah atau User tidak terdaftar.";
    }

    public function notifIPNyangkut()
    {
        return "Login gagal. User masih login di tempat lain";
    }

    public function notifBlokirLogin()
    {
        return "User Anda diblokir karena sudah 3 (tiga) kali gagal login. ";
    }

    public function notifGagalGantiPassword()
    {
        return "Password gagal diubah.";
    }

    public function notifBerhasilGantiPassword()
    {
        return "Password berhasil diubah.";
    }

    public function notifKonfirmasiPasswordSalah()
    {
        return "Password gagal diubah. Password baru dan konfirmasi password baru tidak sesuai.";
    }

    public function notifPasswordLamaSalah()
    {
        return "Password gagal diubah. Password lama yang Anda masukkan salah.";
    }

    public function notifPasswordLamaPasswordBaruSama()
    {
        return "Password gagal diubah. Password baru tidak boleh sama dengan password lama.";
    }

    public function ketStatusBlokir($id)
    {
        if ($id == 1) {
            $ketStatusBlokir = "User Terblokir";
        } else {
            $ketStatusBlokir = "-";
        }
        return $ketStatusBlokir;
    }

    public function notifSuksesBukaBlokir()
    {
        return "Buka blokir user berhasil";
    }

    public function notifSuksesBukaIPNyangkut()
    {
        return "Melepaskan IP Address user berhasil";
    }

    public function folderUploads()
    {
        return "uploads/";
    }

    public function notifLearningOutOfDate()
    {
        return "E-Learning Sudah Kadaluarsa";
    }

    public function notifElearningIsLock()
    {
        return "E-Learning yang anda pilih sudah di kunci";
    }

    public static function formatRibuan($angka)
    {
        if ($angka === null || $angka === '') {
            return '-';
        }

        return number_format((float) $angka, 0, ',', '.');
    }
}

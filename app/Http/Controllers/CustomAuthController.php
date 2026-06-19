<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Carbon\Carbon;
use Hash;
use Session;


class CustomAuthController extends Controller
{

    public function index()
    {
        return view('auth.login');
    }


    public function customLogin(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('name', 'password');

        if (Auth::attempt($credentials)) { // Berhasil login

            Session::put('errorLogin', 0);

            // Cek apakah passwordnya expired atau tidak
            $todayDate = Carbon::now()->toDateString();
            $expiredPassword = auth()->user()->expired_password;

            if ($todayDate >= $expiredPassword) { // Jika password expired
                return redirect()
                    ->intended('/gantiPassword')
                    ->with('notifResetPassword', 'Password expired. Mohon ubah password Anda terlebih dahulu');
            } else {
                return redirect('/dashboard')
                    ->withSuccess('Signed in');
            }
        } else { // Jika salah password / keblokir
            if (Session::get('errorLogin') !== null) {
                $sessionErrorLogin = Session::get('errorLogin') + 1;
                Session::put('errorLogin', $sessionErrorLogin);

                if ($sessionErrorLogin >= config('secure.APP_SEKURITI_FAIL_LOGIN')) {
                    error_log($request->name);

                    DB::table('users')->where('name', $request->name)->update([
                        'password' => bcrypt('Bwwy@2023'),
                        'expired_password' => '1970-01-01',
                        'is_blokir' => '1'
                    ]);
                }
            } else {
                Session::put('errorLogin', 1);
                $sessionErrorLogin = Session::get('errorLogin');
            }

            return back()->with('loginError', $sessionErrorLogin);
        }
    }


    public function registration()
    {
        return view('auth.registration');
    }


    public function customRegistration(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        $data = $request->all();
        $check = $this->create($data);

        return redirect("dashboard")->withSuccess('You have signed-in');
    }


    public function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password'])
        ]);
    }


    public function dashboard()
    {
        if (Auth::check()) {
            return view('dashboard');
        }

        return redirect("login")->withSuccess('You are not allowed to access');
    }


    public function signOut()
    {
        if (isset(auth()->user()->id)) {
            // update IP Address
            $id = auth()->user()->id;
            $ipAddress = NULL;
            DB::table('users')->where('id', $id)->update([
                'ip_address' => $ipAddress
            ]);

            Session::flush();
            Auth::logout();
        }

        return Redirect('login');
    }
}

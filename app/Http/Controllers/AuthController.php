<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function login(){
        return view('auth.login');
    }
    public function aksiLogin(Request $request){
        $credentials = $request->validate([
            'email' => 'required',
            'password'=> 'required',
        ]);

        if(Auth::attempt($credentials)) {
            // dd('masukk bos');
            Session::flash('success', 'Login berhasil! Selamat datang, ' . auth()->user()->nama_lengkap);
            if(Auth::user()->role == 'admin') {
                return redirect('/dashboard');
            }elseif(Auth::user()->role == 'petugas') {
                return redirect('/dashboard');
            }else{
                return redirect('/');
            }
        }else {
            Session::flash('error', 'Email atau password salah. Silakan coba lagi.');
            // dd('gagal bos');
            return redirect('/login');
        }
    }
    public function register() {
        return view('auth.register');
    }
    public function createAccount(Request $request) {
        $request->validate([
            'username' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);
        // dd($request->all());
        $request['password'] = Hash::make($request['password']);
        $request['role'] = 'user';
        $user = User::create($request->all());
        if($user) {
            Session::flash('success', 'Akun berhasil dibuat!' );
            return redirect('/login');
        }else {
            Session::flash('error', 'Gagal daftar!');
            return redirect('/register');
        }
    }

    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}

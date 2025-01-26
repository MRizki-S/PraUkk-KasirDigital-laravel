<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function login() {
        return  view('auth.login');
    }
    // aksi login
    public function aksiLogin(Request $request) {
        // dd($request->all());
        $credentials = $request->validate([
            'email' => 'required',
            'password'=> 'required',
        ]);

        if(Auth::attempt($credentials)) {
            // dd('masukk bos');
            Session::flash('success', 'Login berhasil! Selamat datang, ' . auth()->user()->nama_lengkap);
            return redirect('/dashboard');
        }else {
            Session::flash('error', 'Email atau password salah. Silakan coba lagi.');
            // dd('gagal bos');
            return redirect('/login');
        }
    }

    // register
    public function register() {
        // return view('auth.register');
        $user = User::all();
        return view('auth.register.index', compact('user'));
    }
    // aksi register
    public function registration(Request $request) {
        // dd($request->all());
        $request->validate([
            'username' => 'required',
            'email'  => 'required|email|unique:users,email',
            'password' => 'required',
            'nama_lengkap' => 'required'
        ]);

        $request['role'] = 'petugas';
        $request['password'] = Hash::make($request->password);
        $user = User::create($request->all());
        if($user) {

            Session::flash('success', 'Akun berhasil dibuat!' );
            return redirect('/register');
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


    public function editUser($id, Request $request) {
        $request->validate([
            'username' => 'required',
            'email'  => 'required|email|unique:users,email,' . $id,
            'nama_lengkap' => 'required'
        ]);
        $user = User::find($id);
        $user->update($request->all());

        Session::flash('success', 'Data user berhasil diubah!' );
        return redirect('/register');
    }

    public function deleteUser($id) {
        $user = User::find($id);
        $user->delete();
        Session::flash('success', 'Data user berhasil dihapus!' );
        return redirect('/register');
    }
}

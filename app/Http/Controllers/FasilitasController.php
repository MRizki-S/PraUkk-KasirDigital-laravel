<?php

namespace App\Http\Controllers;

use App\Models\Fasilitas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class FasilitasController extends Controller
{
    public function index() {
        $fasilitas = Fasilitas::all();

        return view('fasilitas.index', compact('fasilitas'));
    }
    public function store(Request $request) {
        // dd($request->all());
        $request->validate([
            'nama' => 'required',
            'deskripsi' => 'required',
        ]);

        $createFasilitas = Fasilitas::create($request->all());

        if($createFasilitas) {
            Session::flash('success', 'Fasilitas berhasil ditambahkan!');
            return redirect('/fasilitas');
        }else {
            Session::flash('error',  'Oops! 😓 Ada yang salah saat menambahkan fasilitas. Coba lagi sebentar, ya!');
            return redirect('/fasilitas');
        }
    }

    // // function delete data
    public function delete($id) {
        $find = Fasilitas::find($id);


        if (!$find) {
            Session::flash('error', 'Fasilitas tidak ditemukan 😓, coba lagi beberapa saat!');
        } elseif ($find->delete()) {
            Session::flash('success', 'Fasilitas berhasil dihapus!');
        } else {
            Session::flash('error', 'Fasilitas gagal dihapus!');
        }

        return redirect('/fasilitas');
    }
}

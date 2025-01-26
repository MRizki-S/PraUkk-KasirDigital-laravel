<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PelangganController extends Controller
{
    public function index() {
        $pelanggan = Pelanggan::with('penjualans.detailPenjualans.produk')->get();
        // dd($pelanggan);

        return view('pelanggan.index', compact('pelanggan'));
    }
    public function store(Request $request) {
        // dd($request->all());
        $request->validate([
            'nama_pelanggan' => 'required',
            'alamat' => 'required',
            'no_telepon' => 'required',
        ], [
            'nama_pelanggan.required' => 'Nama pelanggan wajib diisi.',
            'alamat.required' => 'Alamat pelanggan wajib diisi.',
            'no_telepon.required' => 'Nomor telepon pelanggan wajib diisi.',
        ]);


        $addPelanggan = Pelanggan::create($request->all());

        if($addPelanggan) {
            Session::flash('success', 'Pelanggan berhasil ditambahkan!');
            return redirect('/pelanggan');
        }else {
            Session::flash('error',  'Oops! 😓 Ada yang salah saat menambahkan pelanggan. Coba lagi sebentar, ya!');
            return redirect('/pelanggan');
        }
    }

    public function update($id, Request $request) {
        // dd($request->all());
        $request->validate([
            'nama_pelanggan' => 'required',
            'alamat' => 'required',
            'no_telepon' => 'required',
        ], [
            'nama_pelanggan.required' => 'Nama pelanggan wajib diisi.',
            'alamat.required' => 'Alamat pelanggan wajib diisi.',
            'no_telepon.required' => 'Nomor telepon pelanggan wajib diisi.',
        ]);

        $findPelanggan = Pelanggan::find($id);
        $updatePelanggan = $findPelanggan->update($request->all());

        if($updatePelanggan) {
            Session::flash('success', 'Data Pelanggan berhasil diubah!');
            return redirect('/pelanggan');
        }else{
            Session::flash('error', 'Data Pelanggan gagal diubah!');
            return redirect('/pelanggan');
        }

    }

    public function delete($id) {
        $findPelanggan = Pelanggan::find($id);

        if(!$findPelanggan) {
            Session::flash('error', 'Pelanggan tidak ditemukan 😓, coba lagi beberapa saat!');
        } elseif ($findPelanggan->delete()) {
            Session::flash('success', 'Pelanggan berhasil dihapus!');
        } else {
            Session::flash('error', 'Pelanggan gagal dihapus!');
        }

        return redirect('/pelanggan');

    }
}

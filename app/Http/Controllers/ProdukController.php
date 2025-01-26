<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ProdukController extends Controller
{
    public function index() {
        $produk = Produk::all();
        return view('produk.index', compact('produk'));
    }
    public function search(Request $request) {
        $keyword = $request->input('keyword');
        $produk = Produk::where('nama_produk', 'like', "%{$keyword}%")->get();

        return response()->json($produk);
    }

    public function store(Request $request) {
        // dd($request->all());
        $request->validate([
            'nama_produk' => 'required',
            'harga' => 'required|numeric|min:0',
            'stok' => 'required|integer|min:0'
        ]);

        $createProduk = Produk::create($request->all());

        if($createProduk) {
            Session::flash('success', 'Produk berhasil ditambahkan!');
            return redirect('/produk');
        }else {
            Session::flash('error',  'Oops! 😓 Ada yang salah saat menambahkan produk. Coba lagi sebentar, ya!');
            return redirect('/produk');
        }
    }

    public function update($id, Request $request) {
        // dd($request->all());
        $request->validate([
            'nama_produk' => 'required',
            'harga' => 'required|numeric|min:0',
            'stok' => 'required|integer|min:0'
        ]);

        $produk = Produk::find($id);
        $updateProduk = $produk->update($request->all());

        if($updateProduk) {
            Session::flash('success', 'Produk berhasil diubah!');
            return redirect('/produk');
        }else{
            Session::flash('error', 'Produk gagal diubah!');
            return redirect('/produk');
        }

    }

    // delete produk
    public function delete($id) {
        $findProduk = Produk::find($id);

        if (!$findProduk) {
            Session::flash('error', 'Produk tidak ditemukan 😓, coba lagi beberapa saat!');
        } elseif ($findProduk->delete()) {
            Session::flash('success', 'Produk berhasil dihapus!');
        } else {
            Session::flash('error', 'Produk gagal dihapus!');
        }

        return redirect('/produk');
    }

}

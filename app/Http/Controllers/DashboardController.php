<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use App\Models\Penjualan;
use App\Models\Produk;
use App\Models\User;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $totalProduk = Produk::count();
        $totalPelanggan = Pelanggan::count();
        $totalPenjualan = Penjualan::count();
        $totalPetugas = User::where('role', 'petugas')->count();

        $produkData = Produk::select('nama_produk', 'stok')->get();
        // dd($produkData);

        $dataPembelianPelanggan = Penjualan::with('pelanggan') // Load data pelanggan terkait
        ->get()
        ->groupBy('pelanggan_id') // Mengelompokkan data berdasarkan pelanggan_id
        ->map(function ($sales, $pelanggan_id) {
            $pelanggan = $sales->first()->pelanggan; // Ambil data pelanggan dari salah satu item
            $totalSales = $sales->count(); // Hitung total transaksi

            return [
                'nama_pelanggan' => $pelanggan->nama_pelanggan,
                'total_pembelian' => $totalSales,
            ];
        })
        ->sortByDesc('total_pembelian') // Urutkan berdasarkan total pembelian
        ->take(5) // Ambil 5 pelanggan teratas
        ->values(); // Reset key array'
        // dd($dataPembelianPelanggan);

        return view('dashboard.index', compact('totalProduk', 'totalPelanggan', 'totalPenjualan', 'totalPetugas', 'produkData', 'dataPembelianPelanggan'));
        // return view('dashboard.index');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Pelanggan;
use App\Models\Penjualan;
use Illuminate\Http\Request;
use App\Models\DetailPenjualan;
use Illuminate\Support\Facades\Session;

class PenjualanController extends Controller
{
    public function index()
    {
        $penjualan = Penjualan::with(['pelanggan', 'detailPenjualans.produk'])->get();
        // dd($penjualan);
        $pelanggan = Pelanggan::all();
        $produk = Produk::all();
        return view('penjualan.index', compact('penjualan', 'pelanggan', 'produk'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tanggal_penjualan' => 'required|date',
            'pelanggan_id' => 'required|integer|exists:pelanggan,id',
            'produk_id' => 'required|array',
            'produk_id.*' => 'required|integer|exists:produk,id',
            'jumlah' => 'required|array',
            'jumlah.*' => 'required|integer|min:1',
        ]);

        try {
            foreach ($request->produk_id as $index => $produkId) {
                $produk = Produk::findOrFail($produkId);
                $jumlah = $request->jumlah[$index];

                if ($produk->stok < $jumlah) {
                    return redirect()->back()->with('error', "Stok produk " . $produk->nama_produk . " tidak mencukupi. (Stok tersedia: ". $produk->stok .")");
                }
            }

            // Buat data penjualan
            $penjualan = Penjualan::create([
                'tanggal_penjualan' => $request->tanggal_penjualan,
                'pelanggan_id' => $request->pelanggan_id,
                'total_harga' => 0,
            ]);

            $totalHarga = 0;

            // Tambahkan detail penjualan
            foreach ($request->produk_id as $index => $produkId) {
                $produk = Produk::findOrFail($produkId);
                $jumlah = $request->jumlah[$index];
                $subtotal = $produk->harga * $jumlah;

                // Simpan ke detail penjualan
                DetailPenjualan::create([
                    'penjualan_id' => $penjualan->id,
                    'produk_id' => $produk->id,
                    'jumlah_produk' => $jumlah,
                    'subtotal' => $subtotal,
                ]);

                $totalHarga += $subtotal; // Tambahkan ke total harga

                // Kurangi stok produk
                $produk->decrement('stok', $jumlah);
            }

            // Update total harga dipenjualan
            $penjualan->update(['total_harga' => $totalHarga]);

            return redirect()->back()->with('success', 'Penjualan berhasil ditambahkan.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }


    public function update(Request $request, $id)
    {
        // Validasi data
        $request->validate([
            'tanggal_penjualan' => 'required|date',
            'pelanggan_id' => 'required|exists:pelanggan,id',
            'produk_id' => 'required|array',
            'produk_id.*' => 'exists:produk,id',
            'jumlah' => 'required|array',
            'jumlah.*' => 'integer|min:1',
        ]);

        // Ambil data penjualan yang akan diupdate
        $penjualan = Penjualan::with('detailPenjualans.produk')->findOrFail($id);
        // dd($penjualan);
        // Update tabel penjualan (tanggal dan pelanggan)
        $penjualan->update([
            'tanggal_penjualan' => $request->tanggal_penjualan,
            'pelanggan_id' => $request->pelanggan_id,
        ]);

        $totalHarga = 0;


        // Perbarui detail penjualan
        foreach ($penjualan->detailPenjualans as $index => $detail) {
            $newJumlah = $request->jumlah[$index];

            // Update stok produk
            $produk = $detail->produk;
            // $stokLama = $produk->stok;
            $stokBaru = $produk->stok - $newJumlah;
            $produk->update(['stok' => $stokBaru]);

            $subtotal = $produk->harga * $newJumlah;
            $detail->update([
                'jumlah_produk' => $newJumlah,
                'subtotal' => $subtotal,
            ]);

            // Tambahkan subtotal ke total harga
            $totalHarga += $subtotal;
        }

        // Update total harga di tabel penjualan
        $penjualan->update(['total_harga' => $totalHarga]);

        // Redirect atau response
        return redirect('/penjualan')->with('success', 'Data penjualan berhasil diubah.');
    }

    public function delete($id)
    {
        // Cari data penjualan
        $penjualan = Penjualan::with('detailPenjualans.produk')->findOrFail($id);

        // Kembalikan stok produk sebelum menghapus
        foreach ($penjualan->detailPenjualans as $detail) {
            $produk = $detail->produk;
            $produk->update(['stok' => $produk->stok + $detail->jumlah_produk]);
            $detail->delete();
        }

        $penjualan->delete();

        return redirect('/penjualan')->with('success', 'Data penjualan berhasil dihapus.');
    }

}

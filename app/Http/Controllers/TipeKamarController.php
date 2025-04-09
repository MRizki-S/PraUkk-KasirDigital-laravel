<?php
namespace App\Http\Controllers;

use App\Models\Fasilitas;
use App\Models\FasilitasKamar;
use App\Models\KamarType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class TipeKamarController extends Controller
{
    public function index()
    {
        $kamarType    = KamarType::with('fasilitas')->get();
        $fasilitasAll = Fasilitas::all();
        // dd($kamarType);
        return view('tipeKamar.index', compact('kamarType', 'fasilitasAll'));
    }
    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'nama'           => 'required',
            'deskripsi'      => 'required',
            'harga_permalam' => 'required|numeric',
        ]);

        // cek fasilitas
        if (! $request->has('fasilitas') || empty(array_filter($request->fasilitas))) {
            Session::flash('error', 'Oops! 😓 Anda harus memilih setidaknya satu fasilitas.');
            return redirect()->back()->withInput();
        }

        // dd($request->all());

        $newName = '';
        if ($request->hasFile('foto')) {
            $extension = $request->file('foto')->getClientOriginalExtension();
            $newName   = $request['nama'] . '-' . now()->timestamp . '.' . $extension;

            $request->file('foto')->storeAs('public/imagesType', $newName);
        }
        $request['image'] = $newName;
        // dd($request['image']);

        $request['jumlah_kamar'] = 0;

        $createTipeKamar = KamarType::create($request->all());

        if ($createTipeKamar) {
            // Simpan fasilitas ke tabel pivot fasilitas_kamar
            foreach ($request->fasilitas as $fasilitasId) {
                FasilitasKamar::create([
                    'kamar_type_id' => $createTipeKamar->id,
                    'fasilitas_id'  => $fasilitasId,
                ]);
            }

            // Beri notifikasi sukses
            Session::flash('success', 'Tipe Kamar berhasil ditambahkan!');
            return redirect('/tipe-kamar');
        } else {
            // Beri notifikasi error
            Session::flash('error', 'Oops! 😓 Ada yang salah saat menambahkan Tipe Kamar. Coba lagi sebentar, ya!');
            return redirect('/tipe-kamar');
        }
    }

    public function update($id, Request $request)
    {
        // dd($request->all());
        $request->validate([
            'nama'           => 'required',
            'deskripsi'      => 'required',
            'harga_permalam' => 'required|numeric',
        ]);

        $tipeKamar = KamarType::find($id);

        $newName = '';
        if ($request->hasFile('foto')) {
            if ($tipeKamar->image) {
                Storage::delete('public/imagesType/' . $tipeKamar->image);
            }

            $extension = $request->file('foto')->getClientOriginalExtension();
            $newName   = $newName   = $request['nama'] . '-' . now()->timestamp . '.' . $extension;
            $request->file('foto')->storeAs('public/imagesType', $newName);

            // if (! $request->file('foto')->storeAs('public/imagesType', $newName)) {
            //     FacadesLog::error('File gagal disimpan pada album ' . $id . ' dengan nama ' . $newName);
            // }

            $request['image'] = $newName;
            // dd($request['image']);
        } else {
            $request['image'] = $tipeKamar->image;
        }

        $updatetipeKamar = $tipeKamar->update($request->all());

        if ($updatetipeKamar) {

            if ($request->has('fasilitas')) {
                // Hapus nilai kosong dari array fasilitas sebelum sync
                $validFasilitas = array_filter($request->fasilitas);

                if (!empty($validFasilitas)) {
                    // Sinkronisasi hanya dengan fasilitas yang valid
                    $tipeKamar->fasilitas()->sync($validFasilitas);
                } else {
                    // Jika setelah filter kosong, tampilkan error menggunakan Session Flash
                    Session::flash('error', 'Oops! 😓 Anda harus memilih setidaknya satu fasilitas.');
                    return redirect()->back();
                }
            } else {
                // Jika tidak ada fasilitas yang dikirim, tampilkan error menggunakan Session Flash
                Session::flash('error', 'Oops! 😓 Anda harus memilih setidaknya satu fasilitas.');
                return redirect()->back();
            }

            // dd($request->all());

            Session::flash('success', 'Tipe Kamar berhasil diubah!');
            return redirect('/tipe-kamar');
        } else {
            Session::flash('error', 'Tipe Kamar gagal diubah!');
            return redirect('/tipe-kamar');
        }

    }

    // function delete data
    public function delete($id)
    {
        $findTypeKamar = KamarType::find($id);

        if (! $findTypeKamar) {
            Session::flash('error', 'Type Kamar tidak ditemukan 😓, coba lagi beberapa saat!');
        }

        if ($findTypeKamar->image) {
            Storage::delete('public/imagesType/' . $findTypeKamar->image);
        }

        // Hapus fasilitas terkait di tabel pivot sebelum menghapus tipe kamar
        $findTypeKamar->fasilitas()->detach();

        // Hapus tipe kamar
        if ($findTypeKamar->delete()) {
            Session::flash('success', 'Type Kamar dan fasilitas terkait berhasil dihapus!');
        } else {
            Session::flash('error', 'Type Kamar gagal dihapus!');
        }

        return redirect('/tipe-kamar');
    }

}

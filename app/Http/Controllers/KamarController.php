<?php

namespace App\Http\Controllers;

use App\Models\Kamar;
use App\Models\KamarType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class KamarController extends Controller
{
    public function index() {
        $kamar = Kamar::with('kamarType')->get();
        // dd($kamar);
        $kamarType = KamarType::all();
        return view('kamar.index', compact('kamar', 'kamarType'));
    }
    public function store(Request $request) {
        // dd($request->all());
        $request->validate([
            'kamar_type_id' => 'required',
            'no_kamar' => 'required',
        ]);

        $findTipeKamar = KamarType::find($request->kamar_type_id);
        $findTipeKamar->jumlah_kamar = $findTipeKamar->jumlah_kamar + 1;
        $findTipeKamar->save();

        $request['user_id'] = Auth::user()->id;
        $request['status'] = 'available';
        $createKamar = Kamar::create($request->all());

        if($createKamar) {
            Session::flash('success', 'Kamar berhasil ditambahkan!');
            return redirect('/kamar');
        }else {
            Session::flash('error',  'Oops! 😓 Ada yang salah saat menambahkan kamar. Coba lagi sebentar, ya!');
            return redirect('/kamar');
        }
    }

    public function update($id, Request $request) {
        // dd($request->all());
        $request->validate([
            'kamar_type_id' => 'required',
            'no_kamar' => 'required',
        ]);

        $request['user_id'] = Auth::user()->id;
        $request['status'] = $request->status;

        $kamar = Kamar::find($id);
        $updatekamar = $kamar->update($request->all());

        if($updatekamar) {
            Session::flash('success', 'kamar berhasil diubah!');
            return redirect('/kamar');
        }else{
            Session::flash('error', 'kamar gagal diubah!');
            return redirect('/kamar');
        }

    }

    // function delete data
    public function delete($id) {
        $findKamar = Kamar::find($id);

        $findTipeKamar = KamarType::find($findKamar->kamar_type_id);
        $findTipeKamar->jumlah_kamar = $findTipeKamar->jumlah_kamar - 1;
        $findTipeKamar->save();

        if (!$findKamar) {
            Session::flash('error', 'Kamar tidak ditemukan 😓, coba lagi beberapa saat!');
        } elseif ($findKamar->delete()) {
            Session::flash('success', 'Kamar berhasil dihapus!');
        } else {
            Session::flash('error', 'Kamar gagal dihapus!');
        }

        return redirect('/kamar');
    }


}

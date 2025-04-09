<?php

namespace App\Http\Controllers;

use App\Models\FasilitasKamar;
use Illuminate\Http\Request;

class FasilitasKamarController extends Controller
{
    public function index() {
        // $fasilitasKamar = FasilitasKamar::with(['kamarType', 'fasilitas'])->get();
        // Kelompokkan berdasarkan nama tipe kamar

        $groupFasilitas = FasilitasKamar::with(['kamarType', 'fasilitas'])
                        ->get()
                        ->groupBy('kamarType.nama');
        // dd($groupFasilitas);
        return view('fasilitas-kamar.index', compact('groupFasilitas'));
    }
}

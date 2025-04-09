<?php

namespace App\Http\Controllers;

use App\Models\KamarType;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index() {
        $tipeKamar = KamarType::with('fasilitas')->get();
        // dd($tipeKamar);

        return view('landing.home.index', compact('tipeKamar'));
    }
}

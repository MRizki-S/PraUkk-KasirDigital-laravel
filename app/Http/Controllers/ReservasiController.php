<?php
namespace App\Http\Controllers;

use App\Models\Kamar;
use PDF;
use App\Models\KamarType;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ReservasiController extends Controller
{
    public function index()
    {
        $reservasi = Reservation::with('kamarType')->get();
        // dd($reservasi);

        return view('reservasi.index', compact('reservasi'));
    }

    // for user function
    public function pesanSekarang(Request $request)
    {
        // dd($request->all());
        $check_in_date  = $request->check_in_date;
        $check_out_date = $request->check_out_date;
        $jumlah_kamar   = $request->jumlah_kamar;
        $kamarType      = KamarType::all();
        // dd($data);
        return view('landing.home.booking', compact('check_in_date', 'check_out_date', 'jumlah_kamar', 'jumlah_kamar', 'kamarType'));
    }
    public function aksiPesan(Request $request)
    {
        // Validasi input
        $request->validate([
            'check_in_date'  => 'required|date',
            'check_out_date' => 'required|date|after:check_in_date',
            'jumlah_kamar'   => 'required|integer|min:1',
            'nama_pemesan'   => 'required|string|max:255',
            'email'          => 'required|email',
            'no_handphone'   => 'required|string|max:15',
            'nama_tamu'      => 'required|string|max:255',
            'kamar_type_id'  => 'required|exists:kamar_type,id',
        ]);
        // dd($request->all());

        // Ambil harga per malam berdasarkan tipe kamar
        $kamarType = KamarType::find($request->kamar_type_id);
        if (! $kamarType) {
            return back()->with('error', 'Tipe kamar tidak ditemukan.');
        }

        // Hitung total malam menginap
        $checkIn    = Carbon::parse($request->check_in_date);
        $checkOut   = Carbon::parse($request->check_out_date);
        $totalMalam = $checkOut->diffInDays($checkIn);

        // Hitung total harga
        $totalHarga = $kamarType->harga_permalam * $totalMalam * $request->jumlah_kamar;

        // Cari kamar yang tersedia berdasarkan tipe kamar dan jumlah kamar yang dipesan
        $kamarTersedia = Kamar::where('kamar_type_id', $request->kamar_type_id)
            ->where('status', 'available')
            ->limit($request->jumlah_kamar)
            ->get();

        // Jika jumlah kamar tersedia kurang dari yang dibutuhkan, tampilkan error
        if ($kamarTersedia->count() < $request->jumlah_kamar) {
            return back()->with('error', 'Maaf, jumlah kamar yang tersedia tidak mencukupi.');
        }

        // Ambil nomor kamar dari kamar yang tersedia
        $nomorKamarList = $kamarTersedia->pluck('no_kamar')->implode(', ');

        // Simpan data pemesanan
        $request['user_id'] = Auth::id();
        $request['total_harga'] = $totalHarga;
        $request['no_kamar'] = $nomorKamarList;
        $reservation = Reservation::create($request->all());

        // Perbarui status kamar yang telah dipesan
        foreach ($kamarTersedia as $kamar) {
            $kamar->update(['status' => 'booked']);
            $kamar->save();
            // $reservation->kamars()->attach($kamar->id);
        }

        // Redirect dengan pesan sukses
        Session::flash('success', 'Pemesanan berhasil ditambahkan! Kamar yang dipesan: ' . $nomorKamarList);
        // return redirect('/', compact('reservation'));
        return view('landing.home.booking', compact('reservation'));
    }
    public function cetakBuktiPemesanan($id) {
         // Ambil data reservasi berdasarkan ID
        $reservation = Reservation::with(['user', 'kamarType'])->findOrFail($id);
        // dd($reservation);
        // Buat PDF dari view
        $pdf = PDF::loadView('pdf.invoice', compact('reservation'));

        // Unduh PDF dengan nama file khusus
        return $pdf->download('Bukti_Pemesanan_' . $reservation->id . '.pdf');
    }

    // public function store(Request $request) {
    //     // dd($request->all());
    //     $request->validate([
    //         'nama' => 'required',
    //         'deskripsi' => 'required',
    //     ]);

    //     $createFasilitas = Fasilitas::create($request->all());

    //     if($createFasilitas) {
    //         Session::flash('success', 'Fasilitas berhasil ditambahkan!');
    //         return redirect('/fasilitas');
    //     }else {
    //         Session::flash('error',  'Oops! 😓 Ada yang salah saat menambahkan fasilitas. Coba lagi sebentar, ya!');
    //         return redirect('/fasilitas');
    //     }
    // }

    // // public function update($id, Request $request) {
    // //     // dd($request->all());
    // //     $request->validate([
    // //         'kamar_type_id' => 'required',
    // //         'no_kamar' => 'required',
    // //     ]);

    // //     $request['user_id'] = Auth::user()->id;
    // //     $request['status'] = $request->status;

    // //     $kamar = Kamar::find($id);
    // //     $updatekamar = $kamar->update($request->all());

    // //     if($updatekamar) {
    // //         Session::flash('success', 'kamar berhasil diubah!');
    // //         return redirect('/kamar');
    // //     }else{
    // //         Session::flash('error', 'kamar gagal diubah!');
    // //         return redirect('/kamar');
    // //     }

    // // }

    // // // function delete data
    public function delete($id) {
        $find = Reservation::find($id);

        if (!$find) {
            Session::flash('error', 'Reservation tidak ditemukan 😓, coba lagi beberapa saat!');
        } elseif ($find->delete()) {
            Session::flash('success', 'Reservation berhasil dihapus!');
        } else {
            Session::flash('error', 'Reservation gagal dihapus!');
        }

        return redirect('/reservasi');
    }
}

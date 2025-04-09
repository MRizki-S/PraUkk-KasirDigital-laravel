<?php
namespace App\Http\Controllers;

use App\Models\Fasilitas;
use App\Models\Kamar;
use App\Models\KamarType;
use App\Models\Reservation;
use App\Models\User;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $totalKamar     = Kamar::count();
        $totalTipeKamar = KamarType::count();
        $totalFasilitas = Fasilitas::count();
        $totalPengguna  = User::where('role', 'user')->count();

        $kamarByType     = KamarType::all();
        $kamarLabels     = $kamarByType->pluck('nama');
        $kamarJumlahData = $kamarByType->pluck('jumlah_kamar');

        $incomeByMonth = Reservation::selectRaw('MONTH(created_at) as bulan, SUM(total_harga) as total_income')
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->get();
    //    dd( $incomeByMonth);

        // Pisahkan label bulan & data income
        $labelsBulan = $incomeByMonth->pluck('bulan')->map(function ($bulan) {
            return date('F', mktime(0, 0, 0, $bulan, 1)); // Konversi angka bulan ke nama bulan (Januari, Februari, dst)
        });
        // dd($labels);

        $dataPerbulan = $incomeByMonth->pluck('total_income');

        return view('dashboard.index', compact('totalKamar', 'totalTipeKamar', 'totalFasilitas', 'totalPengguna', 'kamarLabels', 'kamarJumlahData' , 'labelsBulan', 'dataPerbulan'));
    }
}

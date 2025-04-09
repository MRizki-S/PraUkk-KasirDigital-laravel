<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FasilitasController;
use App\Http\Controllers\FasilitasKamarController;
use App\Http\Controllers\KamarController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\ReservasiController;
use App\Http\Controllers\TipeKamarController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
 */
Route::get('/', [MainController::class, 'index']);

Route::group(['middleware' => 'guest'], function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/aksiLogin', [AuthController::class, 'aksiLogin']);
    Route::get('/register', [AuthController::class, 'register']);
    Route::post('/registration', [AuthController::class, 'createAccount']);
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('/logout', [AuthController::class, 'logout']);

    // akses admin dan petugas
    Route::middleware(['rolePetugasAdmin'])->group(function () {
        Route::get('/tipe-kamar', [TipeKamarController::class, 'index']);
        Route::get('/kamar', [KamarController::class, 'index']);

        Route::get('/reservasi', [ReservasiController::class, 'index']);
        Route::get('/deleteReservasi/{id}', [ReservasiController::class, 'delete']);
        // Route::get('/pesan-sekarang', [ReservasiController::class, 'pesanSekarang']);
        // Route::get('/download-buktiPemesanan/{id}', [ReservasiController::class, 'cetakBuktiPemesanan']);
        Route::get('/dashboard', [DashboardController::class, 'dashboard']);

        // fasilitas Kamar
        Route::get('/fasilitas-kamar', [FasilitasKamarController::class, 'index']);

    });

    // akses only admin
    Route::middleware(['roleAdmin'])->group(function () {

        //  Tipe Kamar
        Route::post('/tambahTipeKamar', [TipeKamarController::class, 'store']);
        Route::put('/editTipeKamar/{id}', [TipeKamarController::class, 'update']);
        Route::get('/deleteTipeKamar/{id}', [TipeKamarController::class, 'delete']);

        // kamar
        Route::post('/tambahKamar', [KamarController::class, 'store']);
        Route::put('/editKamar/{id}', [KamarController::class, 'update']);
        Route::get('/deleteKamar/{id}', [KamarController::class, 'delete']);

        // fasilitas
        Route::get('/fasilitas', [FasilitasController::class, 'index']);
        Route::post('/tambahFasilitas', [FasilitasController::class, 'store']);
        // Route::put('/editFasilitas/{id}', [FasilitasController::class, 'update']);
        Route::get('/deleteFasilitas/{id}', [FasilitasController::class, 'delete']);
    });

    // Route::post('/tambahReservasi', [ReservasiController::class, 'store']);
    // Route::put('/editReservasi/{id}', [ReservasiController::class, 'update']);
    // Route::get('/deleteReservasi/{id}', [ReservasiController::class, 'delete']);

    Route::get('/pesan-sekarang', [ReservasiController::class, 'pesanSekarang']);
    Route::post('/pesan-sekarang', [ReservasiController::class, 'pesanSekarang']);
    Route::post('/aksiPesan-sekarang', [ReservasiController::class, 'aksiPesan']);
    Route::get('/download-buktiPemesanan/{id}', [ReservasiController::class, 'cetakBuktiPemesanan']);
});

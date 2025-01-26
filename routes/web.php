<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\ProdukController;
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

Route::group(['middleware' => 'guest'], function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/aksiLogin', [AuthController::class, 'aksiLogin']);
    // Route::get('/register', [AuthController::class, 'register']);
    // Route::post('/registration', [AuthController::class, 'registration']);
});

Route::group(['middleware' => 'auth'], function () {
    // Route::get('/', function () {
    //     return view('produk.index');
    // });
    Route::get('/', function () {
        return view('welcome');
    });

    Route::get('/logout', [AuthController::class, 'logout']);

    Route::get('/dashboard', [DashboardController::class, 'dashboard']);

    Route::get('/produk', [ProdukController::class, 'index']);
    Route::get('/produk/search', [ProdukController::class, 'search'])->name('produk.search');
    Route::post('/tambahProduk', [ProdukController::class, 'store']);
    Route::put('/editProduk/{id}', [ProdukController::class, 'update']);
    Route::get('deleteProduk/{id}', [ProdukController::class, 'delete']);

    Route::middleware(['roleAdmin'])->group(function () {
        Route::get('/register', [AuthController::class, 'register']);
        Route::post('/registration', [AuthController::class, 'registration']);
        Route::put('/editUser/{id}', [AuthController::class, 'editUser']);
        Route::get('/deleteUser/{id}', [AuthController::class, 'deleteUser']);

        Route::get('/pelanggan', [PelangganController::class, 'index']);
        Route::post('/tambahPelanggan', [PelangganController::class, 'store']);
        Route::put('/editPelanggan/{id}', [PelangganController::class, 'update']);
        Route::get('/deletePelanggan/{id}', [PelangganController::class, 'delete']);
    });

        Route::get('/penjualan', [PenjualanController::class, 'index']);
        Route::post('/tambahPenjualan', [PenjualanController::class, 'store']);
        Route::put('/editPenjualan/{id}', [PenjualanController::class, 'update']);
        Route::get('/deletePenjualan/{id}', [PenjualanController::class, 'delete']);
});

<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\SppController;
use App\Http\Controllers\TunggakanController;
use App\Http\Controllers\UserController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboards');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    Route::middleware('CheckRole:administrator')->group(function() {
        Route::resource('users', AdminController::class);
        Route::resource('kelas', KelasController::class);
        Route::resource('siswa', SiswaController::class);
        Route::resource('spp', SppController::class);
    });

    Route::middleware('CheckRole:administrator,petugas')->group(function() {
        Route::resource('pembayaran', PembayaranController::class)->middleware('CheckRole:administrator,petugas');
        Route::get('laporan/online_pdf', [PembayaranController::class, 'laporanPdfOnline']);
        Route::get('laporan/download_pdf', [PembayaranController::class, 'laporanPdfDownload']);
        Route::post('filter-status', [SiswaController::class, 'filterStatusPembayaran']);
    });

    Route::middleware('CheckRole:petugas')->group(function() {
        Route::get('history-petugas', [PembayaranController::class, 'historyPembayaranPetugas'])->name('historypetugas');
    });

    Route::middleware('CheckRole:siswa')->group(function() {
        Route::get('status-tunggakan', [TunggakanController::class, 'siswaTunggakan'])->name('status-tunggakan');
        Route::get('print-pdf-single/{id}', [TunggakanController::class, 'printPdfSingle'])->name('print-pdf-single');
        Route::get('history', [PembayaranController::class, 'history'])->name('history');
    
    });

    


    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';



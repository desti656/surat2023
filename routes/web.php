<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\PermintaanController;
use App\Http\Controllers\ProfilDesaController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SuratKeluarController;
use App\Http\Controllers\SuratMasukController;
use App\Http\Controllers\WargaController;
use App\Models\PermintaanSurat;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware(['auth'])->group(function () {
    Route::get('/', [DashboardController::class,'index'])->name('root');
    Route::get('dashboard',[DashboardController::class,'index'])->name('dashboard');
    Route::prefix('dashboard')->group(function () {
        // Pengguna
        Route::resource('pengguna', PenggunaController::class);

        // Warga
        Route::post('warga/update',[WargaController::class,'update'])->name('warga.update');
        Route::get('warga/edit',[WargaController::class,'edit'])->name('warga.edit');
        Route::post('warga/post',[WargaController::class,'post'])->name('warga.post');
        Route::get('warga',[WargaController::class,'index'])->name('warga');

        // Permintaan
        Route::get('permintaan',[PermintaanController::class,'index'])->name('permintaan.index');
        Route::get('create',[PermintaanController::class,'create'])->name('permintaan.create');
        Route::post('permintaan',[PermintaanController::class,'store'])->name('permintaan.store');
        Route::delete('permintaan/{id}',[PermintaanController::class,'destroy'])->name('permintaan.destroy');
        Route::put('permintaan/{id}',[PermintaanController::class,'confirm'])->name('permintaan.confirm');
        Route::get('permintaan/print/{id}',[PermintaanController::class,'print'])->name('permintaan.print');
        Route::get('permintaan/persyaratan-surat/{id}', [PermintaanController::class, 'persyaratanSuratByJenis'])->name('permintaan.persyaratan');

        // Laporan
        Route::get('laporan',[LaporanController::class,'index'])->name('laporan');

        // Surat Masuk
        Route::resource('surat-masuk',SuratMasukController::class);

        // Surat Keluar
        Route::resource('surat-keluar',SuratKeluarController::class);

        // Profil Desa
        // Route::get('profil-desa/post',[ProfilDesaController::class,'create'])->name('profil-desa.create');
        Route::resource('profil-desa',ProfilDesaController::class);

        // Profile warga dan admin
        Route::post('profile/update',[ProfileController::class,'update'])->name('profile.update');
        Route::get('profile',[ProfileController::class,'index'])->name('profile');

    });
});
require __DIR__.'/auth.php';

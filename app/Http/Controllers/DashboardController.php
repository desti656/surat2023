<?php

namespace App\Http\Controllers;

use App\Models\PermintaanSurat;
use App\Models\ProfilDesa;
use App\Models\SuratMasuk;
use App\Models\SuratKeluar;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        if (Auth::user()->role_id == 3) {
            $totalPermintaan = PermintaanSurat::where('id_pengaju', Auth::user()->id)->count();
            $profil = ProfilDesa::first();
            $data = [
                'total_permintaan' => $totalPermintaan,
                'profil' => $profil,
            ];
        }
        else {
            $totalPermintaan = PermintaanSurat::count();
            $totalWarga = User::where('role_id', 3)->count();
            $totalSuratMasuk = SuratMasuk::count();
            $totalSuratKeluar = SuratKeluar::count();
            $profil = ProfilDesa::first();
            $data = [
                'total_permintaan' => $totalPermintaan,
                'total_warga' => $totalWarga,
                'total_surat_masuk' => $totalSuratMasuk,
                'total_surat_keluar' => $totalSuratKeluar,
                'profil' => $profil,
            ];
        }

        return view('dashboard', $data);
    }
}

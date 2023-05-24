<?php

namespace App\Http\Controllers;

use App\Models\SuratKeluar;
use Illuminate\Http\Request;

class SuratKeluarController extends Controller
{
    public function index()
    {
        $data = SuratKeluar::select(
            'surat_keluar.*',
            'j.name AS jenis_surat',
            'u.name'
        )
        ->join('permintaan_surat AS ps', 'ps.id', 'surat_keluar.id_permintaan_surat')
        ->join('users AS u', 'u.id', 'ps.id_pengaju')
        ->join('jenis_surat AS j', 'j.id', 'ps.id_jenis_surat')
        ->orderBy('surat_keluar.tanggal', 'DESC')
        ->get();

        return view('surat-keluar.index', compact('data'));
    }
}

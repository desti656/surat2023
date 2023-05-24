<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index()
    {
        $data = User::find(auth()->user()->id);
        return view('profile.index',compact('data'));
    }

    public function update(Request $request)
    {
        $warga = User::find($request->get('id'));
        $warga->name = $request->get('nama');
        $warga->username = $request->get('nik');
        if ($request->password)
            $warga->password = Hash::make($request->get('nik'));
        if (Auth::user()->role_id == 3) {
            $warga->address = $request->get('alamat');
            $warga->tempat_lahir = $request->get('tempat');
            $warga->tgl_lahir = $request->get('tgl');
            $warga->jenis_kelamin = $request->get('jenis_kelamin');
            $warga->agama = $request->get('agama');
            $warga->pekerjaan = $request->get('pekerjaan');
            $warga->status_perkawinan = $request->get('status_perkawinan');
            $warga->no_kk = $request->get('no_kk');
        }
        $warga->update();
        return redirect()->route('profile')->withStatus('Berhasil update profil');
    }
}

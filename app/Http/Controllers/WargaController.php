<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class WargaController extends Controller
{
    public function index()
    {
        $data = User::with('role')->where('role_id',3)->get();
        return view('warga.index',compact('data'));
    }

    public function post(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'nik' => 'required|unique:users,username',
            'alamat' => 'required'
        ]);
        try {
            $warga = new User;
            $warga->name = $request->get('nama');
            $warga->username = $request->get('nik');
            $warga->password = Hash::make($request->get('password'));
            $warga->address = $request->get('alamat');
            $warga->tempat_lahir = $request->get('tempat');
            $warga->tgl_lahir = $request->get('tgl');
            $warga->agama = $request->get('agama');
            $warga->pekerjaan = $request->get('pekerjaan');
            $warga->status_perkawinan = $request->get('status_perkawinan');
            $warga->no_kk = $request->get('no_kk');
            $warga->role_id = 3;
            $warga->save();
            return redirect()->route('warga')->withStatus('Berhasil menambahkan data');
        } catch (Exception $e) {
            return redirect()->route('warga')->withError('Terjadi kesalahan');
        }
    }
    public function edit(Request $request)
    {
        $data = User::find($request->get('id'));
        return response()->json([
            'data' => $data
        ]);
    }

    public function update(Request $request)
    {
        $warga = User::find($request->get('id'));
        $warga->name = $request->get('nama');
        $warga->username = $request->get('nik');
        $warga->password = Hash::make($request->get('nik'));
        $warga->address = $request->get('alamat');
        $warga->tempat_lahir = $request->get('tempat');
        $warga->tgl_lahir = $request->get('tgl');
        $warga->agama = $request->get('agama');
        $warga->pekerjaan = $request->get('pekerjaan');
        $warga->status_perkawinan = $request->get('status_perkawinan');
        $warga->no_kk = $request->get('no_kk');
        $warga->role_id = 3;
        $warga->update();
        return response()->json([
            'message' => 'Berhasil mengganti data.',
        ]);

    }
}

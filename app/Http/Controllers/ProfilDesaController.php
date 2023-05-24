<?php

namespace App\Http\Controllers;

use App\Models\ProfilDesa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfilDesaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = ProfilDesa::first();
        return view('profil-desa.create',compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $profil = ProfilDesa::find($id);
        $profil->name = $request->get('nama_desa');
        if ($request->hasFile('gambar_konten')) {
            if (Storage::exists("public/profil-desa/".$profil->foto)) {
                Storage::delete("public/profil-desa/".$profil->foto);
            }
            $file = $request->file('gambar_konten');
            $filename = date('YmdHis').'.'.$request->file('gambar_konten')->extension();
            $file->storeAs('public/profil-desa', $filename);
            $profil->foto = $filename;
        }
        $profil->kecamatan = $request->get('kecamatan');
        $profil->kabupaten = $request->get('kabupaten');
        $profil->nama_kades = $request->get('nama_kades');
        $profil->update();
        return redirect()->back()->withStatus('Berhasil mengubah data');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

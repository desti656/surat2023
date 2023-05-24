<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Laporan::select(
            'laporan.id',
            'laporan.id_surat_masuk',
            'laporan.id_surat_keluar',
            'sm.nomor AS no_surat_masuk',
            'sm.tanggal AS tgl_surat_masuk',
            'sk.nomor AS no_surat_keluar',
            'sk.tanggal AS tgl_surat_keluar',
            \DB::raw("IF (laporan.id_surat_masuk IS NULL, 'surat_keluar', 'surat_masuk') AS jenis")
        )
        ->leftJoin('surat_masuk AS sm', 'sm.id', 'laporan.id_surat_masuk')
        ->leftJoin('surat_keluar AS sk', 'sk.id', 'laporan.id_surat_keluar')
        ->get();

        return view('laporan.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        //
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

<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use App\Models\SuratMasuk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class SuratMasukController extends Controller
{
    public function index()
    {
        $data = SuratMasuk::orderBy('tanggal', 'DESC')->get();

        return view('surat-masuk.index', compact('data'));
    }

    public function create() 
    {
        return view('surat-masuk.create');
    }

    public function store(Request $request) 
    {
        $this->validate($request, [
            'nomor' => 'required|unique:surat_masuk,nomor',
            'tanggal' => 'required',
            'pengirim' => 'required',
            'perihal' => 'required',
            'disposisi' => 'required',
            'berkas' =>'required|mimes:pdf',
        ], [
            'required' => ':attribute harus diisi.',
            'unique' => ':attribute telah digunakan.',
            'mimes' => ':attribute hanya menerima pdf.',
        ], [
            'nomor' => 'Nomor',
            'tanggal' => 'Tanggal',
            'pengirim' => 'Pengirim',
            'perihal' => 'Perihal',
            'disposisi' => 'Disposisi',
            'berkas' => 'Scan berkas',
        ]);

        try {
            DB::beginTransaction();

            $newSuratMasuk = new SuratMasuk();
            $newSuratMasuk->nomor = $request->nomor;
            $newSuratMasuk->tanggal = $request->tanggal;
            $newSuratMasuk->pengirim = $request->pengirim;
            $newSuratMasuk->perihal = $request->perihal;
            $newSuratMasuk->disposisi = $request->disposisi;
            $file = $request->file('berkas');
            $filename = date('YmdHis').'.pdf';
            $file->storeAs('public/surat-masuk', $filename);
            $newSuratMasuk->file = $filename;
            $newSuratMasuk->save();

            $newLaporan = new Laporan();
            $newLaporan->id_surat_masuk = $newSuratMasuk->id;
            $newLaporan->save();

            DB::commit();

            return redirect('/dashboard/surat-masuk')->withStatus('Berhasil menyimpan data');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withError('Terjadi kesalahan');
        } catch (\Illuminate\Database\QueryException $e) {
            DB::rollBack();
            return back()->withError('Terjadi kesalahan pada database');
        }
    }

    public function edit($id) 
    {
        $data = SuratMasuk::find($id);

        return view('surat-masuk.edit', compact('data'));
    }

    public function update($id, Request $request) 
    {
        $suratMasuk = SuratMasuk::find($id);
        $isUnique = $request->nomor && $request->nomor != $suratMasuk->nomor ? '|unique:surat_masuk,nomor' : '';

        $this->validate($request, [
            'nomor' => 'required'.$isUnique,
            'tanggal' => 'required',
            'pengirim' => 'required',
            'perihal' => 'required',
            'disposisi' => 'required',
        ], [
            'required' => ':attribute harus diisi.',
            'unique' => ':attribute telah digunakan.',
        ], [
            'nomor' => 'Nomor',
            'tanggal' => 'Tanggal',
            'pengirim' => 'Pengirim',
            'perihal' => 'Perihal',
            'disposisi' => 'Disposisi',
        ]);
        
        try {
            DB::beginTransaction();

            $suratMasuk->nomor = $request->nomor;
            $suratMasuk->tanggal = $request->tanggal;
            $suratMasuk->pengirim = $request->pengirim;
            $suratMasuk->perihal = $request->perihal;
            $suratMasuk->disposisi = $request->disposisi;
            if ($request->file('berkas')) {
                if (Storage::exists("public/surat-masuk/".$suratMasuk->file)) {
                    Storage::delete("public/surat-masuk/".$suratMasuk->file);
                }
                $file = $request->file('berkas');
                $filename = date('YmdHis').'.pdf';
                $file->storeAs('public/surat-masuk', $filename);
                $suratMasuk->file = $filename;
            }
            $suratMasuk->save();

            DB::commit();

            return redirect('/dashboard/surat-masuk')->withStatus('Berhasil menyimpan data');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withError('Terjadi kesalahan');
        } catch (\Illuminate\Database\QueryException $e) {
            DB::rollBack();
            return back()->withError('Terjadi kesalahan pada database');
        }
    }

    public function destroy($id) 
    {
        try {
            $suratMasuk = SuratMasuk::findOrFail($id);
            if (Storage::exists("public/surat-masuk/".$suratMasuk->file)) {
                Storage::delete("public/surat-masuk/".$suratMasuk->file);
            }
            $suratMasuk->delete();

            return redirect('/dashboard/surat-masuk')->withStatus('Berhasil menghapus data');
        } catch (\Exception $e) {
            return $e->getMessage();
            return back()->withError('Terjadi kesalahan');
        } catch (\Illuminate\Database\QueryException $e) {
            return $e->getMessage();
            return back()->withError('Terjadi kesalahan pada database');
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\JenisSurat;
use App\Models\Laporan;
use App\Models\PermintaanSurat;
use App\Models\PersyaratanSurat;
use App\Models\ProfilDesa;
use App\Models\SuratKeluar;
use App\Models\UploadDokumen;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PermintaanController extends Controller
{
    private $params;
    
    public function index()
    {
        $data = PermintaanSurat::select(
                                    'permintaan_surat.*',
                                    'u.name AS user',
                                    'uu.name AS petugas',
                                    'js.name'
                                )
                                ->join('jenis_surat AS js', 'js.id', 'permintaan_surat.id_jenis_surat')
                                ->join('users AS u', 'u.id', 'permintaan_surat.id_pengaju')
                                ->leftJoin('users AS uu', 'uu.id', 'permintaan_surat.id_petugas')
                                ->orderBy('permintaan_surat.tanggal', 'desc')
                                ->get();
        foreach ($data as $key => $value) {
            $value->berkas_persyaratan = UploadDokumen::select('id', 'id_persyaratan', 'file')->where('id_permintaan_surat', $value->id)->get();
        }
        $this->params['data'] = $data;

        return view('permintaan.index', $this->params);
    }
    
    public function create()
    {
        $jenisSurat = JenisSurat::select('id', 'name')->orderBy('name')->get();
        if (Auth::user()->role_id != 3) {
            $this->params['warga'] = User::select('id','name','username')->where('role_id', 3)->orderBy('username')->get();
        }
        $this->params['jenis_surat'] = $jenisSurat;

        return view('permintaan.create', $this->params);
    }
    
    public function store(Request $request)
    {
        // return $request;
        try {
            DB::beginTransaction();

            $newPermintaan = new PermintaanSurat();
            $newPermintaan->id_jenis_surat = $request->id_jenis_surat;
            if (Auth::user()->role_id == 3)
                $newPermintaan->id_pengaju = Auth::user()->id;
            else
                $newPermintaan->id_pengaju = $request->id_warga;
            $newPermintaan->status = 'pending';
            $newPermintaan->tanggal = $request->tanggal;
            $newPermintaan->keterangan = $request->keterangan;
            $newPermintaan->save();
            
            for ($i=0; $i < count($request->id_persyaratan); $i++) { 
                $newUpload = new UploadDokumen();
                $newUpload->id_permintaan_surat = $newPermintaan->id;
                $newUpload->id_persyaratan = $request->id_persyaratan[$i];
                $file = $request->file('berkas')[$i];
                if (Auth::user()->role_id == 3)
                    $filename = Auth::user()->id.'-'.strtolower(str_replace(' ', '-', $request->berkas_name[$i])).'.pdf';
                else
                    $filename = $request->id_warga.'-'.strtolower(str_replace(' ', '-', $request->berkas_name[$i])).'.pdf';
                $file->storeAs('public/persyaratan-surat', $filename);
                $newUpload->file = $filename;
                $newUpload->save();
            }

            DB::commit();

            return redirect('/dashboard/permintaan')->withStatus('Berhasil mengirim permintaan surat');
        } catch (\Exception $e) {
            return $e->getMessage();
            DB::rollBack();
            return back()->withError('Terjadi kesalahan');
        } catch (\Illuminate\Database\QueryException $e) {
            return $e->getMessage();
            DB::rollBack();
            return back()->withError('Terjadi kesalahan pada database');
        }
    }

    public function persyaratanSuratByJenis($idJenisSurat)
    {
        $data = PersyaratanSurat::select('id', 'id_jenis_surat', 'name')->where('id_jenis_surat', $idJenisSurat)->orderBy('name')->get();

        return response()->json($data);
    }

    public function confirm(Request $request)
    {
        try {
            DB::beginTransaction();
            $permintaan = PermintaanSurat::find($request->id);
            $permintaan->id_petugas = Auth::user()->id;
            if ($request->tipe == 'accepted') {
                $permintaan->status = 'onprogress';
                $permintaan->confirm_at = date('Y-m-d');
            }
            elseif ($request->tipe == 'done') {
                $file = $request->file('berkas');
                $filename = date('YmdHis').'.pdf';
                $file->storeAs('public/permintaan-surat', $filename);
                
                $permintaan->status = $request->tipe;
                $permintaan->file = $filename;
                $permintaan->confirm_at = date('Y-m-d');

                $newSuratKeluar = new SuratKeluar();
                $newSuratKeluar->id_permintaan_surat = $permintaan->id;
                $newSuratKeluar->nomor = $permintaan->id;
                $newSuratKeluar->tanggal = date('Y-m-d');
                $newSuratKeluar->save();

                $newLaporan = new Laporan();
                $newLaporan->id_surat_keluar = $newSuratKeluar->id;
                $newLaporan->save();
            }
            else {
                $permintaan->status = $request->tipe;
                $permintaan->confirm_at = date('Y-m-d');
                $permintaan->alasan_penolakan = $request->alasan_penolakan;
            }
            $permintaan->save();

            DB::commit();

            return redirect('/dashboard/permintaan')->withStatus('Berhasil mengkonfirmasi permintaan surat');
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
            $permintaan = PermintaanSurat::findOrFail($id);
            if (Storage::exists("public/permintaan-surat/".$permintaan->file)) {
                Storage::delete("public/permintaan-surat/".$permintaan->file);
            }
            $permintaan->delete();

            return redirect('/dashboard/permintaan')->withStatus('Berhasil menghapus permintaan surat');
        } catch (\Exception $e) {
            return back()->withError('Terjadi kesalahan');
        } catch (\Illuminate\Database\QueryException $e) {
            return back()->withError('Terjadi kesalahan pada database');
        }
    }

    public function print($id)
    {
        try {
            $surat = PermintaanSurat::findOrFail($id);
            $profil_desa = ProfilDesa::first();
            $warga = User::find($surat->id_pengaju);

            $data = [
                'data' => $surat,
                'profil_desa' => $profil_desa,
                'warga' => $warga
            ];

            switch ($surat->id_jenis_surat) {
                case 1:
                    return view('print.ket_domisili', $data);
                    break;
                case 2:
                    return view('print.sktm', $data);
                    break;
                case 3:
                    return view('print.skck', $data);
                    break;
                case 4:
                    return view('print.perbedaan_identitas', $data);
                    break;
                case 5:
                    return view('print.ktp', $data);
                    break;
                case 6:
                    return view('print.kartu_keluarga', $data);
                    break;
                case 7:
                    return view('print.pindah_keluar', $data);
                    break;
                case 8:
                    return view('print.kelahiran', $data);
                    break;
                case 9:
                    return view('print.kematian', $data);
                    break;
                case 10:
                    return view('print.nikah', $data);
                    break;
                default:
                    return back()->withError('Jenis surat tidak diketahui.');
                    break;
            }
        } catch (\Exception $e) {
            return back()->withError('Terjadi kesalahan');
        } catch (\Illuminate\Database\QueryException $e) {
            return back()->withError('Terjadi kesalahan pada database');
        }
    }
}

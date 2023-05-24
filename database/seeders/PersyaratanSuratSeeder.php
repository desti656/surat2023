<?php

namespace Database\Seeders;

use App\Models\PersyaratanSurat;
use Illuminate\Database\Seeder;

class PersyaratanSuratSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $idJenisSurat = [
            1,
            2,
            3,
            4,
            5,
            6,
            7,
            8,
            9,
            10
        ];

        $domisili = [
            'Pengantar RT RW',
            'KTP',
            'KK'
        ];
        for ($i=0; $i < count($domisili); $i++) { 
            $persyaratan = new PersyaratanSurat();
            $persyaratan->id_jenis_surat = $idJenisSurat[0];
            $persyaratan->name = $domisili[$i];
            $persyaratan->save();
        }

        $sktm = [
            'Pengantar RT RW',
            'FC KK',
            'KK asli',
            'FC KTP'
        ];
        for ($i=0; $i < count($sktm); $i++) { 
            $persyaratan = new PersyaratanSurat();
            $persyaratan->id_jenis_surat = $idJenisSurat[1];
            $persyaratan->name = $sktm[$i];
            $persyaratan->save();
        }

        $skck = [
            'FC KTP',
            'FC KK',
            'SIM'
        ];
        for ($i=0; $i < count($skck); $i++) { 
            $persyaratan = new PersyaratanSurat();
            $persyaratan->id_jenis_surat = $idJenisSurat[2];
            $persyaratan->name = $skck[$i];
            $persyaratan->save();
        }

        $perbedaanIdentitas = [
            'FC KTP',
            'FC KK',
            'Pengantar RT RW',
        ];
        for ($i=0; $i < count($perbedaanIdentitas); $i++) { 
            $persyaratan = new PersyaratanSurat();
            $persyaratan->id_jenis_surat = $idJenisSurat[3];
            $persyaratan->name = $perbedaanIdentitas[$i];
            $persyaratan->save();
        }

        $ktp = [
            'FC KK',
            'FC Akta Kelahiran'
        ];
        for ($i=0; $i < count($ktp); $i++) { 
            $persyaratan = new PersyaratanSurat();
            $persyaratan->id_jenis_surat = $idJenisSurat[4];
            $persyaratan->name = $ktp[$i];
            $persyaratan->save();
        }

        $kk = [
            'KK asli sebelumnya',
            'KTP',
            'FC Buku nikah opsional'
        ];
        for ($i=0; $i < count($kk); $i++) { 
            $persyaratan = new PersyaratanSurat();
            $persyaratan->id_jenis_surat = $idJenisSurat[5];
            $persyaratan->name = $kk[$i];
            $persyaratan->save();
        }

        $pindahKeluar = [
            'KTP',
            'KK'
        ];
        for ($i=0; $i < count($pindahKeluar); $i++) { 
            $persyaratan = new PersyaratanSurat();
            $persyaratan->id_jenis_surat = $idJenisSurat[6];
            $persyaratan->name = $pindahKeluar[$i];
            $persyaratan->save();
        }

        $kelahiran = [
            'FC Surat nikah legalisir',
            'FC KTP Kedua Ortu',
            'FC KK',
            'Surat Keterangan lahir dari bidan/RS'
        ];
        for ($i=0; $i < count($kelahiran); $i++) { 
            $persyaratan = new PersyaratanSurat();
            $persyaratan->id_jenis_surat = $idJenisSurat[7];
            $persyaratan->name = $kelahiran[$i];
            $persyaratan->save();
        }

        $kematian = [
            'Pengantar RT RW',
            'Surat nikah asli',
            'KTP ahli waris',
            'KK yang meninggal',
            'Surat Ket meninggal dari RS tempat meninggal',
            'FC KTP yang meninggal'
        ];
        for ($i=0; $i < count($kematian); $i++) { 
            $persyaratan = new PersyaratanSurat();
            $persyaratan->id_jenis_surat = $idJenisSurat[8];
            $persyaratan->name = $kematian[$i];
            $persyaratan->save();
        }

        $nikah = [
            'FC KTP',
            'FC KK',
            'FC Akta lahir',
            'FC Ijazah',
            'FC Surat Nikah Orang Tua'
        ];
        for ($i=0; $i < count($nikah); $i++) { 
            $persyaratan = new PersyaratanSurat();
            $persyaratan->id_jenis_surat = $idJenisSurat[9];
            $persyaratan->name = $nikah[$i];
            $persyaratan->save();
        }
    }
}

<?php

namespace Database\Seeders;

use App\Models\JenisSurat;
use Illuminate\Database\Seeder;

class JenisSuratSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $jenisSurat = [
            'Keterangan Domisili',
            'SKTM',
            'SKCK',
            'Perbedaan Identitas',
            'KTP',
            'Kartu Keluarga',
            'Pindah Keluar',
            'Kelahiran',
            'Kematian',
            'Nikah'
        ];

        for ($i=0; $i < count($jenisSurat); $i++) { 
            $newJenis = new JenisSurat();
            $newJenis->name = $jenisSurat[$i];
            $newJenis->save();
        }
    }
}

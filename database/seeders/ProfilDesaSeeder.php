<?php

namespace Database\Seeders;

use App\Models\ProfilDesa;
use Illuminate\Database\Seeder;

class ProfilDesaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $newProfile = new ProfilDesa();
        $newProfile->name = 'Kebonsari';
        $newProfile->kecamatan = 'Sumbersuko';
        $newProfile->kabupaten = 'Lumajang';
        $newProfile->nama_kades = 'Nama Kades';
        $newProfile->save();
    }
}

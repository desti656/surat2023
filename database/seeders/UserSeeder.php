<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $newAdmin = new User();
        $newAdmin->name = 'Admin';
        $newAdmin->username = 'admin';
        $newAdmin->password = \Hash::make('password');
        $newAdmin->role_id = 1;
        $newAdmin->save();

        $newPetugas = new User();
        $newPetugas->name = 'Petugas';
        $newPetugas->username = 'petugas';
        $newPetugas->password = \Hash::make('password');
        $newPetugas->role_id = 2;
        $newPetugas->save();


        $newWarga = new User();
        $newWarga->name = 'Warga';
        $newWarga->username = '1234567890123452';
        $newWarga->password = \Hash::make('password');
        $newWarga->role_id = 3;
        $newWarga->address = 'Lumajang';
        $newWarga->tempat_lahir = 'Kebonsari';
        $newWarga->tgl_lahir = '2000-01-10';
        $newWarga->agama = 'Islam';
        $newWarga->pekerjaan = 'PELAJAR / MAHASISWA';
        $newWarga->status_perkawinan = 'BELUM KAWIN';
        $newWarga->no_kk = '1234567890123456';
        $newWarga->save();
    }
}

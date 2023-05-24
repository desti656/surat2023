<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $newRole = new Role();
        $newRole->name = 'Admin';
        $newRole->save();

        $newRole = new Role();
        $newRole->name = 'Petugas';
        $newRole->save();

        $newRole = new Role();
        $newRole->name = 'Warga';
        $newRole->save();
    }
}

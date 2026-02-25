<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin1 = Admin::create([
            'name' => 'Yousef Ammar',
            'email' => 'y0595652372@gmail.com',
            'password' => Hash::make('1234'),
        ]);
        $admin1->assignRole(Role::findById(1, 'admin'));

        $admin2 = Admin::create([
            'name' => 'Mohammed Ammar',
            'email' => 'm0595652372@gmail.com',
            'password' => Hash::make('12345'),
        ]);
        $admin2->assignRole(Role::findById(2, 'admin'));

        $admin3 = Admin::create([
            'name' => 'Marwan Ammar',
            'email' => 'me0595652372@gmail.com',
            'password' => Hash::make('123456'),
        ]);
        $admin3->assignRole(Role::findById(3, 'admin'));
    }
}

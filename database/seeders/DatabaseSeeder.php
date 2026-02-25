<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // DB::table('users')->insert([
        //     'name' => 'Yousef A.',
        //     'email' => 'yousefbassamaliammar@gmail.com',
        //     'password' => Hash::make('4321'),
        // ]);

        User::create([
            'name' => 'Yousef A.',
            'email' => 'yousefbassamaliammar@gmail.com',
            'password' => Hash::make('4321'),
        ]);
    }
}

<?php

namespace Database\Seeders;

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
        DB::table('admins')->insert([
            'username' => 'admin',
            'password' => Hash::make('123')
        ]);

        DB::table('admins')->insert([
            'username' => 'backup',
            'password' => Hash::make('123321')
        ]);

        DB::table('sambutan_direkturs')->insert([
            'name' => 'test',
            'image' => 'images/default/picture.svg',
            'description' => 'tesss'
        ]);

        // DB::table('galeris')->insert([
        //     'link' => ''
        // ]);
        // DB::table('galeris')->insert([
        //     'link' => ''
        // ]);
        // DB::table('galeris')->insert([
        //     'link' => ''
        // ]);
        //Pasien
        DB::table('patient_registration_data')->insert([

        ]);
    }
}

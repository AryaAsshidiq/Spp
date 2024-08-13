<?php
// database/seeders/UsersTableSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->insert([
            [
                'name' => 'Admin',
                'username' => 'admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('admin'),
                'role' => 'admin'
            ],
            [
                'name' => 'Kepala Sekolah',
                'username' => 'kepalasekolah',
                'email' => 'kepalasekolah@gmail.com',
                'password' => Hash::make('kepalasekolah'),
                'role' => 'kepala_sekolah'
            ],
        ]);
    }
}
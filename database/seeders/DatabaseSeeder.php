<?php

namespace Database\Seeders;

use Database\Seeders\UsersTableSeeder as SeedersUsersTableSeeder;
use Illuminate\Database\Seeder;
use UsersTableSeeder;

class DatabaseSeeder extends Seeder
{

    public function run(): void
    {
        $this->call(SeedersUsersTableSeeder::class);
    }
}
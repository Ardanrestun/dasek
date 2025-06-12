<?php

namespace Database\Seeders;

use App\Models\User;
use Database\Seeders\Access\UserSeeder;
use Database\Seeders\Data\DataSeeder;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            DataSeeder::class,
        ]);
    }
}

<?php

namespace Database\Seeders\Access;

use App\Models\Auth\Role;
use App\Models\Auth\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

         $roles = [
            ['name' => 'Super Admin'],
            ['name' => 'Guru'],
            ['name' => 'Siswa'],
        ];

        foreach ($roles as $role) {
            Role::create($role);
        }
        
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@school.com',
            'password' => Hash::make('password123'),
            'role_id' => Role::where('name', 'Super Admin')->first()->id,
        ]);

     
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'fullname' => 'Stevani Putri',
            'username' => 'admin',
            'email' => 'admin@gmail.com',
            'address' => 'Bogor',
            'role' => 'admin',
            'password' => bcrypt('1234'),
        ]);

        User::create([
            'fullname' => 'Aretta Dwi Hapsari',
            'username' => 'arettadw',
            'email' => 'aretta@gmail.com',
            'address' => 'Bogor',
            'role' => 'peminjam',
            'password' => bcrypt('1234'),
        ]);
    }
}

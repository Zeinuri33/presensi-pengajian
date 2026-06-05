<?php

namespace Database\Seeders;

use App\Models\User;
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
        //
        User::create([
            'name' => 'Admin',
            'username' => 'admin', // Gunakan username sebagai autentikasi
            'jabatan' => 'admin', // Gunakan username sebagai autentikasi
            'password' => Hash::make('123'), // Pastikan password dienkripsi
        ]);

        User::create([
            'name' => 'User' ,
            'username' => 'user' ,
            'jabatan' => 'pengguna' ,
            'password' => Hash::make('123')
        ]);
    }
}

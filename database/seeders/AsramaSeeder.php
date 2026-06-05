<?php

namespace Database\Seeders;

use App\Models\Asrama;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AsramaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Asrama::create([
            'asrama' => 'Asrama Idadiyah No.6',
            'kode' => 'ID.6',
            'daerah' => 'Idadiyah',
        ]);

        Asrama::create([
            'asrama' => 'Asrama Idadiyah No.12',
            'kode' => 'ID.12',
            'daerah' => 'Idadiyah',
        ]);
    }
}

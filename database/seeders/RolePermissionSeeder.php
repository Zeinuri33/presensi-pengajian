<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Buat permission
        Permission::create(['name' => 'kepala kamar-lihat']);
        Permission::create(['name' => 'kepala kamar-tambah']);
        Permission::create(['name' => 'kepala kamar-edit']);
        Permission::create(['name' => 'kepala kamar-hapus']);
        Permission::create(['name' => 'wakil kamar-lihat']);
        Permission::create(['name' => 'wakil kamar-tambah']);
        Permission::create(['name' => 'wakil kamar-edit']);
        Permission::create(['name' => 'wakil kamar-hapus']);

        Permission::create(['name' => 'pengguna-lihat']);
        Permission::create(['name' => 'pengguna-tambah']);
        Permission::create(['name' => 'pengguna-edit']);
        Permission::create(['name' => 'pengguna-hapus']);

        Permission::create(['name' => 'hak akses-lihat']);
        Permission::create(['name' => 'hak akses-tambah']);
        Permission::create(['name' => 'hak akses-edit']);

        Permission::create(['name' => 'asrama-lihat']);
        Permission::create(['name' => 'asrama-tambah']);
        Permission::create(['name' => 'asrama-edit']);
        Permission::create(['name' => 'asrama-hapus']);

        Permission::create(['name' => 'izin-lihat']);
        Permission::create(['name' => 'izin-tambah']);
        Permission::create(['name' => 'izin-edit']);
        Permission::create(['name' => 'izin-hapus']);

        Permission::create(['name' => 'libur-lihat']);
        Permission::create(['name' => 'libur-tambah']);
        Permission::create(['name' => 'libur-edit']);
        Permission::create(['name' => 'libur-hapus']);

        Permission::create(['name' => 'absen-lihat']);
        Permission::create(['name' => 'absen-tambah']);
        Permission::create(['name' => 'absen-hapus']);
        Permission::create(['name' => 'absen-rekap']);

        // Buat role
        $admin = Role::create(['name' => 'admin']);
        $kasubag = Role::create(['name' => 'kasubag']);

        // Assign permission ke role
        $admin->givePermissionTo([

            'pengguna-lihat',
            'pengguna-tambah',
            'pengguna-edit',
            'pengguna-hapus',

            'kepala kamar-lihat',
            'kepala kamar-tambah',
            'kepala kamar-edit',
            'kepala kamar-hapus',

            'wakil kamar-lihat',
            'wakil kamar-tambah',
            'wakil kamar-edit',
            'wakil kamar-hapus',

            'asrama-lihat',
            'asrama-tambah',
            'asrama-edit',
            'asrama-hapus',

            'izin-lihat',
            'izin-tambah',
            'izin-edit',
            'izin-hapus',

            'libur-lihat',
            'libur-tambah',
            'libur-edit',
            'libur-hapus',

            'absen-lihat',
            'absen-tambah',
            'absen-hapus',
            'absen-rekap',

            'hak akses-lihat',
            'hak akses-tambah',
            'hak akses-edit',
        ]);

        $kasubag->givePermissionTo([
            'kepala kamar-lihat',
            'kepala kamar-tambah',
            'kepala kamar-edit',
            'kepala kamar-hapus',

            'wakil kamar-lihat',
            'wakil kamar-tambah',
            'wakil kamar-edit',
            'wakil kamar-hapus',

            'asrama-lihat',
            'asrama-tambah',
            'asrama-edit',
            'asrama-hapus',
        ]);
    }
}

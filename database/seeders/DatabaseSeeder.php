<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Tenant;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Buat Super Admin
        User::create([
            'name' => 'Super Administrator',
            'username' => 'superadmin',
            'password' => Hash::make('password'),
            'role' => 'super_admin',
            'status' => 'aktif',
            'tenant_id' => null,
        ]);

        // 2. Buat Tenant Pertama (Sumber Urip)
        $tenant = Tenant::create([
            'tenant_code' => 'SU001',
            'name' => 'HIPPAM Sumber Urip',
            'organization_type' => 'HIPPAM',
            'village' => 'Desa Sukamaju',
            'district' => 'Kecamatan Makmur',
            'regency' => 'Kabupaten Sejahtera',
            'province' => 'Jawa Timur',
            'address' => 'Jl. Air Bersih No. 1, Balai Desa Sukamaju',
            'status' => 'aktif',
        ]);

        // 3. Buat Akun Admin Tenant untuk Sumber Urip
        User::create([
            'name' => 'Admin Sumber Urip',
            'username' => 'admin_su',
            'password' => Hash::make('password'),
            'role' => 'admin_tenant',
            'status' => 'aktif',
            'tenant_id' => $tenant->id,
        ]);

        // 4. Buat Akun Petugas untuk Sumber Urip (Akses PWA)
        User::create([
            'name' => 'Budi Petugas Catat',
            'username' => 'petugas_su',
            'password' => Hash::make('password'),
            'role' => 'petugas',
            'status' => 'aktif',
            'tenant_id' => $tenant->id,
        ]);
        
        // 5. Buat Akun Bendahara untuk Sumber Urip
        User::create([
            'name' => 'Siti Bendahara',
            'username' => 'bendahara_su',
            'password' => Hash::make('password'),
            'role' => 'bendahara',
            'status' => 'aktif',
            'tenant_id' => $tenant->id,
        ]);
    }
}

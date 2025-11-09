<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->createMany([
            [
                'name' => 'Admin Adit',
                'email' => 'admin@gmail.com',
                'role' => 'superadmin',
                'password' => Hash::make('adminadit'),
                'two_factor_secret' => null,
                'two_factor_recovery_codes' => null,
                'two_factor_confirmed_at' => null,
            ],
            [
                'name' => 'Keamanan Adit',
                'email' => 'keamanan@gmail.com',
                'role' => 'keamanan',
                'password' => Hash::make('adminadit'),
                'two_factor_secret' => null,
                'two_factor_recovery_codes' => null,
                'two_factor_confirmed_at' => null,
            ],
            [
                'name' => 'Mahasiswa Adit',
                'email' => 'mahasiswa@gmail.com',
                'role' => 'mahasiswa',
                'password' => Hash::make('adminadit'),
                'two_factor_secret' => null,
                'two_factor_recovery_codes' => null,
                'two_factor_confirmed_at' => null,
            ]
        ]);
    }
}

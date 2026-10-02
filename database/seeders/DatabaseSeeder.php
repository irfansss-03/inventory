<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $admin = User::updateOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin User',
                'password' => Hash::make('password'),
                'role' => 'admin',
            ]
        );

        // Dashboard memakai middleware 'verified', jadi akun admin harus terverifikasi.
        if ($admin->email_verified_at === null) {
            $admin->forceFill(['email_verified_at' => now()])->save();
        }

        $this->call([
            BarangSeeder::class,
            KaryawanSeeder::class,
        ]);
    }
}

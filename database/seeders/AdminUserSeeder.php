<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //creation du super utilisateur
        if (!User::where('email', 'admin@gestion_panne.cm')->exists())
        {
            $admin = User::create([
                'name' => 'admin',
                'email' => 'admin@example.com',
                'password' => Hash::make('password'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Associe le rôle "Admin" à ce super administrateur
            $admin->assignRole('ADMIN');
        }
    }
}

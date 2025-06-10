<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        // Création d'une seule admin fixe
        User::factory()->create([
            'nom' => 'Admin',
            'prenom' => 'Super',
            'email' => 'admin@example.com',
            'profil' => 'ADMIN',
            'password' => bcrypt('password'), // ou Hash::make
            'email_verified_at' => now(),
        ]);

        // Création de 10 autres utilisateurs avec profils sans ADMIN
        User::factory()->count(10)->create();

    }
}

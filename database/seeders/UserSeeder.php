<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'DOSSOU Pierre',
            'email' => 'pierredossou98@gmail.com',
            'password' => Hash::make('pierre'), // Mot de passe par défaut
            // 'is_admin' => true,
            'telephone' => '0123456789', // Téléphone de l'admin
            'poste' => 'Administrateur', // Poste de l'utilisateur
            'type' => 'admin', // Type d'utilisateur
        ]);
    }
}
// php artisan db:seed 

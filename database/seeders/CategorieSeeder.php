<?php

namespace Database\Seeders; // Namespace pour le seeder, il appartient au dossier "database/seeders"

use Illuminate\Database\Seeder; // Importation de la classe Seeder fournie par Laravel
use App\Models\Categorie; // Importation du modèle Categorie pour interagir avec la base de données

class CategorieSeeder extends Seeder // Définition de la classe CategorieSeeder qui hérite de Seeder
{
    public function run() // La méthode run() sera exécutée lors du seed
    {
        // Liste des catégories par défaut à insérer dans la base de données
        $defaultCategories = [
            'Salaires', 'Matériel', 'Frais généraux', 'Marketing', 'Développement', 'Autres',
            'Loyer et Services Publics', 'Frais de déplacement', 'Fournitures de bureau', 'Assurances',
            'Logiciels et abonnements', 'Impôts et taxes', 'Consultants et prestataires externes'
        ];

        // Boucle sur chaque catégorie pour l'insérer dans la base de données
        foreach ($defaultCategories as $categoryName) {
            // Vérifie si une catégorie avec ce nom existe déjà, sinon elle la crée
            Categorie::firstOrCreate(['nom' => $categoryName]);
        }
    }
}
// php artisan db:seed --class=CategorieSeeder:Pour envoyer dans base de donnée
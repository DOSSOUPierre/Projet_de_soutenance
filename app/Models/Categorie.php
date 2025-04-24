<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
    use HasFactory;

    protected $fillable = ['nom'];

    public function depenses()
    {
        return $this->hasMany(Depense::class);
    }

    public function recettes()
    {
        return $this->hasMany(Recette::class);
    }

    // Créer les catégories par défaut
    public static function createDefaultCategories()
    {
        $defaultCategories = [
            'Salaires', 'Matériel', 'Frais généraux', 'Marketing', 'Développement', 'Autres',
            'Loyer et Services Publics', 'Frais de déplacement', 'Fournitures de bureau', 'Assurances',
            'Logiciels et abonnements', 'Impôts et taxes', 'Consultants et prestataires externes'
        ];

        foreach ($defaultCategories as $categoryName) {
            self::firstOrCreate(['nom' => $categoryName]);
        }
    }
}

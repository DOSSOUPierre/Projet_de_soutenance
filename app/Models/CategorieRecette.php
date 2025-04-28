<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategorieRecette extends Model
{
    use HasFactory;

    // Nom de la table (si elle ne suit pas la convention Laravel)
    protected $table = 'categorie_recettes';

    // Champs remplissables en masse
    protected $fillable = ['nom', 'description'];

    // Définition de la relation : une catégorie a plusieurs recettes
    public function recettes()
    {
        return $this->hasMany(Recette::class, 'categorie_id');
    }
}

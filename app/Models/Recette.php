<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Recette extends Model
{
    use HasFactory, SoftDeletes;

    // Table associée, au cas où le nom ne correspondrait pas automatiquement
    protected $table = 'recettes';  // Assurez-vous que le nom de la table est correct

    // Attributs pouvant être remplis en masse
    protected $fillable = [
        'description',
        'objet',
        'montant',
        'telephone',
        'categorie_id',
        'archiver',
    ];

    // Valeurs par défaut pour les colonnes
    protected $attributes = [
        'archiver' => 0,
    ];

    /**
     * Relation avec la catégorie de recette.
     * Cette méthode permet d'accéder à la catégorie associée à la recette.
     */
    public function categorie()
    {
        return $this->belongsTo(CategorieRecette::class, 'categorie_id');
    }
}

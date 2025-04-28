<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Depense extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'description',
        'objet',
        'montant',
        'telephone',
        'categorie_id',
        'archiver'
    ];

    protected $attributes = [
        'archiver' => 0, // Valeur par défaut
    ];

    /**
     * Relation avec la catégorie de dépense.
     * Cette méthode permet d'accéder à la catégorie associée à la dépense.
     */
    // public function categorie()
    // {
    //     return $this->belongsTo(CategorieDepense::class, 'categorie_id');

    // }
    // app/Models/Depense.php

public function categorieDepense()
{
    return $this->belongsTo(CategorieDepense::class, 'categorie_id');
}

}

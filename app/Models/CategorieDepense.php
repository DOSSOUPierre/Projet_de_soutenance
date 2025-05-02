<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategorieDepense extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom' // Nom de la catégorie de dépense
    ];

    /**
     * Relation avec les dépenses.
     * Cette méthode permet d'accéder aux dépenses associées à cette catégorie.
     */
    public function depenses()
    {
        return $this->hasMany(Depense::class, 'categorie_id');
    }
    
    
}

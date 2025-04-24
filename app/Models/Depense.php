<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

    class Depense extends Model

    {
        use HasFactory, SoftDeletes;
    
        protected $fillable = ['description', 'objet', 'montant', 'telephone', 'categorie_id', 'archiver'];
        protected $attributes = [
            'archiver' => 0,  // Assurez-vous que c'est un entier 0, pas une chaîne
        ];
    
        public function categorie()
        {
            return $this->belongsTo(Categorie::class, 'categorie_id');
        }
    }
    

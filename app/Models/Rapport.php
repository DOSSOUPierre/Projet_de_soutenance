<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache; // Assurez-vous que cette ligne est présente

class Rapport extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'content', 'created_at', 'updated_at'];

    public static function boot()
    {
        parent::boot();

        static::created(function ($rapport) {
            // Initialiser le compteur si la clé n'existe pas encore
            if (\Cache::get('total_rapports') === null) {
                \Cache::put('total_rapports', 0); // Définit la valeur à 0 si elle n'existe pas
            }

            // Incrémenter le total des rapports à chaque fois qu'un rapport est créé
            \Cache::increment('total_rapports');
        });
    }
}

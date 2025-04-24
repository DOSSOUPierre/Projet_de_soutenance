<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;  // Assurez-vous que le trait Notifiable est bien utilisé
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable; // Utilisez le trait Notifiable pour les notifications

    protected $fillable = [
        'name',
        'telephone',
        'email',
        'poste',
        'password',
        'type',
    ];

    protected $attributes = [
        'type' => 'user',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    // Définition de la méthode pour envoyer des notifications via WhatsApp (si vous utilisez Twilio)
    public function routeNotificationForTwilioWhatsapp()
    {
        return $this->telephone;
    }
}

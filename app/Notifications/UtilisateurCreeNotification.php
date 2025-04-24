<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class UtilisateurCreeNotification extends Notification
{
    use Queueable;

    protected $name;

    // Constructeur pour initialiser le nom de l'utilisateur
    public function __construct($name)
    {
        $this->name = $name;
    }

    // Définir les canaux de notification (ici l'email)
    public function via($notifiable)
    {
        return ['mail'];
    }

    // Configurer l'email envoyé à l'utilisateur
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject('Bienvenue dans notre système')
                    ->greeting('Bonjour ' . $this->name . ',')
                    ->line('Votre compte a été créé avec succès.')
                    ->line('Nous vous souhaitons la bienvenue et vous invitons à vous connecter pour commencer à utiliser notre plateforme.')
                    ->action('Se connecter', url('/login'))
                    ->line('Merci de votre confiance !');
    }
}

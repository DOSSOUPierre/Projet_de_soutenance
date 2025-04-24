<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class DepenseEnregistreeNotification extends Notification
{
    use Queueable;

    protected $depense;

    // Constructeur pour initialiser la dépense
    public function __construct($depense)
    {
        $this->depense = $depense;
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
                    ->subject('Nouvelle dépense enregistrée')
                    ->greeting('Bonjour,')
                    ->line('Une nouvelle dépense a été enregistrée avec succès.')
                    ->line('Voici les détails de la dépense :')
                    ->line('Objet : ' . $this->depense->objet)
                    ->line('Montant : ' . $this->depense->montant)
                    ->action('Voir la dépense', url('/depenses/' . $this->depense->id))
                    ->line('Merci de votre confiance!');
    }
}

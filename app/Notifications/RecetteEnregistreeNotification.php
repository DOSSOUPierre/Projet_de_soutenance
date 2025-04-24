<?php

namespace App\Notifications;

use App\Models\Recette;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class RecetteEnregistreeNotification extends Notification
{
    use Queueable;

    protected $recette;

    // Injection de la recette dans la notification
    public function __construct(Recette $recette)
    {
        $this->recette = $recette;
    }

    // Déclare que la notification sera envoyée par email
    public function via($notifiable)
    {
        return ['mail'];
    }

    // Structure de l’e-mail
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Nouvelle recette enregistrée')
            ->greeting('Bonjour,')
            ->line('Une nouvelle recette a été enregistrée dans le système.')
            ->line('Description : ' . $this->recette->description)
            ->line('Montant : ' . number_format($this->recette->montant, 2) . ' FCFA')
            ->action('Voir la recette', route('recettes.show', $this->recette->id))
            ->line('Merci pour votre attention.')
            ->salutation('Cordialement, L’équipe de gestion des recettes');
    }
}

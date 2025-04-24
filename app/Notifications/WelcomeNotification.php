<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class WelcomeNotification extends Notification
{
    public $user;
    public $password;

    public function __construct($user, $password)
    {
        $this->user = $user;
        $this->password = $password;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Bienvenue sur la plateforme')
            ->greeting('Bonjour ' . $this->user->name . ',')
            ->line('Bienvenue sur notre plateforme !')
            ->line('Voici vos identifiants de connexion :')
            ->line('Email : ' . $this->user->email)
            ->line('Mot de passe temporaire : ' . $this->password)
            ->action('Se connecter', url('/login'))
            ->line('Merci de faire partie de notre communauté !');
    }

    public function toArray($notifiable)
    {
        return [
            'message' => 'Bienvenue ' . $this->user->name . ' sur la plateforme.',
        ];
    }
}

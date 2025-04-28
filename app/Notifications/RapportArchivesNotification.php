<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Storage;

class RapportArchivesNotification extends Notification
{
    use Queueable;

    protected $pdfPath;

    public function __construct($pdfPath)
    {
        $this->pdfPath = $pdfPath; // chemin du fichier PDF
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject('Rapport des Archives')
                    ->greeting('Bonjour Admin,')
                    ->line('Veuillez trouver ci-joint le rapport PDF des recettes et dépenses archivées.')
                    ->attach($this->pdfPath, [
                        'as' => 'rapport_archives.pdf',
                        'mime' => 'application/pdf',
                    ])
                    ->line('Merci pour votre gestion.');
    }
}

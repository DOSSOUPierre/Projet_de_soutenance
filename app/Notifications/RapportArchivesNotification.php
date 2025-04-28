<?php
namespace App\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Storage;

class RapportArchivesNotification extends Notification
{
    private $filePath;

    public function __construct($filePath)
    {
        $this->filePath = $filePath;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Votre Rapport Financier')
            ->line('Veuillez trouver ci-joint le rapport financier des archives.')
            ->attach(Storage::path($this->filePath), [
                'as' => 'rapport_financier_archives.pdf', 
                'mime' => 'application/pdf'
            ]);
    }
}

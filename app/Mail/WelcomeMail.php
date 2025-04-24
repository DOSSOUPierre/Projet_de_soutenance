<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class WelcomeMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $password;

    public function __construct($user, $password = null)
    {
        $this->user = $user;
        $this->password = $password;
    }

    public function build()
    {
        return $this->subject("Bienvenue sur la Plateforme de gestion financière et budgétaire d'entreprise")
                    ->view('emails.welcome')
                    ->with([
                        'user' => $this->user,
                        'password' => $this->password,
                    ]);
    }
}

<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\Password;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mail\ResetPasswordEmail;
use Illuminate\Support\Facades\Mail;


class ForgotPasswordController extends Controller
{
    public function sendResetLinkEmail(Request $request)
    {
        // Validation de l'email
        $request->validate(['email' => 'required|email']);

        // Tentative d'envoi du lien de réinitialisation au email
        $status = Password::sendResetLink(
            $request->only('email')
        );

        // Si l'envoi du lien a réussi, vous pouvez envoyer un e-mail personnalisé
        if ($status == Password::RESET_LINK_SENT) {
            // Générez l'URL de réinitialisation de mot de passe
            $url = url('password/reset'); // Remplacez cela par la méthode appropriée si nécessaire

            // Envoi de l'e-mail personnalisé
            Mail::to($request->email)->send(new ResetPasswordEmail($url));

            return back()->with('status', 'Nous avons envoyé votre lien de réinitialisation par email !');
        } else {
            return back()->withErrors(['email' => 'Nous n\'avons pas trouvé d\'utilisateur avec cet email.']);
        }
    }
}
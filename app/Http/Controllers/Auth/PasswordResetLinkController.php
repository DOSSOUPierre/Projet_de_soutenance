<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class PasswordResetLinkController extends Controller
{
    /**
     * Affiche le formulaire de demande de réinitialisation du mot de passe.
     */
    public function create(): View
    {
        return view('auth.forgot-password');
    }

    /**
     * Envoie le lien de réinitialisation du mot de passe.
     */
    public function store(Request $request): RedirectResponse
    {
        // Validation de l'email
        $request->validate([
            'email' => ['required', 'email'],
        ]);

        // Envoi du lien de réinitialisation
        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status == Password::RESET_LINK_SENT
                    ? back()->with('status', __($status))
                    : back()->withInput($request->only('email'))
                            ->withErrors(['email' => __($status)]);
    }
}

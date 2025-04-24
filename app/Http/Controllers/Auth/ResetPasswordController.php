<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;

class ResetPasswordController extends Controller
{
    /**
     * Affiche le formulaire de réinitialisation du mot de passe.
     */
    public function showResetForm(Request $request, $token = null)
    {
        return view('auth.passwords.reset')->with([
            'token' => $token,
            'email' => $request->email,
        ]);
    }

    /**
     * Réinitialise le mot de passe de l'utilisateur.
     */
    public function reset(Request $request)
    {
        // Validation des données
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|confirmed|min:8',
            'token' => 'required',
        ]);

        // Réinitialisation du mot de passe
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->password = Hash::make($password);
                $user->save();
            }
        );

        // Retourne une réponse en fonction du succès
        return $status == Password::PASSWORD_RESET
            ? redirect()->route('login')->with('status', __('Mot de passe réinitialisé avec succès.'))
            : back()->withInput($request->only('email'))
                      ->withErrors(['email' => trans($status)]);
    }
}

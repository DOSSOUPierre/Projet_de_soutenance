<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rules\Password;

class PasswordController extends Controller
{
    /**
     * Update the user's password.
     */
    public function update(Request $request): RedirectResponse
    {
        // Ajouter des logs pour vérifier les données reçues
        Log::info('Email de l\'utilisateur : ' . $request->user()->email);
        Log::info('Mot de passe actuel : ' . $request->current_password);
        Log::info('Nouveau mot de passe : ' . $request->password);

        // Validation des données
        $validated = $request->validateWithBag('updatePassword', [
            'current_password' => ['required', 'current_password'],
            'password' => ['required', Password::defaults(), 'confirmed'],
        ]);

        // Mise à jour du mot de passe de l'utilisateur
        $request->user()->update([
            'password' => Hash::make($validated['password']),
        ]);

        // Log de la réussite de la mise à jour
        Log::info('Mot de passe mis à jour avec succès pour : ' . $request->user()->email);

        return back()->with('status', 'password-updated');
    }
}

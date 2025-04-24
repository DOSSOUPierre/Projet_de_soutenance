<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Affiche la vue de connexion.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Gère la tentative de connexion.
     */
    public function store(Request $request): RedirectResponse
    {
        // Validation des champs requis
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'remember' => 'required|accepted',
        ]);

        // Vérifie si l'email existe
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors([
                'email' => 'E-mail incorrect.',
            ])->withInput();
        }

        // Vérifie si le mot de passe est correct
        if (!Auth::attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
            return back()->withErrors([
                'password' => 'Mot de passe incorrect.',
            ])->withInput();
        }

        // Connexion réussie
        $request->session()->regenerate();
        return redirect()->intended(RouteServiceProvider::HOME);
    }

    /**
     * Déconnecte l'utilisateur.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}

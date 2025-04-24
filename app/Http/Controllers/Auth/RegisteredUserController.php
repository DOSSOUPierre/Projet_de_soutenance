<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Events\Registered;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Validation\Rules;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Mail\WelcomeMail;
use App\Notifications\WelcomeNotification;

class RegisteredUserController extends BaseController
{
    // Affiche le formulaire d'inscription
    public function create()
    {
        return view('auth.register');
    }

    // Traite l'inscription d'un nouvel utilisateur
    public function store(Request $request): RedirectResponse
    {
        // Validation des données envoyées par le formulaire
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'telephone' => ['required', 'string', 'max:20'],
            'poste' => ['required', 'string', 'max:100'],
            'type' => ['required', 'in:admin,user'],
        ]);

        // Génération d'un mot de passe temporaire pour le nouvel utilisateur
        $passwordTemp = Str::random(10);

        // Création de l'utilisateur avec les données validées et le mot de passe généré
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'telephone' => $validated['telephone'],
            'poste' => $validated['poste'],
            'password' => Hash::make($passwordTemp), // Le mot de passe est crypté avant d'être stocké
            'type' => $validated['type'],
        ]);

        // Envoi d'un e-mail de bienvenue avec le mot de passe temporaire à l'utilisateur
        Mail::to($user->email)->send(new WelcomeMail($user, $passwordTemp));

        // Envoi d'une notification à l'utilisateur pour l'informer de son inscription
        $user->notify(new WelcomeNotification($user, $passwordTemp));

        // (Optionnel) Envoi d'un e-mail à l'administrateur pour l'informer de la création de l'utilisateur
        $adminEmail = 'pierredossou98@gmail.com';
        Mail::to($adminEmail)->send(new WelcomeMail($user, $passwordTemp));

        // Lancement de l'événement "Registered" pour signaler l'enregistrement de l'utilisateur
        event(new Registered($user));

        // Redirection vers la liste des utilisateurs avec un message de succès
        return redirect()->route('utilisateurs.liste')->with('success', 'Nouvel utilisateur créé avec succès.');
    }
}

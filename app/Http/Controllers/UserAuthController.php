<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class UserAuthController extends Controller
{
    // Affiche le tableau de bord ou redirige vers la page de connexion si non connecté
    public function index()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        $users = User::all();
        return view('dashboard', compact('users'));
    }

    // Affiche le formulaire d'inscription, redirige si l'utilisateur est déjà connecté
    public function register()
    {
        if (Auth::check()) {
            return redirect()->route('accueil');
        }
        return view('gestion.register');
    }

    // Sauvegarde des données d'inscription et crée un nouvel utilisateur
    public function registerSave(Request $request)
    {
        // Validation des données envoyées par le formulaire
        $validated = $request->validate([
            'name' => ['required', 'string', 'between:5,255'],
            'email' => ['required', 'email', 'unique:users', 'max:255'],
            'telephone' => ['required', 'string', 'max:15'],
            'poste' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'terms' => ['accepted'],
            'type' => ['required', 'string', 'in:user,admin'],
        ]);
        // Log des données validées avant la création
        Log::info('Données validées avant création utilisateur : ', ['type' => $validated['type']]);

        try {
            // Création de l'utilisateur dans la base de données
            User::create([
                'name' => $validated['name'],
                'telephone' => $validated['telephone'],
                'email' => $validated['email'],
                'poste' => $validated['poste'],
                'password' => Hash::make($validated['password']),
                'type' => $validated['type'],  // 'admin' ou 'user'
            ]);

            return redirect()->route('login')->with('success', 'Inscription réussie ! Veuillez vous connecter.');
        } catch (\Exception $e) {
            // Log de l'erreur en cas d'échec
            Log::error('Erreur lors de la création de l\'utilisateur', ['error' => $e->getMessage()]);
            return back()->withErrors(['message' => 'Une erreur est survenue lors de l\'inscription.']);
        }
    }

    // Créer un nouvel utilisateur (admin) - Redirige vers la vue de création
    public function createUser()
    {
        return view('auth.register'); // Vue de création d'utilisateur (administrateur)
    }

    // Affiche la page de connexion, redirige si déjà connecté
    public function login()
    {
        if (Auth::check()) {
            return redirect()->route('accueil');
        }
        return view('gestion.login');
    }

    // Enregistrement de la connexion de l'utilisateur
    public function loginSave(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'remember' => 'required|boolean',  // Validation de la case à cocher "Souviens-toi de moi"
        ]);

        if (Auth::attempt($request->only('email', 'password'))) {
            $request->session()->regenerate();
            return redirect()->route('accueil');
        }

        return back()->withErrors(['email' => 'Les informations de connexion sont incorrectes.']);
    }

    // Déconnexion de l'utilisateur
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }

    // Liste de tous les utilisateurs (admin)
    public function liste()
    {
        $users = User::all();  // Récupère tous les utilisateurs
        return view('gestion.liste', compact('users'));
    }

    // Affiche les détails d'un utilisateur spécifique
    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('gestion.show', compact('user'));
    }

    // Détails d'un utilisateur avec une vue spécifique
    public function details($id)
    {
        $utilisateur = User::findOrFail($id);
        return view('gestion.details', compact('utilisateur'));
    }

    // Édition des informations d'un utilisateur
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('gestion.modifier', compact('user'));
    }

    // Mise à jour des informations de l'utilisateur
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validated = $request->validate([
            'name' => ['required', 'string', 'between:5,255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email,' . $id], // Unique sauf pour lui-même
            'telephone' => ['required', 'string', 'max:15'],
            'poste' => ['required', 'string', 'max:255'],
            'type' => ['required', 'string', 'in:user,admin'],
        ]);

        $user->update($validated);  // Mise à jour des données de l'utilisateur

        return redirect()->route('utilisateurs.liste')->with('success', 'Utilisateur mis à jour avec succès.');
    }

    // Suppression d'un utilisateur
    public function delete($id)
    {
        $utilisateur = User::findOrFail($id);
        $utilisateur->delete();  // Suppression de l'utilisateur
        return back()->with('success', 'Utilisateur supprimé avec succès.');
    }
    
}

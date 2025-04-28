@extends('layouts.master')

@section('contenu')

<!-- Fonts -->
<link rel="preconnect" href="https://fonts.bunny.net">
<link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

<!-- Styles personnalisés -->
<style>
    body {
        font-family: 'Figtree', sans-serif;
        background-color: #f3f4f6;
        display: flex;
        align-items: center;
        justify-content: center;
        min-height: 100vh;
        margin: 0;
    }
    .container {
        width: 100%;
        max-width: 28rem;
        padding: 2.5rem;
        background: linear-gradient(145deg, #ffffff, #f3f4f6);
        border-radius: 1rem;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        box-sizing: border-box;
    }
    .logo {
        display: flex;
        justify-content: center;
        margin-bottom: 2rem;
    }
    .logo img {
        width: 6rem;
    }
    h2 {
        text-align: center;
        font-size: 1.75rem;
        font-weight: 700;
        color: #1f2937;
        margin-bottom: 2rem;
    }
    form > div {
        margin-bottom: 1.5rem;
    }
    label {
        display: block;
        font-size: 0.9rem;
        font-weight: 600;
        color: #4b5563;
        margin-bottom: 0.5rem;
    }
    input, select {
        width: 100%;
        padding: 0.75rem 1rem;
        border-radius: 0.75rem;
        border: 1px solid #d1d5db;
        background-color: #f9fafb;
        color: #374151;
        outline: none;
        box-sizing: border-box;
        font-size: 1rem;
        transition: all 0.3s ease;
    }
    input:focus, select:focus {
        border-color: #6366f1;
        box-shadow: 0 0 5px rgba(99, 102, 241, 0.5);
    }
    .error {
        color: #ef4444;
        font-size: 0.75rem;
        margin-top: 0.25rem;
    }
    .btn-primary, .btn-secondary {
        display: block;
        width: 100%;
        padding: 0.75rem 1rem;
        font-weight: 700;
        border-radius: 0.75rem;
        text-align: center;
        cursor: pointer;
        text-decoration: none;
        margin-top: 1rem;
        transition: background-color 0.3s;
        box-sizing: border-box;
    }
    .btn-primary {
        background-color: #4f46e5;
        color: white;
    }
    .btn-primary:hover {
        background-color: #4338ca;
    }
    .btn-secondary {
        background-color: #6b7280;
        color: white;
    }
    .btn-secondary:hover {
        background-color: #4b5563;
    }
    .link {
        display: block;
        text-align: center;
        font-size: 0.875rem;
        color: #6366f1;
        text-decoration: none;
        margin-top: 1rem;
    }
    .link:hover {
        text-decoration: underline;
    }
</style>

<div class="container">
    <!-- Logo -->
    <div class="logo">
        <img src="{{ asset('images/logo/logo.png') }}" alt="Logo">
    </div>

    <!-- Titre -->
    <h2>Créer un compte</h2>

    <!-- Formulaire d'inscription -->
    <form method="POST" action="{{ route('utilisateur.store') }}">
        @csrf

        <!-- Nom -->
        <div>
            <label for="name">Nom</label>
            <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus>
            @error('name')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>

        <!-- Email -->
        <div>
            <label for="email">Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required>
            @error('email')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>

        <!-- Téléphone -->
        <div>
            <label for="telephone">Téléphone</label>
            <input id="telephone" type="text" name="telephone" value="{{ old('telephone') }}" required>
            @error('telephone')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>

        <!-- Poste -->
        <div>
            <label for="poste">Poste</label>
            <input id="poste" type="text" name="poste" value="{{ old('poste') }}" required>
            @error('poste')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>

        <!-- Type -->
        <div>
            <label for="type">Type</label>
            <select id="type" name="type" required>
                <option value="admin" {{ old('type') == 'admin' ? 'selected' : '' }}>Administrateur</option>
                <option value="user" {{ old('type') == 'user' ? 'selected' : '' }}>Utilisateur</option>
            </select>
            @error('type')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>

        <!-- Mot de passe -->
        <div>
            <label for="password">Mot de passe</label>
            <input id="password" type="password" name="password" required>
            @error('password')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>

        <!-- Confirmation mot de passe -->
        <div>
            <label for="password_confirmation">Confirmer le mot de passe</label>
            <input id="password_confirmation" type="password" name="password_confirmation" required>
            @error('password_confirmation')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>

        <!-- Lien Connexion -->
        <a href="{{ route('login') }}" class="link">Déjà inscrit ? Se connecter</a>

        <!-- Bouton inscription -->
        <button type="submit" class="btn-primary">S'inscrire</button>

        <!-- Bouton Accueil -->
        <a href="{{ route('dashboard') }}" class="btn-secondary">Retour à l'Accueil</a>
    </form>
</div>

@endsection

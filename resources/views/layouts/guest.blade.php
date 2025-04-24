<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Bootstrap 5 CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-white">

        <div class="min-vh-100 d-flex flex-column justify-content-center align-items-center">
            <!-- Logo Section -->
            <div class="mb-5">
                <a href="/">
                    <img src="{{ asset('logo.png') }}" alt="Logo" class="w-25"> <!-- Ajustez le chemin de votre logo -->
                </a>
            </div>

            <!-- Form Section -->
            <div class="card shadow-lg rounded-4" style="width: 100%; max-width: 400px;">
                <div class="card-header text-center bg-primary text-white">
                    <h4>Bienvenue sur {{ config('app.name', 'Laravel') }}</h4>
                </div>
                <div class="card-body">
                    <h5 class="card-title text-center mb-4">Connectez-vous ou inscrivez-vous</h5>

                    <!-- Custom Content or Form Here -->
                    <div class="d-flex justify-content-center mb-4">
                        <p class="text-muted">Veuillez utiliser le formulaire ci-dessous pour accéder à votre compte.</p>
                    </div>

                    <!-- Example Button -->
                    <div class="d-flex justify-content-center">
                        <a href="{{ route('login') }}" class="btn btn-primary w-100">Se connecter</a>
                    </div>
                </div>
                <div class="card-footer text-center">
                    <small class="text-muted">Pas encore inscrit ? <a href="{{ route('register') }}">Créer un compte</a></small>
                </div>
            </div>
        </div>

        <!-- Bootstrap 5 JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>

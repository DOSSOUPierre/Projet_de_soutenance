<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Polices -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

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
            padding: 2rem;
            background-color: #fff;
            border-radius: 0.5rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .logo {
            display: flex;
            justify-content: center;
            margin-bottom: 1rem;
        }

        .logo img {
            width: 6rem;
        }

        h2 {
            text-align: center;
            font-size: 1.5rem;
            font-weight: 600;
            color: #374151;
            margin-bottom: 1rem;
        }

        label {
            font-size: 0.875rem;
            font-weight: 500;
            color: #4b5563;
        }

        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 0.5rem 1rem;
            margin-top: 0.25rem;
            margin-bottom: 0.5rem;
            border-radius: 0.5rem;
            border: 1px solid #d1d5db;
            background-color: #e5e7eb;
            color: #374151;
            outline: none;
        }

        input:focus {
            border-color: #6366f1;
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.3);
        }

        .error-message {
            color: red;
            font-size: 0.875rem;
            margin-top: 0.5rem;
        }

        .checkbox-container {
            display: flex;
            align-items: center;
            margin-top: 1rem;
        }

        .checkbox-container input {
            width: 1rem;
            height: 1rem;
            margin-right: 0.5rem;
            accent-color: #6366f1;
        }

        .checkbox-container label {
            font-size: 0.875rem;
            color: #4b5563;
        }

        .actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 1rem;
        }

        .actions a {
            font-size: 0.875rem;
            color: #6366f1;
            text-decoration: none;
        }

        .actions a:hover {
            text-decoration: underline;
        }

        .btn {
            padding: 0.5rem 1rem;
            font-weight: 700;
            background-color: #4f46e5;
            color: white;
            border: none;
            border-radius: 0.5rem;
            cursor: pointer;
        }

        .btn:hover {
            background-color: #4338ca;
        }

        .btn:focus {
            outline: none;
            box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.3);
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="logo">
            <img src="{{ asset('images/logo/logo.png') }}" alt="Logo">
        </div>
        
        <h2>Connexion</h2>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email -->
            <div>
                <label for="email">E-mail</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus>
                @error('email')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <!-- Mot de passe -->
            <div>
                <label for="password">Mot de passe</label>
                <input id="password" type="password" name="password" required>
                @error('password')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <!-- Se souvenir -->
            <div class="checkbox-container">
                <input id="remember_me" type="checkbox" name="remember" value="1" {{ old('remember') ? 'checked' : '' }} required>
                <label for="remember_me">Souviens-toi de moi</label>
                @error('remember')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <!-- Mot de passe oublié + bouton -->
            <div class="actions">
                <a href="{{ route('password.request') }}">Mot de passe oublié ?</a>
                <button type="submit" class="btn">Se connecter</button>
            </div>
        </form>
    </div>
</body>
</html>

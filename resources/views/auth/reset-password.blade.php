<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
</head>
<body class="flex items-center justify-center min-h-screen bg-gray-100">
    <div class="w-full max-w-md p-8 space-y-6 bg-white rounded-lg shadow-lg">
        <h2 class="text-2xl font-semibold text-center text-gray-700">Définir un nouveau mot de passe</h2>

        <!-- Affichage des erreurs -->
        @if ($errors->any())
            <div class="bg-red-500 text-white p-3 rounded-lg mb-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Affichage du message de succès -->
        @if (session('status'))
            <div class="bg-green-500 text-white p-3 rounded-lg mb-4">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('password.update') }}">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">
            <input type="hidden" name="email" value="{{ $email }}">

            <!-- Nouveau mot de passe -->
            <div>
                <label for="password" class="block text-sm font-medium text-gray-600">Nouveau mot de passe</label>
                <input id="password" type="password" name="password" required 
                    class="w-full px-4 py-2 mt-1 text-gray-800 bg-gray-300 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
            </div>

            <!-- Confirmation du mot de passe -->
            <div>
                <label for="password_confirmation" class="block text-sm font-medium text-gray-600">Confirmez le mot de passe</label>
                <input id="password_confirmation" type="password" name="password_confirmation" required 
                    class="w-full px-4 py-2 mt-1 text-gray-800 bg-gray-300 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
            </div>

            <div>
                <button type="submit" class="w-full px-4 py-2 font-bold text-white bg-indigo-600 rounded-lg hover:bg-indigo-700 focus:ring-4 focus:ring-indigo-300">
                    Réinitialiser le mot de passe
                </button>
            </div>
        </form>
    </div>
</body>
</html>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Réinitialisation du mot de passe</title>
    <style>
        body {
            background-color: #f7fafc; /* bg-gray-100 */
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }
        .container {
            background-color: white; /* bg-white */
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* shadow-md */
            border-radius: 0.75rem; /* rounded-xl */
            padding: 2rem; /* p-8 */
            width: 100%;
            max-width: 400px; /* max-w-md */
        }
        h2 {
            font-size: 1.25rem; /* text-xl */
            font-weight: 500; /* font-medium */
            text-align: center;
            color: #2d3748; /* text-gray-800 */
            margin-bottom: 0.5rem; /* mb-2 */
        }
        p {
            font-size: 0.875rem; /* text-sm */
            text-align: center;
            color: #718096; /* text-gray-500 */
            margin-bottom: 1.5rem; /* mb-6 */
        }
        input {
            width: 100%;
            padding: 0.75rem; /* px-4 py-3 */
            background-color: white; /* bg-white */
            border: 1px solid #cbd5e0; /* border-gray-300 */
            color: #2d3748; /* text-gray-800 */
            border-radius: 0.375rem; /* rounded-md */
            outline: none;
            transition: border-color 0.2s;
        }
        input:focus {
            border-color: #3182ce; /* focus:ring-blue-500 */
            box-shadow: 0 0 0 2px rgba(66, 153, 225, 0.5); /* focus:ring-2 */
        }
        button {
            width: 100%;
            background-color: #4299e1; /* bg-blue-500 */
            color: white; /* text-white */
            font-weight: 600; /* font-semibold */
            padding: 0.75rem; /* py-3 */
            border-radius: 0.375rem; /* rounded-md */
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.1); /* shadow-sm */
            transition: background-color 0.2s;
        }
        button:hover {
            background-color: #3182ce; /* hover:bg-blue-600 */
        }
        .status {
            margin-top: 1rem; /* mt-4 */
            font-size: 0.875rem; /* text-sm */
            color: #48bb78; /* text-green-600 */
            text-align: center;
        }
        .error {
            margin-top: 0.5rem; /* mt-2 */
            font-size: 0.875rem; /* text-sm */
            color: #f56565; /* text-red-600 */
            text-align: center;
        }
        .link {
            margin-top: 1rem; /* mt-4 */
            text-align: center;
        }
        .link a {
            font-size: 0.875rem; /* text-sm */
            color: #3182ce; /* text-blue-500 */
            text-decoration: none; /* hover:underline */
        }
        .link a:hover {
            text-decoration: underline; /* hover:underline */
        }
    </style>
</head>
<body>

    <div class="container">
        <h2>Réinitialisation du mot de passe</h2>
        <p>Entrez votre adresse e-mail pour recevoir un lien permettant de réinitialiser votre mot de passe.</p>

        <!-- Formulaire de réinitialisation -->
        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <div class="mb-4">
                <input 
                    type="email" 
                    name="email" 
                    id="email"
                    placeholder="Email"
                    required
                >
            </div>

            <button type="submit">
                ENVOYER LE LIEN DE RÉINITIALISATION DU MOT DE PASSE
            </button>
        </form>

        <!-- Message de confirmation après envoi du lien -->
        @if (session('status'))
            <div class="status">
                {{ session('status') }}
            </div>
        @endif

        <!-- Message d'erreur -->
        @error('email')
            <div class="error">
                {{ $message }}
            </div>
        @enderror

        <!-- Lien vers la page de connexion -->
        <div class="link">
            <a href="{{ route('login') }}">Retour à la connexion</a>
        </div>
    </div>

</body>
</html>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Plateforme de gestion financière et budgétaire d'entreprise</title>
    
    <link rel="icon" href="{{ asset('images/favicon.png') }}" type="image/png">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/responsive.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap-select.css') }}">
    <link rel="stylesheet" href="{{ asset('css/perfect-scrollbar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">

    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f2f4f7;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            padding: 20px;
        }

        .form-container {
            width: 100%;
            max-width: 500px;
            margin: auto;
            background: white;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
        }

        .btn-container {
            display: flex;
            justify-content: space-between;
        }

        .form-label {
            font-weight: bold;
        }

        .link-home {
            text-align: center;
            margin-top: 30px;
        }

        .link-home a {
            color: #007bff;
            font-weight: bold;
            text-decoration: none;
        }

        .link-home a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

    <div class="form-container">
        <h2 class="text-center mb-4">Modifier l'utilisateur</h2>
        <form action="{{ route('utilisateurs.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Nom</label>
                <input type="text" name="name" value="{{ $user->name }}" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" value="{{ $user->email }}" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Téléphone</label>
                <input type="text" name="telephone" value="{{ $user->telephone }}" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Poste</label>
                <input type="text" name="poste" value="{{ $user->poste }}" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Type</label>
                <select name="type" class="form-control" required>
                    <option value="admin" {{ $user->type === 'admin' ? 'selected' : '' }}>Administrateur</option>
                    <option value="user" {{ $user->type === 'user' ? 'selected' : '' }}>Utilisateur</option>
                </select>
            </div>

            <div class="btn-container">
                <button type="submit" class="btn btn-primary">Enregistrer</button>
                <a href="{{ route('utilisateurs.liste') }}" class="btn btn-secondary">Annuler</a>
            </div>
        </form>

        <div class="link-home">
            <p><a href="{{ route('dashboard') }}">← Retour à l'accueil</a></p>
        </div>
    </div>

    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/popper.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/animate.js') }}"></script>
    <script src="{{ asset('js/bootstrap-select.js') }}"></script>
    <script src="{{ asset('js/perfect-scrollbar.min.js') }}"></script>
    <script>
        var ps = new PerfectScrollbar('#sidebar');
    </script>
    <script src="{{ asset('js/custom.js') }}"></script>
</body>
</html>

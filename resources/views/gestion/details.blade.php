<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Détails de l'utilisateur - Plateforme de gestion</title>

    <link rel="icon" href="{{ asset('images/favicon.png') }}" type="image/png" />
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/responsive.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/bootstrap-select.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/perfect-scrollbar.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}" />

    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f7fa;
            margin: 0;
            padding: 20px;
        }

        .user-details-container {
            max-width: 600px;
            background-color: #fff;
            margin: 60px auto;
            padding: 40px 50px;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        }

        .user-details-container h2 {
            text-align: center;
            margin-bottom: 30px;
            font-weight: 600;
            color: #333;
        }

        .user-info p {
            font-size: 16px;
            padding: 10px 0;
            margin: 0;
            border-bottom: 1px solid #f0f0f0;
        }

        .user-info p strong {
            width: 120px;
            display: inline-block;
            color: #555;
        }

        .btn-back {
            margin-top: 30px;
            display: block;
            text-align: center;
        }

        .btn-back a {
            background-color: #007bff;
            color: #fff;
            padding: 12px 30px;
            border-radius: 8px;
            font-weight: 500;
            text-decoration: none;
            transition: background 0.3s ease;
        }

        .btn-back a:hover {
            background-color: #0056b3;
        }

        .alert-danger {
            text-align: center;
            color: #b00020;
            font-weight: bold;
        }
    </style>
</head>
<body>

    <div class="user-details-container">
        <h2>Détails de l'utilisateur</h2>

        @if(isset($utilisateur))
        <div class="user-info">
            <p><strong>ID :</strong> {{ $utilisateur->id }}</p>
            <p><strong>Nom :</strong> {{ $utilisateur->name }}</p>
            <p><strong>Email :</strong> {{ $utilisateur->email }}</p>
            <p><strong>Poste :</strong> {{ $utilisateur->poste }}</p>
            <p><strong>Type :</strong> {{ ucfirst($utilisateur->type) }}</p>
        </div>
        @else
        <div class="alert alert-danger">Utilisateur non trouvé.</div>
        @endif

        <div class="btn-back">
            <a href="{{ route('utilisateurs.liste') }}">← Retour à la liste</a>
        </div>
    </div>

    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/popper.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/animate.js') }}"></script>
    <script src="{{ asset('js/bootstrap-select.js') }}"></script>
    <script src="{{ asset('js/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('js/custom.js') }}"></script>
</body>
</html>

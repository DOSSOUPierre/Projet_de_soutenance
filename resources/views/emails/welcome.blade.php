<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenue</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f7fa;
            margin: 0;
            padding: 40px 0;
            color: #333;
        }
        .email-container {
            max-width: 600px;
            margin: auto;
            background-color: #ffffff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            border-top: 5px solid #007bff;
        }
        h1 {
            font-size: 28px;
            color: #007bff;
            margin-bottom: 20px;
            text-align: center;
        }
        p {
            font-size: 16px;
            line-height: 1.6;
            margin-bottom: 15px;
        }
        .info {
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 8px;
            margin-top: 20px;
            border-left: 5px solid #007bff;
        }
        .info strong {
            color: #555;
        }
        .btn {
            display: inline-block;
            margin-top: 30px;
            padding: 12px 24px;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            transition: background-color 0.3s ease;
            text-align: center;
        }
        .btn:hover {
            background-color: #0056b3;
        }
        .footer {
            margin-top: 30px;
            font-size: 14px;
            color: #777;
            text-align: center;
            border-top: 1px solid #ddd;
            padding-top: 15px;
            padding-bottom: 10px;
        }
        .highlight {
            background-color: #e7f3fe;
            border-left: 5px solid #007bff;
            padding: 15px;
            margin-top: 20px;
            border-radius: 8px;
        }
        ul {
            padding-left: 20px;
            list-style-type: disc;
        }
        li {
            margin-bottom: 10px;
        }
        .emoji {
            font-size: 1.2em;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <h1>Bienvenue, {{ $user->name }} ! 🎉</h1>

        <p>Merci de vous être inscrit sur <strong>la Plateforme de gestion financière et budgétaire d'entreprise</strong> ! Nous sommes ravis de vous accueillir dans notre communauté.</p>

        <div class="info">
            <p><strong>Email :</strong> {{ $user->email }}</p>
            @if($password)
                <p><strong>Mot de passe temporaire :</strong> {{ $password }}</p>
            @endif
        </div>

        <div class="highlight">
            <p><strong>Voici quelques informations utiles pour commencer :</strong></p>
            <ul>
                <li><strong>Connectez-vous à votre compte</strong> : Utilisez vos identifiants pour vous connecter <a href="{{ url('/login') }}">ici</a>.</li>
                <li><strong>Explorez nos fonctionnalités</strong> : Découvrez tout ce que nous avons à offrir.</li>
                <li>Si vous avez des questions ou besoin d'assistance, n'hésitez pas à nous contacter à <a href="mailto:pierredossou98@gmail.com">pierredossou98@gmail.com</a>.</li>
            </ul>
        </div>

        <p>Pour accéder à votre espace personnel, cliquez sur le bouton ci-dessous :</p>
        <a href="{{ url('/login') }}" class="btn">Connexion à la plateforme</a>

        <div class="footer">
            Cordialement,<br>
            L'équipe de <strong>la Plateforme de gestion financière et budgétaire d'entreprise</strong>
        </div>
    </div>
</body>
</html>
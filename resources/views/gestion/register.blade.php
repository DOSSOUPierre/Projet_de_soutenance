<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Plateforme de gestion financière et budgétaire d'entreprise</title>
    <link rel="icon" href="{{ asset('images/fevicon.html') }}" type="image/png" />
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('style.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/responsive.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/bootstrap-select.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/perfect-scrollbar.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}" />

    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f2f4f7;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            padding: 20px; /* Marge interne pour le corps de la page */
        }

        .login_form {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
            padding: 40px 50px; /* Augmentation du padding interne */
            width: 100%;
            max-width: 500px;
            margin: 30px auto; /* Marge externe autour du formulaire */
        }

        .logo_login {
            text-align: center;
            margin-bottom: 40px; /* Augmentation de l'espace sous le logo */
        }

        .logo_login img {
            width: 180px;
            margin: 0 auto; /* Centrage de l'image */
        }

        .field {
            margin-bottom: 30px;
            position: relative;
            padding: 0 5px; /* Légère marge interne pour les champs */
        }

        .label_field {
            font-size: 16px;
            font-weight: bold;
            color: #333;
            margin-bottom: 12px; /* Plus d'espace sous les labels */
            display: block;
            padding-left: 2px; /* Léger padding à gauche */
        }

        .input_field {
            width: 100%;
            padding: 14px 20px; /* Padding interne des champs */
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 8px;
            background-color: #fafafa;
            outline: none;
            transition: all 0.3s ease;
            margin-top: 5px; /* Marge au-dessus des champs */
        }

        .input_field:focus {
            border-color: #007bff;
            background-color: #fff;
        }

        .input_field::placeholder {
            color: #aaa;
        }

        .form-check-label {
            font-size: 14px;
            display: inline-block;
            margin-left: 8px; /* Plus d'espace après la checkbox */
            padding: 3px 0; /* Padding vertical */
        }

        .form-check-input {
            margin-right: 5px; /* Espace à droite de la checkbox */
        }

        .main_bt {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 16px; /* Augmentation du padding du bouton */
            width: 100%;
            font-size: 16px;
            font-weight: bold; /* Texte en gras */
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            margin-top: 10px; /* Marge au-dessus du bouton */
            margin-bottom: 10px; /* Marge en-dessous du bouton */
        }

        .main_bt:hover {
            background-color: #0056b3;
        }

        .text-danger {
            color: red;
            font-size: 12px;
            margin-top: 8px; /* Espace avant les messages d'erreur */
            padding-left: 2px; /* Léger padding à gauche */
            display: block; /* Pour s'assurer qu'il prend toute la largeur */
        }

        p {
            text-align: center;
            margin-top: 30px; /* Plus d'espace au-dessus du texte de connexion */
            margin-bottom: 10px; /* Espace en-dessous */
            font-size: 14px;
            padding: 5px; /* Padding interne */
        }

        p a {
            color: #007bff;
            text-decoration: none;
            padding: 2px; /* Petit padding pour agrandir la zone cliquable */
            margin-left: 5px; /* Espace à gauche du lien */
        }

        p a:hover {
            text-decoration: underline;
        }

        #togglePassword, #togglePasswordConfirmation {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            padding: 8px; /* Zone de clic plus grande */
        }

        /* Ajout d'une marge pour le conteneur des conditions */
        .terms-container {
            margin: 15px 0;
            padding: 5px 0;
        }

        /* Style pour les conteneurs de validation */
        .validation-container {
            margin-top: 5px;
            padding: 3px;
        }

        /* Responsive adjustments */
        @media (max-width: 576px) {
            .login_form {
                padding: 30px; /* Moins de padding sur mobile */
                margin: 15px; /* Moins de marge sur mobile */
            }
            
            body {
                padding: 10px; /* Moins de padding sur mobile */
            }
        }
    </style>
</head>
<body>
    <div class="login_form">
        <div class="logo_login">
            <img src="{{ asset('images/logo/logos.png') }}" alt="Logo" />
        </div>

        <form action="{{ route('register') }}" method="POST">
            @csrf
            <div class="field">
                <input type="text" name="name" id="name" class="input_field" placeholder="Nom"  required />
                @error('name')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="field">
                <input type="tel" name="telephone" id="telephone" class="input_field" placeholder="Téléphone"/>
                @error('telephone')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="field">
                <input type="email" name="email" id="email" class="input_field" placeholder="Email" required />
                @error('email')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="field">
                <input type="text" name="poste" id="poste" class="input_field" placeholder="Poste"  required />
                @error('poste')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="field">
                <label class="label_field" for="type"> </label>
                <select name="type" id="type" class="input_field" required>
                    <option value="" disabled selected>Choisissez un type</option>
                    <option value="user" {{ old('type') == 'user' ? 'selected' : '' }}>Utilisateur</option>
                    <option value="admin" {{ old('type') == 'admin' ? 'selected' : '' }}>Administrateur</option>
                </select>
                @error('type')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="field">
                <div class="input-group">
                    <input type="password" name="password" id="password" class="input_field" placeholder="Mot de passe" required />
                    <span id="togglePassword">👁️</span>
                </div>
                @error('password')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="field">
                <div class="input-group">
                    <input type="password" name="password_confirmation" id="password_confirmation" class="input_field" placeholder="Confirmer le mot de passe" required />
                    <span id="togglePasswordConfirmation">👁️</span>
                </div>
            </div>
            
            <div class="field terms-container">
                <label class="form-check-label">
                    <input type="checkbox" name="terms" class="form-check-input" id="terms" required> J'accepte les Termes et Conditions
                </label>
                @error('terms')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="field margin_0">
                <button type="submit" class="main_bt">Inscription</button>
            </div>
        </form>

        <p>Déjà un compte ? <a href="#">Connectez-vous</a></p>
    </div>

    <script>
        document.getElementById('togglePassword').addEventListener('click', function () {
            const passwordField = document.getElementById('password');
            const type = passwordField.type === 'password' ? 'text' : 'password';
            passwordField.type = type;
        });

        document.getElementById('togglePasswordConfirmation').addEventListener('click', function () {
            const passwordConfirmationField = document.getElementById('password_confirmation');
            const type = passwordConfirmationField.type === 'password' ? 'text' : 'password';
            passwordConfirmationField.type = type;
        });
    </script>

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
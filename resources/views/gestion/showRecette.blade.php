<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails de la Recette</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/YOUR_KIT.js" crossorigin="anonymous"></script>
</head>
<body class="bg-light py-5">

    <div class="container">
        <h1 class="mb-4 text-center fw-bold">Détails de la Recette</h1>

        <div class="card shadow-lg">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">Dépense #{{ $recette->id }}</h4>
            </div>
            <div class="card-body">
                <p><strong>Montant :</strong> {{ $recette->montant }} FCFA</p>
                <p><strong>Catégorie :</strong> {{ $recette->categorie->nom }}</p>
                <p><strong>Description :</strong> {{ $recette->description }}</p>
                <p><strong>Objet :</strong> {{ $recette->objet }}</p>
                <p><strong>Téléphone :</strong> {{ $recette->telephone }}</p>
            </div>
            <div class="card-footer text-end">
                <a href="{{ route('listeRecette') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Retour à la liste
                </a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rapport Financier - {{ $periode }}</title>

    <!-- Lien vers Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEJ1Q2h7h7D7P22nltK2f8GZhxg1X53cc/To16NsRjZFW91gCr9dM1Zm/ct93" crossorigin="anonymous">

    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 20px;
            background-color: #f4f4f9;
        }

        h1 {
            text-align: center;
            font-size: 2rem;
            color: #2C3E50;
            margin-bottom: 30px;
        }

        h2 {
            text-align: center;
            font-size: 1.5rem;
            color: #34495E;
        }

        .section-title {
            margin-top: 30px;
            font-size: 1.25rem;
            font-weight: bold;
            color: #34495E;
        }

        .table th, .table td {
            text-align: left;
            vertical-align: middle;
        }

        .table th {
            background-color: #2980B9;
            color: white;
        }

        .table td {
            background-color: #ffffff;
            color: #2C3E50;
        }

        .table tbody tr:nth-child(even) {
            background-color: #ECF0F1;
        }

        .table tbody tr:nth-child(odd) {
            background-color: #F9F9F9;
        }

        .total {
            font-weight: bold;
            background-color: #27AE60;
            color: white;
            text-align: right;
        }

        .footer {
            margin-top: 40px;
            font-size: 1rem;
            text-align: center;
            color: #7F8C8D;
        }

        .alert-warning {
            background-color: #F39C12;
            color: white;
            padding: 15px;
            border-radius: 5px;
            margin-top: 30px;
        }

        .content {
            max-width: 1200px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="content">
        <h1>Rapport Financier</h1>
        <p class="text-center">Période : {{ $periode }}</p>

        <div class="section-title">Recettes Archivées</div>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Description</th>
                    <th>Objet</th>
                    <th>Montant</th>
                    <th>Catégorie</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach($recettes as $recette)
                    <tr>
                        <td>{{ $recette->description }}</td>
                        <td>{{ $recette->objet }}</td>
                        <td>{{ number_format($recette->montant, 2, ',', ' ') }} FCFA</td>
                        <td>{{ $recette->categorie->nom }}</td>
                        <td>{{ $recette->created_at->format('d/m/Y') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="section-title">Dépenses Archivées</div>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Description</th>
                    <th>Objet</th>
                    <th>Montant</th>
                    <th>Catégorie</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach($depenses as $depense)
                    <tr>
                        <td>{{ $depense->description }}</td>
                        <td>{{ $depense->objet }}</td>
                        <td>{{ number_format($depense->montant, 2, ',', ' ') }} FCFA</td>
                        <td>{{ $depense->categorie->nom }}</td>
                        <td>{{ $depense->created_at->format('d/m/Y') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="section-title">Résumé Financier</div>
        <table class="table table-bordered">
            <tbody>
                <tr>
                    <th>Total Recettes</th>
                    <td class="total">{{ number_format($totalRecettes, 2, ',', ' ') }} FCFA</td>
                </tr>
                <tr>
                    <th>Total Dépenses</th>
                    <td class="total">{{ number_format($totalDepenses, 2, ',', ' ') }} FCFA</td>
                </tr>
                <tr>
                    <th>Solde</th>
                    <td class="total">{{ number_format($totalRecettes - $totalDepenses, 2, ',', ' ') }} FCFA</td>
                </tr>
                <tr>
                    <th>Budget prévisionnel (période suivante)</th>
                    <td class="total">{{ number_format($budgetPrevisionnel, 2, ',', ' ') }} FCFA</td>
                </tr>
            </tbody>
        </table>

        <div class="section-title">Conseils Financiers</div>
        <p>Attention, votre entreprise est en déficit cette période. Il serait sage de revoir vos dépenses, peut-être de négocier avec vos fournisseurs ou d'optimiser certains coûts. Envisagez également de diversifier vos sources de revenus.</p>

        <div class="alert-warning">
            <strong>Note :</strong> Ce rapport a été généré automatiquement par le système.
        </div>

        <div class="footer">
            <p>Rapport généré le {{ now()->format('d/m/Y') }}</p>
        </div>
    </div>

    <!-- Script Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pzjw8f+ua7Kw1TIq0rM6sxk6V3u7D56n4rxvtdkE9A4j+UE9dkmnv9A5z1X//gV6" crossorigin="anonymous"></script>
</body>
</html>

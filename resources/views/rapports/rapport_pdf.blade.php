<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Rapport Financier</title>
    <style>
        body {
            font-family: 'DejaVu Sans', sans-serif;
            color: #333;
            margin: 20px;
        }
        h1, h2 {
            color: #0D47A1;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
        }
        .section {
            margin-bottom: 40px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }
        th, td {
            border: 1px solid #999;
            padding: 8px 12px;
            text-align: left;
        }
        th {
            background-color: #f1f1f1;
        }
        .highlight {
            background-color: #e3f2fd;
        }
        .total {
            font-weight: bold;
            background-color: #c8e6c9;
        }
        .budget {
            background-color: #fff9c4;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Rapport Financier</h1>
        <h3>Période : {{ $periode }}</h3>
    </div>

    <div class="section">
        <h2>Recettes</h2>
        <table>
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
                        <td>{{ $recette->categorie->nom ?? 'N/A' }}</td>
                        <td>{{ $recette->created_at->format('d/m/Y') }}</td>
                    </tr>
                @endforeach
                <tr class="total">
                    <td colspan="2">Total recettes</td>
                    <td colspan="3">{{ number_format($totalRecettes, 2, ',', ' ') }} FCFA</td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="section">
        <h2>Dépenses</h2>
        <table>
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
                        <td>{{ $depense->description ?? '-' }}</td>
                        <td>{{ $depense->objet ?? '-' }}</td>
                        <td>{{ number_format($depense->montant, 2, ',', ' ') }} FCFA</td>
                        <td>{{ $depense->categorie->nom ?? 'N/A' }}</td>
                        <td>{{ $depense->created_at->format('d/m/Y') }}</td>
                    </tr>
                @endforeach
                <tr class="total">
                    <td colspan="2">Total dépenses</td>
                    <td colspan="3">{{ number_format($totalDepenses, 2, ',', ' ') }} FCFA</td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="section">
        <h2>Résumé financier</h2>
        <table>
            <tbody>
                <tr class="highlight">
                    <td>Total recettes</td>
                    <td>{{ number_format($totalRecettes, 2, ',', ' ') }} FCFA</td>
                </tr>
                <tr class="highlight">
                    <td>Total dépenses</td>
                    <td>{{ number_format($totalDepenses, 2, ',', ' ') }} FCFA</td>
                </tr>
                <tr class="total">
                    <td>Solde</td>
                    <td>{{ number_format($totalRecettes - $totalDepenses, 2, ',', ' ') }} FCFA</td>
                </tr>
                <tr class="budget">
                    <td>Budget prévisionnel (période suivante)</td>
                    <td>{{ number_format($budgetPrevisionnel, 2, ',', ' ') }} FCFA</td>
                </tr>
            </tbody>
        </table>
    </div>
</body>
</html>

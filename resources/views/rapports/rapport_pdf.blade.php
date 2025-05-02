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
            table-layout: fixed;
        }
        th, td {
            border: 1px solid #999;
            padding: 8px 12px;
            text-align: left;
            word-wrap: break-word;
            word-break: break-word;
            max-width: 150px;
            overflow-wrap: break-word;
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
        .advice {
            margin-top: 30px;
            background-color: #ffeb3b;
            padding: 15px;
            border: 1px solid #ff9800;
            border-radius: 5px;
        }
    </style>
</head>
<body>

    @if(isset($periode))
        <div class="header">
            <h1>Rapport Financier</h1>
            <h3>Période : {{ $periode }}</h3>
        </div>

        {{-- Recettes --}}
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
                    @forelse($recettes as $recette)
                        <tr>
                            <td>{{ $recette->description }}</td>
                            <td>{{ $recette->objet }}</td>
                            <td>{{ number_format($recette->montant, 2, ',', ' ') }} FCFA</td>
                            <td>{{ $recette->categorie->nom ?? 'N/A' }}</td>
                            <td>{{ $recette->created_at->format('d/m/Y') }}</td>
                        </tr>
                    @empty
                        <tr><td colspan="5">Aucune recette trouvée.</td></tr>
                    @endforelse
                    <tr class="total">
                        <td colspan="2">Total recettes</td>
                        <td colspan="3">{{ number_format($totalRecettes, 2, ',', ' ') }} FCFA</td>
                    </tr>
                </tbody>
            </table>
        </div>

        {{-- Dépenses --}}
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
                    @forelse($depenses as $depense)
                        <tr>
                            <td>{{ $depense->description ?? '-' }}</td>
                            <td>{{ $depense->objet ?? '-' }}</td>
                            <td>{{ number_format($depense->montant, 2, ',', ' ') }} FCFA</td>
                            <td>{{ $depense->categorie->nom ?? 'N/A' }}</td>
                            <td>{{ $depense->created_at->format('d/m/Y') }}</td>
                        </tr>
                    @empty
                        <tr><td colspan="5">Aucune dépense trouvée.</td></tr>
                    @endforelse
                    <tr class="total">
                        <td colspan="2">Total dépenses</td>
                        <td colspan="3">{{ number_format($totalDepenses, 2, ',', ' ') }} FCFA</td>
                    </tr>
                </tbody>
            </table>
        </div>

        {{-- Résumé --}}
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

        {{-- Conseils --}}
        <div class="advice">
            <h3>Conseils Financiers</h3>
            @if($totalRecettes > $totalDepenses)
                <p>Félicitations, votre entreprise est bénéficiaire cette période ! Il est conseillé de mettre une partie de votre excédent en réserve pour les périodes creuses. Vous pouvez aussi investir dans des projets qui génèrent des revenus supplémentaires.</p>
            @elseif($totalRecettes < $totalDepenses)
                <p>Attention, votre entreprise est en déficit cette période. Il serait sage de revoir vos dépenses, peut-être de négocier avec vos fournisseurs ou d'optimiser certains coûts. Envisagez également de diversifier vos sources de revenus.</p>
            @else
                <p>Votre entreprise est en équilibre cette période. C’est encourageant, mais continuez à rechercher des opportunités pour améliorer vos revenus et réduire les coûts.</p>
            @endif
        </div>
    @endif

</body>
</html>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Rapport Archives</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 30px; }
        th, td { border: 1px solid #ddd; padding: 8px; font-size: 12px; }
        th { background-color: #f2f2f2; }
        h2 { color: #333; }
    </style>
</head>
<body>

<h2>Recettes Archivées</h2>
<table>
    <thead>
        <tr>
            <th>#</th>
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
                <td>{{ $recette->id }}</td>
                <td>{{ $recette->description }}</td>
                <td>{{ $recette->objet }}</td>
                <td>{{ $recette->montant }} FCFA</td>
                <td>{{ $recette->categorie->nom }}</td>
                <td>{{ $recette->created_at->format('d/m/Y H:i') }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

<h2>Dépenses Archivées</h2>
<table>
    <thead>
        <tr>
            <th>#</th>
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
                <td>{{ $depense->id }}</td>
                <td>{{ $depense->description }}</td>
                <td>{{ $depense->objet }}</td>
                <td>{{ $depense->montant }} FCFA</td>
                <td>{{ $depense->categorie->nom }}</td>
                <td>{{ $depense->created_at->format('d/m/Y H:i') }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

</body>
</html>

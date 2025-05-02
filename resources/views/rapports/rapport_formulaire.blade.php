<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Exporter le Rapport Financier</title>
    <style>
        /* Styles similaires à ceux de la page précédente */
        body {
            font-family: 'DejaVu Sans', sans-serif;
            color: #333;
            margin: 20px;
        }
        h1 {
            color: #0D47A1;
        }
        form {
            margin-bottom: 30px;
        }
        label {
            margin-right: 10px;
        }
        input[type="date"], select {
            padding: 5px;
            margin-right: 20px;
        }
        button {
            padding: 6px 15px;
        }
    </style>
</head>
<body>

    {{-- Formulaire pour exporter par période prédéfinie --}}
    <<form action="{{ route('rapport.pdf') }}" method="POST">
        @csrf
        <select name="periode">
            <option value="jour">Aujourd'hui</option>
            <option value="semaine">Cette semaine</option>
            <option value="mois">Ce mois</option>
            <option value="annee">Cette année</option>
        </select>
        <button type="submit">Télécharger PDF</button>
    </form>
    
    <form action="{{ route('rapport.generer') }}" method="POST">
        @csrf
        <label for="debut">Date de début :</label>
        <input type="date" name="debut" required>
    
        <label for="fin">Date de fin :</label>
        <input type="date" name="fin" required>
    
        <button type="submit">Afficher le rapport</button>
    </form>
    

    {{-- Formulaire pour filtrer par plage de dates --}}
    <form method="GET" action="{{ route('envoyer.rapport') }}">
        <label for="debut">Date de début :</label>
        <input type="date" name="debut" id="debut" value="{{ request('debut') }}" required>

        <label for="fin">Date de fin :</label>
        <input type="date" name="fin" id="fin" value="{{ request('fin') }}" required>

        <label for="jour">Jour :</label>
        <input type="date" name="jour" id="jour" value="{{ request('jour') }}" required>

        <label for="semaine">Semaine :</label>
        <input type="date" name="semaine" id="semaine" value="{{ request('semaine') }}" required>

        <label for="mois">Mois :</label>
        <input type="date" name="mois" id="mois" value="{{ request('mois') }}" required>

        <label for="annee">Année :</label>
        <input type="date" name="annee" id="annee" value="{{ request('annee') }}" required>

        <button type="submit">Générer le rapport</button>
    </form>

</body>
</html>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Rapport de Littérature</title>
    <style>
        body {
            font-family: 'DejaVu Sans', sans-serif;
            line-height: 1.6;
            margin: 40px;
            color: #333;
        }
        h1, h2, h3 {
            text-align: center;
        }
        .section {
            margin-bottom: 40px;
        }
    </style>
</head>
<body>
    <h1>Rapport de Littérature</h1>
    <h2>Projet : {{ $projet }}</h2>
    <p>Date de génération : {{ \Carbon\Carbon::now()->format('d/m/Y') }}</p>

    <div class="section">
        <h2>1. Introduction</h2>
        <p>
            Cette revue de littérature vise à explorer les travaux existants liés à la gestion numérique des recettes et dépenses au sein des petites et moyennes entreprises (PME).
        </p>
    </div>

    <div class="section">
        <h2>2. Problématique</h2>
        <p>
            Malgré l’essor des outils numériques, la majorité des PME rencontrent encore des difficultés à suivre efficacement leurs finances, à anticiper les besoins et à éviter les erreurs humaines dues à la saisie manuelle.
        </p>
    </div>

    <div class="section">
        <h2>3. Travaux connexes</h2>
        <ul>
            <li><strong>Systèmes ERP :</strong> Solutions intégrées mais souvent coûteuses et complexes pour les petites structures.</li>
            <li><strong>Applications Cloud :</strong> comme Wave, QuickBooks ou Odoo, mais limitées pour une personnalisation spécifique aux besoins locaux ou à un secteur ciblé.</li>
            <li><strong>Approches par IA :</strong> Utilisation d’algorithmes pour prédire les flux de trésorerie.</li>
        </ul>
    </div>

    <div class="section">
        <h2>4. Apports du projet</h2>
        <ul>
            <li>Un enregistrement simple des recettes et dépenses</li>
            <li>Une visualisation graphique des flux financiers</li>
            <li>Un moteur de prédiction basé sur les données historiques</li>
            <li>Un générateur automatique de rapports financiers</li>
        </ul>
    </div>

    <div class="section">
        <h2>5. Conclusion</h2>
        <p>
            En se basant sur les travaux existants tout en les adaptant aux besoins spécifiques des PME locales, ce projet contribue à la démocratisation de la gestion financière numérique.
        </p>
    </div>
</body>
</html>

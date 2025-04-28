<?php

namespace App\Http\Controllers;

use App\Models\Recette;
use App\Models\Depense;
use Illuminate\Http\Request;

class VisualisationController extends Controller
{
    // Méthode principale pour visualiser les recettes et dépenses selon une période ou une plage de dates
    public function visualiser(Request $request)
    {
        $periode = $request->input('periode'); // Ex: jour, semaine, mois, année
        $dateDebut = $request->input('date_debut'); // Plage personnalisée début
        $dateFin = $request->input('date_fin'); // Plage personnalisée fin

        // Aucune action si ni période ni dates ne sont spécifiées
        if (empty($periode) && (empty($dateDebut) || empty($dateFin))) {
            session()->flash('erreur', 'Veuillez sélectionner une période ou une plage de dates avant de visualiser.');
            return view('visualisation', [
                'labels' => collect(),
                'recettesData' => [],
                'depensesData' => [],
                'totalRecettes' => 0,
                'totalDepenses' => 0,
                'performance' => 'Veuillez sélectionner une période ou une plage de dates.',
                'rapport' => 'Aucune analyse disponible.',
                'budgetPrevisionnel' => [
                    'recettes' => 0,
                    'depenses' => 0,
                    'solde' => 0,
                ],
                'aucune_donnee' => true,
            ]);
        }

        // 1. Validation si une période a été choisie
        if ($periode) {
            $request->validate([
                'periode' => 'in:jour,semaine,mois,annee',
            ], [
                'periode.in' => 'Période invalide sélectionnée.',
            ]);
        }

        // 2. Déterminer les dates à utiliser pour la recherche
        if (!empty($dateDebut) && !empty($dateFin)) {
            $debut = $dateDebut;
            $fin = $dateFin;
        } else {
            // Calcul automatique des dates selon la période choisie
            switch ($periode) {
                case 'jour':
                    $debut = now()->startOfDay();
                    $fin = now()->endOfDay();
                    break;
                case 'semaine':
                    $debut = now()->startOfWeek();
                    $fin = now()->endOfWeek();
                    break;
                case 'annee':
                    $debut = now()->startOfYear();
                    $fin = now()->endOfYear();
                    break;
                case 'mois':
                default:
                    $debut = now()->startOfMonth();
                    $fin = now()->endOfMonth();
                    break;
            }
        }

        // 3. Récupération des recettes archivées=false sur la période sélectionnée
        $recettes = Recette::where('archiver', false)
            ->whereBetween('created_at', [$debut, $fin])
            ->selectRaw('SUM(montant) as total, DATE(created_at) as date')
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        // 3. Récupération des dépenses archivées=false sur la période sélectionnée
        $depenses = Depense::where('archiver', false)
            ->whereBetween('created_at', [$debut, $fin])
            ->selectRaw('SUM(montant) as total, DATE(created_at) as date')
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        // 4. Vérification s'il y a des données ou non
        $aucune_donnee = $recettes->isEmpty() && $depenses->isEmpty();

        if ($aucune_donnee) {
            // Cas où il n'y a aucune recette ni dépense
            $labels = collect();
            $recettesData = [];
            $depensesData = [];
            $totalRecettes = 0;
            $totalDepenses = 0;
            $performance = 'Aucune donnée disponible.';
            $rapport = 'Aucune analyse possible pour cette période.';
            $budgetPrevisionnel = [
                'recettes' => 0,
                'depenses' => 0,
                'solde' => 0,
            ];
        } else {
            // Construction des labels (dates) triés
            $labels = $recettes->pluck('date')->merge($depenses->pluck('date'))->unique()->sort()->values();

            $recettesData = [];
            $depensesData = [];

            // Remplissage des données recettes/dépenses alignées sur les labels
            foreach ($labels as $label) {
                $recettesData[] = $recettes->firstWhere('date', $label)->total ?? 0;
                $depensesData[] = $depenses->firstWhere('date', $label)->total ?? 0;
            }

            // Calculs des totaux
            $totalRecettes = array_sum($recettesData);
            $totalDepenses = array_sum($depensesData);

            // Évaluation de la performance
            $performance = $this->evaluerPerformance($totalRecettes, $totalDepenses);

            // Génération du rapport textuel
            $rapport = $this->genererRapport($totalRecettes, $totalDepenses);

            // Prévision budgétaire
            $budgetPrevisionnel = $this->prevoirBudget($recettesData, $depensesData);
        }

        // 5. Retourner la vue avec toutes les données préparées
        return view('visualisation', compact(
            'labels',
            'recettesData',
            'depensesData',
            'totalRecettes',
            'totalDepenses',
            'performance',
            'rapport',
            'budgetPrevisionnel',
            'aucune_donnee'
        ));
    }

    // Méthode privée pour évaluer la situation financière (bénéfice, perte, équilibre)
    private function evaluerPerformance($totalRecettes, $totalDepenses)
    {
        if ($totalRecettes > $totalDepenses) {
            return 'L\'entreprise est en bénéfice.';
        } elseif ($totalRecettes < $totalDepenses) {
            return 'L\'entreprise est en perte.';
        } else {
            return 'L\'entreprise est à l\'équilibre.';
        }
    }

    // Méthode privée pour générer une recommandation textuelle basée sur les résultats
    private function genererRapport($totalRecettes, $totalDepenses)
    {
        $difference = $totalRecettes - $totalDepenses;

        if ($difference > 0) {
            return "L'entreprise a gagné " . number_format($difference, 2) . " FCFA. Il serait judicieux d'investir dans des opportunités de croissance.";
        } elseif ($difference < 0) {
            return "L'entreprise a perdu " . number_format(abs($difference), 2) . " FCFA. Il est recommandé de revoir les dépenses et d'optimiser les coûts.";
        } else {
            return "L'entreprise est à l'équilibre. Aucune action immédiate n'est nécessaire.";
        }
    }

    // Méthode privée pour prévoir le prochain budget basé sur la moyenne des recettes et dépenses
    private function prevoirBudget($recettesData, $depensesData)
    {
        $moyenneRecettes = count($recettesData) ? array_sum($recettesData) / count($recettesData) : 0;
        $moyenneDepenses = count($depensesData) ? array_sum($depensesData) / count($depensesData) : 0;

        return [
            'recettes' => round($moyenneRecettes),
            'depenses' => round($moyenneDepenses),
            'solde' => round($moyenneRecettes - $moyenneDepenses),
        ];
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Recette;
use App\Models\Depense;
use Illuminate\Http\Request;

class VisualisationController extends Controller
{
    public function visualiser(Request $request)
    {
        $periode = $request->input('periode');
        $dateDebut = $request->input('date_debut');
        $dateFin = $request->input('date_fin');

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

        // 2. Déterminer les dates à utiliser
        if (!empty($dateDebut) && !empty($dateFin)) {
            $debut = $dateDebut;
            $fin = $dateFin;
        } else {
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

        // 3. Récupération des données
        $recettes = Recette::where('archiver', false)
            ->whereBetween('created_at', [$debut, $fin])
            ->selectRaw('SUM(montant) as total, DATE(created_at) as date')
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        $depenses = Depense::where('archiver', false)
            ->whereBetween('created_at', [$debut, $fin])
            ->selectRaw('SUM(montant) as total, DATE(created_at) as date')
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        // 4. Traitement des données
        $aucune_donnee = $recettes->isEmpty() && $depenses->isEmpty();

        if ($aucune_donnee) {
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
            $labels = $recettes->pluck('date')->merge($depenses->pluck('date'))->unique()->sort()->values();
            $recettesData = [];
            $depensesData = [];

            foreach ($labels as $label) {
                $recettesData[] = $recettes->firstWhere('date', $label)->total ?? 0;
                $depensesData[] = $depenses->firstWhere('date', $label)->total ?? 0;
            }

            $totalRecettes = array_sum($recettesData);
            $totalDepenses = array_sum($depensesData);
            $performance = $this->evaluerPerformance($totalRecettes, $totalDepenses);
            $rapport = $this->genererRapport($totalRecettes, $totalDepenses);
            $budgetPrevisionnel = $this->prevoirBudget($recettesData, $depensesData);
        }

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

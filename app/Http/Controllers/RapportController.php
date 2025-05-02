<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Recette;
use App\Models\Depense;
use Carbon\Carbon;

class RapportController extends Controller
{
    /**
     * Génère un rapport financier PDF selon une période donnée.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function generer(Request $request): \Illuminate\Http\Response
    {
        // Récupérer la période demandée (jour, semaine, mois, année) ou définir 'mois' par défaut
        $periode = $request->input('periode', 'mois');
        $now = Carbon::now(); // Récupérer la date et l'heure actuelles

        // Déterminer la période exacte (jour, semaine, mois, année)
        switch ($periode) {
            case 'jour':
                $start = $now->copy()->startOfDay();
                $end = $now->copy()->endOfDay();
                $libellePeriode = 'Aujourd\'hui';
                break;
            case 'semaine':
                $start = $now->copy()->startOfWeek();
                $end = $now->copy()->endOfWeek();
                $libellePeriode = 'Semaine du ' . $start->format('d/m/Y') . ' au ' . $end->format('d/m/Y');
                break;
            case 'mois':
                $start = $now->copy()->startOfMonth();
                $end = $now->copy()->endOfMonth();
                $libellePeriode = 'Mois de ' . $now->locale('fr')->isoFormat('MMMM YYYY');
                break;
            case 'annee':
                $start = $now->copy()->startOfYear();
                $end = $now->copy()->endOfYear();
                $libellePeriode = 'Année ' . $now->year;
                break;
            default:
                $start = $now->copy()->startOfMonth();
                $end = $now->copy()->endOfMonth();
                $libellePeriode = 'Période inconnue';
                break;
        }

        // Récupérer les recettes et les dépenses pour la période spécifiée
        $recettes = Recette::whereBetween('created_at', [$start, $end])->get();
        $depenses = Depense::whereBetween('created_at', [$start, $end])->get();

        // Calculer le total des recettes et des dépenses
        $totalRecettes = $recettes->sum('montant');
        $totalDepenses = $depenses->sum('montant');

        // Calculer le budget prévisionnel (90% de l'excédent)
        $budgetPrevisionnel = max(0, ($totalRecettes - $totalDepenses) * 0.9);

        // Générer le fichier PDF à partir de la vue Blade
        $pdf = Pdf::loadView('rapports.rapport_pdf', [
            'recettes' => $recettes,
            'depenses' => $depenses,
            'totalRecettes' => $totalRecettes,
            'totalDepenses' => $totalDepenses,
            'budgetPrevisionnel' => $budgetPrevisionnel,
            'periode' => $libellePeriode
        ]);

        // Télécharger le PDF
        return $pdf->download('rapport-financier.pdf');
    }

    /**
     * Génère un rapport de littérature PDF pour le projet.
     * 
     * @return \Illuminate\Http\Response
     */
    public function literaturePDF(): \Illuminate\Http\Response
    {
        $projet = 'Système de gestion numérique des recettes et dépenses pour les PME';

        $pdf = Pdf::loadView('rapports.literature_report', compact('projet'));

        return $pdf->download('rapport_litterature.pdf');
    }
}

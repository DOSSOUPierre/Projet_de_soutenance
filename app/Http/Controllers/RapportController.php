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
     */
    public function generer(Request $request)
    {
        $periode = $request->input('periode', 'mois');
        $now = Carbon::now();

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
        }

        $recettes = Recette::whereBetween('created_at', [$start, $end])->get();
        $depenses = Depense::whereBetween('created_at', [$start, $end])->get();

        $totalRecettes = $recettes->sum('montant');
        $totalDepenses = $depenses->sum('montant');
        $budgetPrevisionnel = max(0, ($totalRecettes - $totalDepenses) * 0.9);

        $pdf = Pdf::loadView('rapports.rapport_pdf', [
            'recettes' => $recettes,
            'depenses' => $depenses,
            'totalRecettes' => $totalRecettes,
            'totalDepenses' => $totalDepenses,
            'budgetPrevisionnel' => $budgetPrevisionnel,
            'periode' => $libellePeriode
        ]);

        return $pdf->download('rapport-financier.pdf');
    }

    /**
     * Génère un rapport de littérature PDF.
     */
    public function literaturePDF()
    {
        $projet = 'Système de gestion numérique des recettes et dépenses pour les PME';

        $pdf = Pdf::loadView('rapports.literature_report', compact('projet'));

        return $pdf->download('rapport_litterature.pdf');
    }
}

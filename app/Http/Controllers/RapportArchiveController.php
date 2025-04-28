<?php

namespace App\Http\Controllers;

use App\Models\Depense;
use App\Models\Recette;
use App\Models\User;
use App\Notifications\RapportArchivesNotification;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;

class RapportArchiveController extends Controller
{
    public function envoyerRapport()
    {
        // 1. Définir la période (exemple : du 1er au dernier jour du mois)
        $dateDebut = Carbon::now()->startOfMonth();
        $dateFin = Carbon::now()->endOfMonth();
        $periode = "Du " . $dateDebut->format('d/m/Y') . " au " . $dateFin->format('d/m/Y');

        // 2. Récupérer les données des recettes et dépenses
        $recettes = Recette::where('archiver', 1)
                           ->whereBetween('created_at', [$dateDebut, $dateFin])
                           ->get();

        $depenses = Depense::where('archiver', 1)
                           ->whereBetween('created_at', [$dateDebut, $dateFin])
                           ->get();

        // Calcul des totaux
        $totalRecettes = $recettes->sum('montant');
        $totalDepenses = $depenses->sum('montant');
        $budgetPrevisionnel = $totalRecettes - $totalDepenses;

        // 3. Générer le PDF
        $pdf = Pdf::loadView('rapports.archives', [
            'recettes' => $recettes,
            'depenses' => $depenses,
            'totalRecettes' => $totalRecettes,
            'totalDepenses' => $totalDepenses,
            'budgetPrevisionnel' => $budgetPrevisionnel,
            'periode' => $periode,
        ]);

        // 4. Enregistrer le fichier temporairement dans storage
        $fileName = 'rapports/rapport_financier_archives_' . now()->timestamp . '.pdf';
        Storage::put($fileName, $pdf->output());

        // 5. Envoi par email (notification avec le chemin du fichier)
        $user = User::find(1); // Remplacer par l'ID de l'utilisateur réel
        if ($user) {
            Notification::send($user, new RapportArchivesNotification($fileName));
        }

        // 6. Téléchargement automatique du fichier PDF
        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->output();
        }, 'rapport_financier_archives.pdf');
    }
}

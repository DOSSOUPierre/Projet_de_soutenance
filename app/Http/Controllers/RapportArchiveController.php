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
        // 1. Définir la période (du 1er au dernier jour du mois en cours)
        $dateDebut = Carbon::now()->startOfMonth();
        $dateFin = Carbon::now()->endOfMonth();
        $periode = "Du " . $dateDebut->format('d/m/Y') . " au " . $dateFin->format('d/m/Y');

        // 2. Récupérer les données archivées des recettes et des dépenses pour la période définie
        $recettes = Recette::where('archiver', 1)
                           ->whereBetween('created_at', [$dateDebut, $dateFin])
                           ->get();

        $depenses = Depense::where('archiver', 1)
                           ->whereBetween('created_at', [$dateDebut, $dateFin])
                           ->get();

        // 2.1. Calcul des totaux
        $totalRecettes = $recettes->sum('montant');
        $totalDepenses = $depenses->sum('montant');
        $budgetPrevisionnel = $totalRecettes - $totalDepenses;

        // 3. Générer le PDF avec les données financières
        $pdf = Pdf::loadView('rapports.archives', [
            'recettes' => $recettes,
            'depenses' => $depenses,
            'totalRecettes' => $totalRecettes,
            'totalDepenses' => $totalDepenses,
            'budgetPrevisionnel' => $budgetPrevisionnel,
            'periode' => $periode,
        ]);

        // 4. Enregistrer le fichier PDF temporairement dans le dossier storage/app/rapports/
        $fileName = 'rapports/rapport_financier_archives_' . now()->timestamp . '.pdf';
        Storage::put($fileName, $pdf->output());

        // 5. Envoi du rapport par email via notification (ex. à l'utilisateur avec ID = 1)
        $user = User::find(1); // À remplacer par l'utilisateur connecté ou un destinataire réel

        if ($user) {
            Notification::send($user, new RapportArchivesNotification($fileName));
        }

        // 6. Proposer le téléchargement automatique du fichier PDF généré
        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->output();
        }, 'rapport_financier_archives.pdf');
    }
}

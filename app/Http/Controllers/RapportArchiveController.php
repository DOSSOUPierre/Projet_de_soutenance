<?php

namespace App\Http\Controllers;

use App\Models\Recette;
use App\Models\Depense;
use App\Services\PdfService; // Ajout de l'import du service
use Illuminate\Http\Request;
use App\Models\User;
use App\Notifications\RapportArchivesNotification;

class RapportArchiveController extends Controller
{
    protected $pdfService;

    // Injection du service PdfService dans le constructeur
    public function __construct(PdfService $pdfService)
    {
        $this->pdfService = $pdfService;
    }

    public function generatePDF()
    {
        // Récupérer les recettes et les dépenses archivées
        $recettes = Recette::where('archiver', 1)->get();
        $depenses = Depense::where('archiver', 1)->get();

        // Vérifier qu'il y a des données
        if ($recettes->isEmpty() && $depenses->isEmpty()) {
            return back()->with('error', 'Aucune donnée archivée à exporter.');
        }

        // Utiliser le service pour générer le PDF
        $fileName = 'rapport_archives_' . now()->format('d-m-Y_H-i-s') . '.pdf';
        $pdfPath = $this->pdfService->generatePdf('rapports.archives', compact('recettes', 'depenses'), $fileName);

        // Envoyer l'email avec pièce jointe
        $admin = User::where('is_admin', 1)->first();
        if ($admin) {
            $admin->notify(new RapportArchivesNotification($pdfPath));
        }

        // Télécharger et supprimer après
        return response()->download($pdfPath)->deleteFileAfterSend(true);
    }
}

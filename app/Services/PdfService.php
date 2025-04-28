<?php

namespace App\Services;

use Barryvdh\DomPDF\Facade\Pdf; // Correction de l'import

class PdfService
{
    /**
     * Génère un PDF à partir d'une vue Blade et des données fournies.
     *
     * @param string $view Le chemin de la vue Blade.
     * @param array $data Les données à passer à la vue.
     * @return string Le contenu du fichier PDF.
     */
    public function generatePdf(string $view, array $data = []): string
    {
        // Génère le PDF à partir de la vue et retourne le contenu
        return Pdf::loadView($view, $data)->output();
    }
}

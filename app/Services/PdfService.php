<?php

namespace App\Services;

use Barryvdh\DomPDF\Facade as PDF; // Importation du facade PDF

class PdfService
{
    public function generatePdf($view, $data = [])
    {
        // Génère le PDF à partir de la vue
        return PDF::loadView($view, $data)->output();
    }
}

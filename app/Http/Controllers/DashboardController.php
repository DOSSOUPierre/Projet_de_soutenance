<?php
namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Depense;
use App\Models\Recette;
use App\Models\Rapport;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $totalUtilisateurs = User::count();
        $totalDepenses = Depense::sum('montant');
        $totalRecettes = Recette::sum('montant');
        $totalRapports = Rapport::count(); // ou adapte si tu n’as pas de modèle Rapport

        return view('dashboard', compact(
            'totalUtilisateurs',
            'totalDepenses',
            'totalRecettes',
            'totalRapports'
        ));
    }
}

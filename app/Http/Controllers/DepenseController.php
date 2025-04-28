<?php

namespace App\Http\Controllers;

use App\Models\Depense;
use App\Models\Categorie;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Carbon\CarbonInterface;
use App\Notifications\DepenseEnregistreeNotification;

class DepenseController extends Controller
{
    // Afficher la liste des dépenses
    public function index()
    {
        $depenses = Depense::with('categorie')->where('archiver', false)->get();
        $categories = Categorie::all();

        return view('depense.indexdepnse', compact('depenses', 'categories'));
    }

    // Afficher les dépenses archivées
    public function archivees()
    {
        $depenses = Depense::with('categorie')->where('archiver', true)->get();
        return view('depense.archiveesdepense', compact('depenses'));
    }

    // Afficher le formulaire de création de dépense
    public function create()
    {
        $categories = Categorie::all();
        return view('depense.create', compact('categories'));
    }

    // Enregistrer une nouvelle dépense
    public function store(Request $request)
    {
        $validated = $request->validate([
            'montant' => 'required|numeric|min:0',
            'categorie_id' => 'required|exists:categories,id',
            'description' => 'nullable|string|max:255',
            'objet' => 'nullable|string|max:255',
            'telephone' => 'nullable|string|max:20',
            'archiver' => 'nullable|boolean',
        ]);

        $validated['archiver'] = $request->has('archiver') ? 1 : 0;

        $depense = Depense::create($validated);

        $admin = User::where('type', 'admin')->first();
        if ($admin) {
            $admin->notify(new DepenseEnregistreeNotification($depense));
        }

        return redirect()->route('listeDepense')->with('success', 'Dépense ajoutée avec succès');
    }

    // Afficher le formulaire d'édition de dépense
    public function edit($id)
    {
        $depense = Depense::findOrFail($id);
        $categories = Categorie::all();

        return view('depense.edit', compact('depense', 'categories'));
    }

    // Mettre à jour une dépense existante
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'montant' => 'required|numeric|min:0',
            'categorie_id' => 'required|exists:categories,id',
            'description' => 'nullable|string|max:255',
            'objet' => 'nullable|string|max:255',
            'telephone' => 'nullable|string|max:20',
            'archiver' => 'nullable|boolean',
        ]);

        $validated['archiver'] = $request->has('archiver') ? true : false;

        $depense = Depense::findOrFail($id);
        $depense->update($validated);

        return redirect()->route('depenses.index')->with('success', 'Dépense mise à jour avec succès');
    }

    // Supprimer une dépense
    public function destroy($id)
    {
        $depense = Depense::findOrFail($id);
        $depense->delete();

        return redirect()->route('depenses.index')->with('success', 'Dépense supprimée avec succès');
    }

    // Archiver une dépense
    public function archiver($id)
    {
        $depense = Depense::findOrFail($id);
        $depense->archiver = true;
        $depense->save();

        return redirect()->route('listeDepense')->with('success', 'Dépense archiviée avec succès.');
    }

    // Afficher les détails d'une dépense
    public function show($id)
    {
        $depense = Depense::findOrFail($id);
        return view('gestion.showDepense', compact('depense'));
    }

    // Filtrer les dépenses
    public function filtrer(Request $request)
    {
        $filtre = $request->input('filter');
        $dateDebutInput = $request->input('date_debut');
        $dateFinInput = $request->input('date_fin');

        if (!$dateDebutInput || !$dateFinInput) {
            return back()->with('error', 'Veuillez fournir une date de début et une date de fin.');
        }

        $dateDebut = Carbon::parse($dateDebutInput)->startOfDay();
        $dateFin = Carbon::parse($dateFinInput)->endOfDay();

        if ($dateDebut->greaterThan($dateFin)) {
            return back()->with('error', 'La date de début doit être avant la date de fin.');
        }

        $depenses = Depense::with('categorie')->where('archiver', false)
            ->whereBetween('created_at', [$dateDebut, $dateFin]);

        // Filtrage selon le type (jour, semaine, mois, année)
        switch ($filtre) {
            case 'jour':
                $depenses->whereDate('created_at', $dateDebut);
                break;
            case 'semaine':
                $depenses->whereBetween('created_at', [
                    $dateDebut->copy()->startOfWeek(CarbonInterface::MONDAY),
                    $dateFin->copy()->endOfWeek(CarbonInterface::SUNDAY)
                ]);
                break;
            case 'mois':
                $depenses->whereMonth('created_at', $dateDebut->month)
                         ->whereYear('created_at', $dateDebut->year);
                break;
            case 'annee':
                $depenses->whereYear('created_at', $dateDebut->year);
                break;
            default:
                return back()->with('error', 'Veuillez choisir un filtre valide (jour, semaine, mois, année).');
        }

        // Récupérer les résultats filtrés
        $resultats = $depenses->get();

        return view('depense.resultats', compact('resultats'));
    }
}

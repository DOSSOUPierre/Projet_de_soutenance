<?php

namespace App\Http\Controllers;

use App\Models\Depense;
use App\Models\Categorie;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Carbon\CarbonInterface; // Ajouté pour l'utilisation des constantes de l'interface
use App\Notifications\DepenseEnregistreeNotification;

class DepenseController extends Controller
{
    // Affiche les dépenses non archivées
    public function index()
    {
        $depenses = Depense::with('categorie')->where('archiver', false)->get();
        $categories = Categorie::all();
        
        return view('depense.indexdepnse', compact('depenses', 'categories'));
    }

    // Affiche les dépenses archivées
    public function archivees()
    {
        $depenses = Depense::with('categorie')->where('archiver', true)->get();
        
        return view('depense.archiveesdepense', compact('depenses'));
    }

    // Formulaire pour créer une nouvelle dépense
    public function create()
    {
        $categories = Categorie::all();
        
        return view('depense.create', compact('categories'));
    }

    // Enregistrement d'une nouvelle dépense
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

        return redirect()->route('depenses.index')->with('success', 'Dépense ajoutée avec succès');
    }

    // Formulaire pour modifier une dépense
    public function edit($id)
    {
        $depense = Depense::findOrFail($id);
        $categories = Categorie::all();
        
        return view('depense.edit', compact('depense', 'categories'));
    }

    // Mise à jour d'une dépense
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

    // Suppression d'une dépense
    public function destroy($id)
    {
        $depense = Depense::findOrFail($id);
        $depense->delete();

        return redirect()->route('depenses.index')->with('success', 'Dépense supprimée avec succès');
    }

    // Archivage d'une dépense
    public function archiver($id)
    {
        $depense = Depense::findOrFail($id);
        $depense->archiver = true;
        $depense->save();

        return redirect()->route('depenses.index')->with('success', 'Dépense archivée avec succès.');
    }

    // Détails d'une dépense
    public function show($id)
    {
        $depense = Depense::findOrFail($id);
        
        return view('gestion.showDepense', compact('depense'));
    }

    // Filtrage des dépenses
    public function filtrer(Request $request)
    {
        $filtre = $request->input('filter');
        $dateInput = $request->input('date');

        if (!$dateInput) {
            return back()->with('error', 'Veuillez fournir une date pour le filtre.');
        }

        $date = Carbon::parse($dateInput);
        $depenses = Depense::with('categorie');

        switch ($filtre) {
            case 'jour':
                $depenses->whereDate('created_at', $date);
                break;
            case 'semaine':
                $depenses->whereBetween('created_at', [
                    $date->startOfWeek(CarbonInterface::MONDAY),
                    $date->endOfWeek(CarbonInterface::SUNDAY)
                ]);
                break;
            case 'mois':
                $depenses->whereMonth('created_at', $date->month)
                         ->whereYear('created_at', $date->year);
                break;
            case 'annee':
                $depenses->whereYear('created_at', $date->year);
                break;
        }

        $resultats = $depenses->where('archiver', false)->get();

        return view('depense.resultats', compact('resultats'));
    }
}

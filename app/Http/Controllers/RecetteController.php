<?php

namespace App\Http\Controllers;

use App\Models\Recette;
use App\Models\CategorieRecette;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Carbon\CarbonInterface;
use App\Notifications\RecetteEnregistreeNotification;

class RecetteController extends Controller
{
    // Affiche les recettes non archivées
    public function index()
    {
        $recettes = Recette::with('categorie')
            ->where('archiver', false)
            ->latest()
            ->paginate(10);

        $categories = CategorieRecette::all();

        return view('recette.indexrecette', compact('recettes', 'categories'));
    }

    // Affiche les recettes archivées
    public function archivees()
    {
        $recettes = Recette::with('categorie')
            ->where('archiver', true)
            ->latest()
            ->get();

        return view('recette.archiverecette', compact('recettes'));
    }

    // Affiche le formulaire de création
    public function create()
    {
        $categories = CategorieRecette::all();
        return view('recette.create', compact('categories'));
    }

    // Enregistre une nouvelle recette
    public function store(Request $request)
    {
        $validated = $request->validate([
            'description' => 'required|string|max:255',
            'objet' => 'required|string|max:255',
            'montant' => 'required|numeric|min:0',
            'telephone' => 'nullable|string|max:20',
            'categorie_id' => 'required|exists:categorie_recettes,id',
            'archiver' => 'nullable|boolean',
        ]);

        $validated['archiver'] = $request->has('archiver');

        $recette = Recette::create($validated);

        // Notifie l'administrateur s'il existe
        $admin = User::where('type', 'admin')->first();
        if ($admin) {
            $admin->notify(new RecetteEnregistreeNotification($recette));
        }

        return redirect()->route('listeRecette')->with('success', 'Recette ajoutée avec succès.');
    }

    // Affiche le formulaire d’édition
    public function edit($id)
    {
        $recette = Recette::findOrFail($id);
        $categories = CategorieRecette::all();

        return view('recette.edit', compact('recette', 'categories'));
    }

    // Met à jour une recette
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'description' => 'required|string|max:255',
            'objet' => 'required|string|max:255',
            'montant' => 'required|numeric|min:0',
            'telephone' => 'nullable|string|max:20',
            'categorie_id' => 'required|exists:categorie_recettes,id',
            'archiver' => 'nullable|boolean',
        ]);

        $validated['archiver'] = $request->has('archiver');

        $recette = Recette::findOrFail($id);
        $recette->update($validated);

        return redirect()->route('listeRecette')->with('success', 'Recette mise à jour avec succès.');
    }

    // Supprime une recette
    public function destroy($id)
    {
        $recette = Recette::findOrFail($id);
        $recette->delete();

        return redirect()->route('recettes.archivees')->with('success', 'Recette supprimée avec succès.');
    }

    // Archive une recette
    public function archiver($id)
    {
        $recette = Recette::findOrFail($id);
        $recette->archiver = true;
        $recette->save();

        return redirect()->route('listeRecette')->with('success', 'Recette archivée avec succès.');
    }

    // Affiche les détails d’une recette
    public function show($id)
    {
        $recette = Recette::findOrFail($id);
        return view('gestion.showRecette', compact('recette'));
    }

    // Filtrage des recettes par jour, semaine, mois ou année
    public function filtrer(Request $request)
    {
        $filtre = $request->input('filter');
        $dateInput = $request->input('date');

        if (!$dateInput) {
            return back()->with('error', 'Veuillez fournir une date pour le filtre.');
        }

        try {
            $date = Carbon::createFromFormat('Y-m-d', $dateInput);
        } catch (\Exception $e) {
            return back()->with('error', 'Format de date invalide. Utilisez AAAA-MM-JJ.');
        }

        $recettes = Recette::with('categorie')->where('archiver', false);

        switch ($filtre) {
            case 'jour':
                $recettes->whereDate('created_at', $date);
                break;
            case 'semaine':
                $recettes->whereBetween('created_at', [
                    $date->startOfWeek(CarbonInterface::MONDAY),
                    $date->endOfWeek(CarbonInterface::SUNDAY),
                ]);
                break;
            case 'mois':
                $recettes->whereMonth('created_at', $date->month)
                         ->whereYear('created_at', $date->year);
                break;
            case 'annee':
                $recettes->whereYear('created_at', $date->year);
                break;
        }

        $resultats = $recettes->get();

        return view('recette.resultats', compact('resultats'));
    }
}

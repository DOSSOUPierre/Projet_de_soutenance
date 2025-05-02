<?php

namespace App\Http\Controllers;

use App\Models\Depense;
use App\Models\CategorieDepense;
use App\Models\User;
use Illuminate\Http\Request;
use App\Notifications\DepenseEnregistreeNotification;

class DepenseController extends Controller
{
    // Afficher la liste des dépenses non archivées
    public function index()
    {
        // Récupère les dépenses avec leur catégorie, non archivées et triées par date décroissante
        $depenses = Depense::with('categorieDepense')
                        ->where('archiver', false) // Filtre les dépenses non archivées
                        ->latest() // Trie par date décroissante
                        ->paginate(10); // Pagination par 10

        // Récupère toutes les catégories de dépenses
        $categories = CategorieDepense::all();

        // Retourne la vue avec les données de dépenses et de catégories
        return view('depense.indexdepnse', compact('depenses', 'categories'));
    }

    // Afficher la liste des dépenses archivées
    public function archivees()
    {
        // Récupère les dépenses archivées, triées par date décroissante
        $depenses = Depense::with('categorieDepense')
                        ->where('archiver', true) // Filtre les dépenses archivées
                        ->latest() // Trie par date décroissante
                        ->paginate(10); // Pagination par 10

        // Retourne la vue avec les dépenses archivées
        return view('depense.archiveesdepense', compact('depenses'));
    }

    // Afficher le formulaire de création de dépense
    public function create()
    {
        // Récupère toutes les catégories de dépenses pour le formulaire
        $categories = CategorieDepense::all();

        // Retourne la vue du formulaire de création avec les catégories
        return view('depense.create', compact('categories'));
    }

    // Enregistrer une nouvelle dépense
    public function store(Request $request)
    {
        // Validation des données du formulaire
        $validated = $request->validate([
            'montant' => 'required|numeric|min:0', // Montant requis, numérique et positif
            'categorie_id' => 'required|exists:categorie_depenses,id', // Categorie_id doit exister dans la table categorie_depenses
            'description' => 'nullable|string|max:255', // Description optionnelle
            'objet' => 'nullable|string|max:255', // Objet optionnel
            'telephone' => 'nullable|string|max:20', // Numéro de téléphone optionnel
            'archiver' => 'nullable|boolean', // L'attribut archiver est optionnel et de type booléen
        ]);

        // Détermine si la dépense doit être archivée ou non
        $validated['archiver'] = $request->has('archiver') ? 1 : 0;

        // Crée la nouvelle dépense dans la base de données
        $depense = Depense::create($validated);

        // Récupère l'administrateur et lui envoie une notification concernant la nouvelle dépense
        $admin = User::where('type', 'admin')->first();
        if ($admin) {
            $admin->notify(new DepenseEnregistreeNotification($depense));
        }

        // Redirige vers la liste des dépenses avec un message de succès
        return redirect()->route('listeDepense')->with('success', 'Dépense ajoutée avec succès');
    }

    // Afficher le formulaire d'édition d'une dépense existante
    public function edit($id)
    {
        // Trouve la dépense par son ID et récupère toutes les catégories
        $depense = Depense::findOrFail($id);
        $categories = CategorieDepense::all();

        // Retourne la vue d'édition avec la dépense et les catégories
        return view('depense.edit', compact('depense', 'categories'));
    }

    // Mettre à jour les informations d'une dépense
    public function update(Request $request, $id)
    {
        // Validation des données du formulaire
        $validated = $request->validate([
            'montant' => 'required|numeric|min:0', // Montant requis, numérique et positif
            'categorie_id' => 'required|exists:categorie_depenses,id', // Categorie_id doit exister dans la table categorie_depenses
            'description' => 'nullable|string|max:255', // Description optionnelle
            'objet' => 'nullable|string|max:255', // Objet optionnel
            'telephone' => 'nullable|string|max:20', // Numéro de téléphone optionnel
            'archiver' => 'nullable|boolean', // L'attribut archiver est optionnel et de type booléen
        ]);

        // Détermine si la dépense doit être archivée ou non
        $validated['archiver'] = $request->has('archiver') ? true : false;

        // Trouve la dépense à mettre à jour et applique les modifications
        $depense = Depense::findOrFail($id);
        $depense->update($validated);

        // Redirige vers la liste des dépenses avec un message de succès
        return redirect()->route('depenses.index')->with('success', 'Dépense mise à jour avec succès');
    }

    // Supprimer une dépense existante
    public function destroy($id)
    {
        // Trouve la dépense à supprimer
        $depense = Depense::findOrFail($id);
        // Supprime la dépense de la base de données
        $depense->delete();

        // Redirige vers la liste des dépenses avec un message de succès
        return redirect()->route('depenses.index')->with('success', 'Dépense supprimée avec succès');
    }

    // Archiver une dépense
    public function archiver($id)
    {
        // Trouve la dépense et marque comme archivée
        $depense = Depense::findOrFail($id);
        $depense->archiver = true;
        $depense->save();

        // Redirige avec un message de succès
        return redirect()->route('listeDepense')->with('success', 'Dépense archivée avec succès.');
    }

    // Afficher les détails d'une dépense spécifique
    public function show($id)
    {
        // Trouve la dépense par son ID
        $depense = Depense::findOrFail($id);
        
        // Retourne la vue avec les détails de la dépense
        return view('gestion.showDepense', compact('depense'));
    }
    
}

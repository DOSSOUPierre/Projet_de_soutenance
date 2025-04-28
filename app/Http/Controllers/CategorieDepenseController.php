<?php

namespace App\Http\Controllers;

use App\Models\CategorieDepense;
use Illuminate\Http\Request;

class CategorieDepenseController extends Controller
{
    // Affiche la liste des catégories de dépenses
    public function index()
    {
        // Charge toutes les catégories de dépenses depuis la base de données avec tri par date décroissante (nouveaux en haut)
        $categories = CategorieDepense::latest()->paginate(10);  // Pagination par 10 éléments par page

        // Retourne la vue avec les données
        return view('depense.categoriesDepense', compact('categories'));
    }

    // Affiche le formulaire de création
    public function create()
    {
        return view('depense.categories.create');
    }

    // Enregistre une nouvelle catégorie
    public function store(Request $request)
    {
        // Validation des données
        $request->validate([
            'nom' => 'required|string|max:255|unique:categorie_depenses,nom', // Validation unique pour le nom
            'description' => 'nullable|string|max:500', // Description facultative
        ]);

        // Création de la catégorie
        CategorieDepense::create($request->all());

        // Redirige vers la liste des catégories avec un message de succès
        return redirect()->route('categories.index')->with('success', 'Catégorie créée avec succès');
    }

    // Affiche le formulaire d'édition
    public function edit(CategorieDepense $categorie)
    {
        return view('depense.edit', compact('categorie'));
    }

    // Met à jour une catégorie
    public function update(Request $request, CategorieDepense $categorie)
    {
        // Validation des données (en ignorant l'ID actuel)
        $request->validate([
            'nom' => 'required|string|max:255|unique:categorie_depenses,nom,' . $categorie->id, // Validation unique en ignorant l'ID actuel
            'description' => 'nullable|string|max:500',
        ]);

        // Mise à jour de la catégorie
        $categorie->update($request->all());

        return redirect()->route('categories.index')->with('success', 'Catégorie mise à jour avec succès');
    }

    // Supprime une catégorie
    public function destroy(CategorieDepense $categorie)
    {
        // Vérification si la catégorie est utilisée avant suppression
        if ($categorie->depenses()->count() > 0) {
            // Si la catégorie est liée à des dépenses, on ne peut pas la supprimer
            return redirect()->route('categories.index')->with('error', 'Cette catégorie est associée à des dépenses et ne peut être supprimée.');
        }

        // Suppression de la catégorie
        $categorie->delete();

        return redirect()->route('categories.index')->with('success', 'Catégorie supprimée avec succès');
    }
}

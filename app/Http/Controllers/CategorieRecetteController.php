<?php

namespace App\Http\Controllers;

use App\Models\CategorieRecette;
use Illuminate\Http\Request;

class CategorieRecetteController extends Controller
{
    // Affiche la liste des catégories de recettes
    public function index()
    {
        // Récupère toutes les catégories de recettes paginées, triées par date décroissante
        $categories = CategorieRecette::latest()->paginate(10);  // 10 résultats par page

        // Retourne la vue avec les données des catégories
        return view('recette.categoriesRecette', compact('categories'));
    }

    // Affiche le formulaire de création d'une catégorie
    public function create()
    {
        // Il n'est pas nécessaire de passer la variable 'categories' ici
        return view('recette.categoriesRecette');
    }

    // Enregistre une nouvelle catégorie
    public function store(Request $request)
    {
        // Validation des données du formulaire
        $validatedData = $request->validate([
            'nom' => 'required|string|max:255|unique:categorie_recettes,nom', // Validation unique pour le nom
            'description' => 'nullable|string|max:500', // Description facultative
        ]);

        // Création de la nouvelle catégorie
        CategorieRecette::create($validatedData);

        // Redirige vers la liste des catégories avec un message de succès
        return redirect()->route('categories_recette.index')->with('success', 'Catégorie de recette créée avec succès');
    }

    // Affiche le formulaire d'édition d'une catégorie
    public function edit(CategorieRecette $categorie)
    {
        return view('recette.categories.edit', compact('categorie'));
    }

    // Met à jour une catégorie de recette
    public function update(Request $request, CategorieRecette $categorie)
    {
        // Validation des données, en ignorant l'ID actuel pour l'unicité
        $validatedData = $request->validate([
            'nom' => 'required|string|max:255|unique:categorie_recettes,nom,' . $categorie->id,
            'description' => 'nullable|string|max:500',
        ]);

        // Mise à jour de la catégorie
        $categorie->update($validatedData);

        // Redirige vers la liste des catégories avec un message de succès
        return redirect()->route('categories_recette.index')->with('success', 'Catégorie mise à jour avec succès');
    }

    // Supprime une catégorie de recette
    public function destroy(CategorieRecette $categorie)
    {
        // Vérifie si la catégorie est utilisée avant suppression
        if ($categorie->recettes()->count() > 0) {
            return redirect()->route('categories_recette.index')->with('error', 'Cette catégorie est associée à des recettes et ne peut être supprimée.');
        }

        // Suppression de la catégorie
        $categorie->delete();

        // Redirige vers la liste des catégories avec un message de succès
        return redirect()->route('categories_recette.index')->with('success', 'Catégorie supprimée avec succès');
    }
}

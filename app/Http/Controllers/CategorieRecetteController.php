<?php
namespace App\Http\Controllers;

use App\Models\CategorieRecette;
use Illuminate\Http\Request;

class CategorieRecetteController extends Controller
{
    // Affiche la liste des catégories de recettes
    public function index()
    {
        $categories = CategorieRecette::latest()->paginate(10);
        return view('recette.categoriesRecette', compact('categories'));
    }

    // Affiche le formulaire de création d'une catégorie
    public function create()
    {
        return view('recette.categoriesRecette');
    }

    // Enregistre une nouvelle catégorie
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nom' => 'required|string|max:255|unique:categorie_recettes,nom',
        ], [
            'nom.unique' => 'Cette catégorie existe déjà.',
        ]);        

        CategorieRecette::create($validatedData);

        return redirect()->route('categories_recette.index')->with('success', 'Catégorie de recette créée avec succès');
    }

    // Affiche le formulaire d'édition d'une catégorie
    public function edit(CategorieRecette $categorie)
    {
        return view('recette.edit', compact('categorie'));
    }

    // Met à jour une catégorie de recette
    public function update(Request $request, CategorieRecette $categorie)
    {
        // Validation des données
        $request->validate([
            'nom' => 'required|string|max:255|unique:categorie_recettes,nom,' . $categorie->id,
        ], [
            'nom.unique' => 'Cette catégorie existe déjà.',
        ]);
        
            
        // Mise à jour de la catégorie
        $categorie->update($request->only('nom'));

        return redirect()->route('categories_recette.index')->with('success', 'Catégorie mise à jour avec succès!');
    }

    // Supprime une catégorie de recette
    public function destroy(CategorieRecette $categorie)
    {
        if ($categorie->recettes()->count() > 0) {
            return redirect()->route('categories_recette.index')->with('error', 'Cette catégorie est associée à des recettes et ne peut être supprimée.');
        }

        $categorie->delete();

        return redirect()->route('categories_recette.index')->with('success', 'Catégorie supprimée avec succès');
    }
}

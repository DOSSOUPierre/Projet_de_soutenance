<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserAuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RecetteController;
use App\Http\Controllers\DepenseController;
use App\Http\Controllers\CategorieDepenseController;
use App\Http\Controllers\CategorieRecetteController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\VisualisationController;
use App\Http\Controllers\RapportController;
use App\Http\Controllers\RapportArchiveController;

use App\Http\Controllers\DashboardController;

Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');


// ✅ Envoi du rapport
Route::get('/envoyer-rapport', [RapportArchiveController::class, 'envoyerRapport'])->name('envoyer.rapport');
Route::get('/archives/pdf', [RapportArchiveController::class, 'envoyerRapport'])->name('archives.pdf');

// ✅ Formulaire création utilisateur
Route::get('create-user-form', [UserAuthController::class, 'createUserForm'])->name('utilisateur.create');
Route::post('create-user', [UserAuthController::class, 'store'])->name('utilisateur.store');

// ✅ Page d’accueil
Route::get('/', function () {
    return view('welcome');
});

// ✅ Dashboard
Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');

// ✅ Authentification : réinitialisation
Route::get('password/reset', [PasswordResetLinkController::class, 'create'])->name('password.request');
Route::post('password/reset', [PasswordResetLinkController::class, 'store'])->name('password.email');
Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])->name('password.reset');
Route::post('reset-password', [NewPasswordController::class, 'store'])->name('password.update');

// ✅ Connexion
Route::get('/login', [UserAuthController::class, 'login'])->name('login');
Route::post('/login', [UserAuthController::class, 'loginSave'])->name('login.save');

// ✅ Déconnexion et gestion du profil pour utilisateurs connectés
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [UserAuthController::class, 'index'])->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::post('/logout', [UserAuthController::class, 'logout'])->name('logout');

    // ✅ Routes Catégories Dépenses
    Route::get('/categories', [CategorieDepenseController::class, 'index'])->name('categories.index');
    Route::get('/categories/create', [CategorieDepenseController::class, 'create'])->name('categories.create');
    Route::post('/categories', [CategorieDepenseController::class, 'store'])->name('categories.store');
    Route::get('/categories/{categorie}/edit', [CategorieDepenseController::class, 'edit'])->name('categories.edit');
    Route::put('/categories/{categorie}', [CategorieDepenseController::class, 'update'])->name('categories.update');
    Route::delete('/categories/{categorie}', [CategorieDepenseController::class, 'destroy'])->name('categories.destroy');
    Route::post('/depense/categories/check-nom', [CategorieDepenseController::class, 'checkNom'])->name('categories.checkNom');

    // ✅ Routes Catégories Recettes
    Route::get('/categories-recette', [CategorieRecetteController::class, 'index'])->name('categories_recette.index');
    Route::post('/recette/categories/create', [CategorieRecetteController::class, 'create'])->name('categories_recette.create');
    Route::post('/recette/categories', [CategorieRecetteController::class, 'store'])->name('categories_recette.store');
    Route::get('/recette/categories/{id}', [CategorieRecetteController::class, 'show'])->name('categories_recette.show');
    Route::get('/recette/categories/{id}/edit', [CategorieRecetteController::class, 'edit'])->name('categories_recette.edit');
    Route::put('/recette/categories/{id}', [CategorieRecetteController::class, 'update'])->name('categories_recette.update');
    Route::delete('/recette/categories/{id}', [CategorieRecetteController::class, 'destroy'])->name('categories_recette.destroy');

    // ✅ Visualisation
    Route::get('/visualisation', [VisualisationController::class, 'visualiser'])->name('visualisation');
});

// ✅ Admin uniquement
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/utilisateurs', [UserAuthController::class, 'liste'])->name('utilisateurs.liste');
    Route::get('/utilisateurs/{id}', [UserAuthController::class, 'details'])->where('id', '[0-9]+')->name('utilisateurs.details');
    Route::get('/utilisateurs/{id}/edit', [UserAuthController::class, 'edit'])->where('id', '[0-9]+')->name('utilisateurs.edit');
    Route::put('/utilisateurs/{id}', [UserAuthController::class, 'update'])->where('id', '[0-9]+')->name('utilisateurs.update');
    Route::delete('/utilisateurs/{id}', [UserAuthController::class, 'delete'])->where('id', '[0-9]+')->name('utilisateurs.delete');

    Route::get('/admin/create', [RegisteredUserController::class, 'create'])->name('utilisateur.create');
    Route::post('/admin/create', [RegisteredUserController::class, 'store'])->name('utilisateur.store');
});

// ✅ Routes création utilisateur
Route::get('create-user-form', [UserAuthController::class, 'createUserForm'])->name('utilisateur.create');
Route::post('create-user', [UserAuthController::class, 'store'])->name('utilisateur.store');

// ✅ Routes Recettes
Route::get('/recette', [RecetteController::class, 'index'])->name('listeRecette');
Route::post('/recette', [RecetteController::class, 'store'])->name('recettes.store');
Route::get('/recette/{id}/edit', [RecetteController::class, 'edit'])->name('recette.edit');
Route::put('/recette/{id}', [RecetteController::class, 'update'])->name('recette.update');
Route::delete('/recette/{id}', [RecetteController::class, 'destroy'])->name('recettes.destroy');
Route::get('/recette/filtrer', [RecetteController::class, 'filtrer'])->name('recettes.filtrer');
Route::get('/recette/{id}', [RecetteController::class, 'show'])->name('recettes.show');
Route::get('/recettes/archivees', [RecetteController::class, 'archivees'])->name('recettes.archivees');
Route::put('/recette/{id}/archiver', [RecetteController::class, 'archiver'])->name('recette.archiver');

// ✅ Routes Dépenses
Route::get('/depense', [DepenseController::class, 'index'])->name('listeDepense');
Route::post('/depense', [DepenseController::class, 'store'])->name('depenses.store');
Route::get('/depense/{id}/edit', [DepenseController::class, 'edit'])->name('depense.edit');
Route::put('/depense/{id}', [DepenseController::class, 'update'])->name('depense.update');
Route::delete('/depense/{id}', [DepenseController::class, 'destroy'])->name('depenses.destroy');
Route::get('/depenses/filtrer', [DepenseController::class, 'filtrer'])->name('depenses.filtrer');
Route::get('/depense/{id}', [DepenseController::class, 'show'])->name('depense.show');
Route::get('/depenses/archivees', [DepenseController::class, 'archivees'])->name('depenses.archivees');
Route::put('/depenses/{id}/archiver', [DepenseController::class, 'archiver'])->name('depenses.archiver');

// ✅ Routes Rapports
Route::get('/rapport/pdf', [RapportController::class, 'generer'])->name('rapport.pdf');
Route::get('/rapport-litterature-pdf', [RapportController::class, 'literaturePDF'])->name('rapport.litterature.pdf');

// ✅ Archives Rapports
Route::get('/envoyer-rapport', [RapportArchiveController::class, 'envoyerRapport'])->name('envoyer.rapport');
Route::get('/archives/pdf', [RapportArchiveController::class, 'envoyerRapport'])->name('archives.pdf');

// ✅ Routes Laravel Breeze
require __DIR__.'/auth.php';

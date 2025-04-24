<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserAuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RecetteController;
use App\Http\Controllers\DepenseController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\VisualisationController;

use App\Http\Controllers\RapportController;

// Page d’accueil
Route::get('/', function () {
    return view('welcome');
});

// Formulaire de demande de lien de réinitialisation
Route::get('password/reset', [PasswordResetLinkController::class, 'create'])->name('password.request');
Route::post('password/reset', [PasswordResetLinkController::class, 'store'])->name('password.email');

// Réinitialisation du mot de passe
Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])->name('password.reset');
Route::post('reset-password', [NewPasswordController::class, 'store'])->name('password.update');

// Connexion
Route::get('/login', [UserAuthController::class, 'login'])->name('login');
Route::post('/login', [UserAuthController::class, 'loginSave'])->name('login.save');

// Routes pour utilisateurs connectés
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [UserAuthController::class, 'index'])->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::post('/logout', [UserAuthController::class, 'logout'])->name('logout');
});

// Routes pour admins uniquement
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/utilisateurs', [UserAuthController::class, 'liste'])->name('utilisateurs.liste');
    Route::get('/utilisateurs/{id}', [UserAuthController::class, 'details'])->where('id', '[0-9]+')->name('utilisateurs.details');
    Route::get('/utilisateurs/{id}/edit', [UserAuthController::class, 'edit'])->where('id', '[0-9]+')->name('utilisateurs.edit');
    Route::put('/utilisateurs/{id}', [UserAuthController::class, 'update'])->where('id', '[0-9]+')->name('utilisateurs.update');
    Route::delete('/utilisateurs/{id}', [UserAuthController::class, 'delete'])->where('id', '[0-9]+')->name('utilisateurs.delete');

    Route::get('/admin/create', [RegisteredUserController::class, 'create'])->name('utilisateur.create');
    Route::post('/admin/create', [RegisteredUserController::class, 'store'])->name('utilisateur.store');
});

// Routes Recettes
Route::get('/recette', [RecetteController::class, 'index'])->name('listeRecette');
Route::post('/recette', [RecetteController::class, 'store'])->name('recettes.store');
Route::get('/recette/{id}/edit', [RecetteController::class, 'edit'])->name('recette.edit');
Route::put('/recette/{id}', [RecetteController::class, 'update'])->name('recette.update');
Route::delete('/recette/{id}', [RecetteController::class, 'destroy'])->name('recettes.destroy');
Route::get('/recette/filtrer', [RecetteController::class, 'filtrer'])->name('recettes.filtrer');
Route::get('/recette/{id}', [RecetteController::class, 'show'])->name('recettes.show');
Route::get('/recettes/archivees', [RecetteController::class, 'archivees'])->name('recettes.archivees');
Route::put('/recette/{id}/archiver', [RecetteController::class, 'archiver'])->name('recette.archiver');

// Routes Dépenses
Route::get('/depense', [DepenseController::class, 'index'])->name('listeDepense');
Route::post('/depense', [DepenseController::class, 'store'])->name('depenses.store');
Route::get('/depense/{id}/edit', [DepenseController::class, 'edit'])->name('depense.edit');
Route::put('/depense/{id}', [DepenseController::class, 'update'])->name('depense.update');
Route::delete('/depense/{id}', [DepenseController::class, 'destroy'])->name('depenses.destroy');
Route::get('/depenses/filtrer', [DepenseController::class, 'filtrer'])->name('depenses.filtrer');
Route::get('/depense/{id}', [DepenseController::class, 'show'])->name('depense.show');
Route::get('/depenses/archivees', [DepenseController::class, 'archivees'])->name('depenses.archivees');
Route::put('/depenses/{id}/archiver', [DepenseController::class, 'archiver'])->name('depenses.archiver');

// Route de visualisation
Route::middleware('auth')->group(function () {
    Route::get('/visualisation', [VisualisationController::class, 'visualiser'])->name('visualisation');
});


Route::get('/rapport/pdf', [RapportController::class, 'generer'])->name('rapport.pdf');

Route::get('/rapport-litterature-pdf', [App\Http\Controllers\RapportController::class, 'literaturePDF'])->name('rapport.litterature.pdf');


// Routes Breeze pour l'authentification
require __DIR__.'/auth.php';
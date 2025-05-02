@extends('layouts.master')

@section('contenu')
<div class="container py-5">

    <!-- Bouton retour -->
    <a href="{{ route('dashboard') }}" class="btn btn-primary mb-4">
        <i class="fas fa-home me-2"></i> Retour à l’accueil
    </a>

    <!-- En-tête -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="fw-bold text-primary">Liste des Recettes</h2>
        <div>
        
            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#ajouterRecetteModal">
                <i class="fas fa-plus me-2"></i> Ajouter une Recette
            </button> 
        </div>
    </div>

    <!-- Tableau principal -->
    <div class="card shadow">
        <div class="card-body p-0">
            <table class="table table-bordered table-hover m-0 text-center align-middle">
                <thead class="table-primary text-uppercase">
                    <tr>
                        <th>#</th>
                        <th>Description</th>
                        <th>Objet</th>
                        <th>Montant</th>
                        <th>Téléphone</th>
                        <th>Catégorie</th>
                        <th>Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($recettes as $index => $recette)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>
                            <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#descriptionModal" data-description="{{ $recette->description }}">
                                <i class="fas fa-eye"></i> 
                            </button>
                        </td>
                        <td>{{ $recette->objet }}</td>
                        <td class="text-success fw-bold">{{ number_format($recette->montant, 2) }} FCFA</td>
                        <td>{{ $recette->telephone }}</td>
                        <td>{{ $recette->categorie->nom }}</td>
                        <td>{{ $recette->created_at->locale('fr')->isoFormat('dddd, D MMMM YYYY à HH:mm') }}</td>
                        <td>
                            {{-- <div class="d-flex gap-2"> --}}
                                {{-- <a href="{{ route('recettes.show', $recette->id) }}" class="btn btn-info btn-sm" title="Voir">
                                    <i class="fas fa-eye"></i> Voir
                                </a> --}}
                                <form action="{{ route('recette.archiver', $recette->id) }}" method="POST" onsubmit="return confirm('Voulez-vous vraiment supprimer cette recette ?')">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        <i class="fas fa-archive"></i> 
                                    </button>
                                    
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- MODAL AJOUT RECETTE -->
    <div class="modal fade" id="ajouterRecetteModal" tabindex="-1" aria-labelledby="ajouterRecetteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form method="POST" action="{{ route('recettes.store') }}">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Ajouter une Recette</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea name="description" id="description" class="form-control" rows="3" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="objet" class="form-label">Objet</label>
                            <input type="text" name="objet" id="objet" class="form-control" required>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="montant" class="form-label">Montant (FCFA)</label>
                                <input type="number" step="0.01" name="montant" id="montant" class="form-control" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="telephone" class="form-label">Téléphone</label>
                                <input type="text" name="telephone" id="telephone" class="form-control" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="categorie_id" class="form-label">Catégorie</label>
                            <select name="categorie_id" id="categorie_id" class="form-select" required>
                                <option value="">Choisissez une catégorie</option>
                                @foreach($categories as $categorie)
                                    <option value="{{ $categorie->id }}">{{ $categorie->nom }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-success">Enregistrer</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- MODAL DESCRIPTION -->
    <div class="modal fade" id="descriptionModal" tabindex="-1" aria-labelledby="descriptionModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Description de la Recette</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                </div>
                <div class="modal-body">
                    <p id="descriptionText" style="max-height: 200px; overflow-y: auto;"></p>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection

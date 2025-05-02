@extends('layouts.master')

@section('contenu')
<style>
    .table {
        border-collapse: collapse;
    }

    .table th, .table td {
        vertical-align: middle;
        padding: 0.2rem 0.3rem; /* Réduction uniforme */
        white-space: nowrap; /* Empêche le retour à la ligne */
    }

    /* Colonne Numéro */
    .table th:nth-child(1),
    .table td:nth-child(1) {
        width: 40px;
        text-align: center;
    }

    /* Colonne Nom */
    .table th:nth-child(2),
    .table td:nth-child(2) {
        width: 180px;
    }

    /* Colonne Date de création */
    .table th:nth-child(3),
    .table td:nth-child(3) {
        width: 200px;
    }

    /* Colonne Actions */
    .table th:nth-child(4),
    .table td:nth-child(4),
    .table td.text-end,
    .table th.text-end {
        width: 120px;
        text-align: right;
        white-space: nowrap;
    }

    .btn i {
        margin-right: 4px;
    }

    .card-header-custom {
        background-color: #28a745;
        color: white;
        padding: 1rem;
        font-size: 1.25rem;
        border-bottom: 1px solid #dee2e6;
    }
</style>

<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="text-success">
            <i class="fa fa-tags me-2"></i>Catégories de Recettes
        </h2>
        <a href="{{ route('listeRecette') }}" class="btn btn-outline-primary btn-sm btn-nav">
            <i class="fa fa-arrow-right"></i> Aller aux Recette
        </a>
        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#ajouterCategorieModal">
            <i class="fa fa-plus"></i> Nouvelle Catégorie
        </button>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow-sm">
        <div class="card-header-custom">
            Liste des catégories enregistrées
        </div>
        <div class="card-body p-0">
            <table class="table table-hover mb-0">
                <thead class="table-success">
                    <tr>
                        <th>#</th>
                        <th>Nom</th>
                        <th>Date de création</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($categories as $categorie)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $categorie->nom }}</td>
                            <td>{{ $categorie->created_at->locale('fr')->isoFormat('dddd D MMMM YYYY à HH:mm') }}</td>
                            <td class="text-end">
                                <a href="{{ route('categories_recette.edit', $categorie->id) }}" class="btn btn-warning btn-sm me-1">
                                    <i class="fa fa-edit"></i>
                                </a>                                
                                <form action="{{ route('categories_recette.destroy', $categorie->id) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Supprimer cette catégorie ?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm">
                                        <i class="fa fa-trash"></i> 
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted">Aucune catégorie trouvée.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Ajouter -->
<div class="modal fade" id="ajouterCategorieModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('categories_recette.store') }}" method="POST">
                @csrf
                <div class="mb-3 p-3">
                    <label for="nom" class="form-label">Nom</label>
                    <input type="text" name="nom" class="form-control @error('nom') is-invalid @enderror" value="{{ old('nom') }}" required>
                    @error('nom')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-success">Ajouter</button>
                </div>
            </form>
        </div>
    </div>
</div>

@if ($errors->any())
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var modal = new bootstrap.Modal(document.getElementById('ajouterCategorieModal'));
        modal.show();
    });
</script>
@endif

@endsection

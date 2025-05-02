@extends('layouts.master')

@section('contenu')
<style>
    .table th, .table td {
        vertical-align: middle;
        padding: 0.2rem 0.25rem;
        font-size: 0.9rem;
        white-space: nowrap;
    }

    .table-responsive {
        max-width: 100%;
        margin: 0 auto;
    }

    .table th:nth-child(1), .table td:nth-child(1) {
        width: 5%;
    }

    .table th:nth-child(2), .table td:nth-child(2) {
        width: 40%;
    }

    .table th:nth-child(3), .table td:nth-child(3) {
        width: 35%;
    }

    .table th:nth-child(4), .table td:nth-child(4) {
        width: 20%;
    }

    .btn-sm {
        padding: 0.2rem 0.5rem;
        font-size: 0.75rem;
    }

    .btn-nav {
        font-size: 0.8rem;
    }
</style>

<div class="container mt-3">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="text-primary">
            <i class="fa fa-tags me-2"></i>Catégories de Dépenses
        </h2>
        <div class="d-flex gap-2">
            <a href="{{ route('listeDepense') }}" class="btn btn-outline-primary btn-sm btn-nav">
                <i class="fa fa-arrow-right"></i> Aller aux Dépenses
            </a>
            <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#ajouterCategorieModal">
                <i class="fa fa-plus"></i> Nouvelle Catégorie
            </button>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="card shadow-sm">
        <div class="card-header-custom">Liste des catégories enregistrées</div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-primary">
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
                                <td>{{ $categorie->created_at ? $categorie->created_at->format('d/m/Y H:i') : 'N/A' }}</td>
                                <td class="text-end">
                                    <a href="{{ route('categories.edit', $categorie->id) }}" class="btn btn-warning btn-sm">
                                        <i class="fa fa-edit"></i>
                                    </a>

                                    <form action="{{ route('categories.destroy', $categorie->id) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Supprimer cette catégorie ?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm" title="Supprimer">
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
</div>

<!-- Modal Ajouter -->
<div class="modal fade" id="ajouterCategorieModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('categories.store') }}" method="POST">
                @csrf
                <div class="mb-3">
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

@endsection

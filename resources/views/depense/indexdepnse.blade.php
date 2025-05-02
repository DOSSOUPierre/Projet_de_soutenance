@extends('layouts.master')

@section('contenu')
<div class="container py-5">

    <!-- Bouton retour -->
    <a href="{{ route('dashboard') }}" class="btn btn-primary mb-4">
        <i class="fas fa-home me-2"></i> Retour à l’accueil
    </a>

    <!-- Alerte de succès -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fermer"></button>
        </div>
    @endif

    <!-- En-tête -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="fw-bold text-primary">Liste des Dépenses</h2>
        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#ajouterDepenseModal">
            <i class="fas fa-plus me-2"></i> Ajouter une Dépense
        </button>
    </div>

    <!-- Tableau des dépenses -->
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
                    @foreach($depenses as $index => $depense)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>
                            <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#descriptionModal" data-description="{{ $depense->description }}">
                                <i class="fas fa-eye"></i> 
                            </button>
                        </td>
                        <td>{{ $depense->objet }}</td>
                        <td class="text-success fw-bold">{{ number_format($depense->montant, 2) }} FCFA</td>
                        <td>{{ $depense->telephone }}</td>
                        <td>{{ $depense->categorieDepense ? $depense->categorieDepense->nom : 'Aucune catégorie' }}</td>
                        <td>{{ $depense->created_at->locale('fr')->isoFormat('dddd, D MMMM YYYY à HH:mm') }}</td>
                        <td>
                            {{-- <div class="d-flex gap-2"> --}}
                                {{-- <a href="{{ route('depense.show', $depense->id) }}" class="btn btn-info btn-sm" title="Voir">
                                    <i class="fas fa-eye"></i> 
                                </a> --}}
                                <form action="{{ route('depenses.archiver', $depense->id) }}" method="POST" onsubmit="return confirm('Voulez-vous vraiment supprimer cette dépense ?')">
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

    <!-- MODAL DESCRIPTION -->
    <div class="modal fade" id="descriptionModal" tabindex="-1" aria-labelledby="descriptionModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Description de la Dépense</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                </div>
                <div class="modal-body">
                    <p id="descriptionText" style="max-height: 200px; overflow-y: auto; word-wrap: break-word; font-size: 14px; line-height: 1.6;"></p>
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL AJOUTER UNE DÉPENSE -->
    <div class="modal fade" id="ajouterDepenseModal" tabindex="-1" aria-labelledby="ajouterDepenseModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ajouterDepenseModalLabel">Ajouter une Dépense</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('depenses.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="objet" class="form-label">Objet</label>
                            <input type="text" class="form-control" id="objet" name="objet" required>
                        </div>
                        <div class="mb-3">
                            <label for="montant" class="form-label">Montant</label>
                            <input type="number" step="0.01" class="form-control" id="montant" name="montant" required>
                        </div>
                        <div class="mb-3">
                            <label for="telephone" class="form-label">Téléphone</label>
                            <input type="text" class="form-control" id="telephone" name="telephone">
                        </div>
                        <div class="mb-3">
                            <label for="categorie_id" class="form-label">Catégorie</label>
                            <select class="form-control" id="categorie_id" name="categorie_id" required>
                                <option value="">Choisir une Catégorie</option>
                                @foreach($categories as $categorie)
                                    <option value="{{ $categorie->id }}">{{ $categorie->nom }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                        </div>
                        <button type="submit" class="btn btn-success w-100">Ajouter</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function setDescription(description) {
            var formattedDescription = description.replace(/\n/g, "<br>");
            document.getElementById('descriptionText').innerHTML = formattedDescription;
        }
    </script>
</div>
@endsection

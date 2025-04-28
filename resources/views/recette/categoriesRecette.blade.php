@extends('layouts.master')

@section('contenu')
<style>
    .table th, .table td {
        vertical-align: middle;
        padding: 0.75rem;
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
                        <th>Description</th>
                        <th>Date de création</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($categories as $categorie)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $categorie->nom }}</td>
                            <td>{{ $categorie->description }}</td>
                            <td>{{ $categorie->created_at->locale('fr')->isoFormat('dddd, D MMMM YYYY à HH:mm')  }}</td>
                            <td class="text-end">
                                
                                <!-- Modifier -->
                                <a href="javascript:void(0);" class="btn btn-warning btn-sm me-1" title="Modifier"
                                    data-bs-toggle="modal"
                                    data-bs-target="#modifierCategorieModal"
                                    data-id="{{ $categorie->id }}"
                                    data-nom="{{ $categorie->nom }}"
                                    data-description="{{ $categorie->description }}">
                                    <i class="fa fa-edit"></i> Modifier
                                </a>

                                <!-- Supprimer -->
                                <form action="{{ route('categories_recette.destroy', $categorie->id) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Supprimer cette catégorie ?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm" title="Supprimer">
                                        <i class="fa fa-trash"></i> Supprimer
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted">Aucune catégorie trouvée.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Ajouter -->
<div class="modal fade" id="ajouterCategorieModal" tabindex="-1" aria-labelledby="ajouterCategorieModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('categories_recette.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="nom" class="form-label">Nom</label>
                        <input type="text" name="nom" id="nom" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea name="description" id="description" class="form-control" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-success">Ajouter</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Voir -->
<div class="modal fade" id="voirCategorieModal" tabindex="-1" aria-labelledby="voirCategorieModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Détails de la catégorie</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p><strong>Nom:</strong> <span id="voirNom"></span></p>
                <p><strong>Description:</strong> <span id="voirDescription"></span></p>
                <p><strong>Date de création:</strong> <span id="voirDate"></span></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Modifier -->
<div class="modal fade" id="modifierCategorieModal" tabindex="-1" aria-labelledby="modifierCategorieModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="modifierCategorieForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title">Modifier la catégorie</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="categorieId" name="id">
                    <div class="mb-3">
                        <label for="modifierNom" class="form-label">Nom</label>
                        <input type="text" class="form-control" id="modifierNom" name="nom" required>
                    </div>
                    <div class="mb-3">
                        <label for="modifierDescription" class="form-label">Description</label>
                        <textarea class="form-control" id="modifierDescription" name="description" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-success">Modifier</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    // Voir
    var voirModal = document.getElementById('voirCategorieModal');
    voirModal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget;
        document.getElementById('voirNom').textContent = button.getAttribute('data-nom');
        document.getElementById('voirDescription').textContent = button.getAttribute('data-description');
        document.getElementById('voirDate').textContent = button.getAttribute('data-date');
    });

    // Modifier
    var modifierModal = document.getElementById('modifierCategorieModal');
    modifierModal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget;
        var id = button.getAttribute('data-id');
        document.getElementById('modifierCategorieForm').action = '/categories_recette/' + id;
        document.getElementById('modifierNom').value = button.getAttribute('data-nom');
        document.getElementById('modifierDescription').value = button.getAttribute('data-description');
    });

    // Soumission AJAX
    $('#modifierCategorieForm').on('submit', function (e) {
        e.preventDefault();
        var form = $(this);
        $.ajax({
            url: form.attr('action'),
            method: 'POST',
            data: form.serialize(),
            success: function (response) {
                alert(response.success || 'Catégorie mise à jour avec succès.');
                $('#modifierCategorieModal').modal('hide');
                location.reload();
            },
            error: function () {
                alert('Erreur lors de la mise à jour.');
            }
        });
    });
</script>
@endpush

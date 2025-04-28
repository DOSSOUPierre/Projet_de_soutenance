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
        background-color: #007bff;
        color: white;
        padding: 1rem;
        font-size: 1.25rem;
        border-bottom: 1px solid #dee2e6;
    }
</style>

<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="text-primary">
            <i class="fa fa-tags me-2"></i>Catégories de Dépenses
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
                <thead class="table-primary">
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
                            <td>{{ $categorie->created_at ? $categorie->created_at->format('d/m/Y H:i') : 'N/A' }}</td>

                            <td class="text-end">
                            
                                <!-- Modifier -->
                                <a href="{{ route('categories.edit', $categorie->id) }}" class="btn btn-warning btn-sm">
                                    <i class="fa fa-edit"></i> 
                                </a>
                            
                                <!-- Supprimer -->
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
                            <td colspan="5" class="text-center text-muted">Aucune catégorie trouvée.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Ajouter Catégorie -->
<div class="modal fade" id="ajouterCategorieModal" tabindex="-1" aria-labelledby="ajouterCategorieModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ajouterCategorieModalLabel">Ajouter une nouvelle catégorie</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('categories.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="nom" class="form-label">Nom</label>
                        <input type="text" class="form-control" id="nom" name="nom" required>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" name="description" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-primary">Ajouter</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Voir Catégorie -->
<div class="modal fade" id="voirCategorieModal" tabindex="-1" aria-labelledby="voirCategorieModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="voirCategorieModalLabel">Détails de la catégorie</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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

<!-- Modal Modifier Catégorie -->
<!-- Modal Modifier Catégorie -->
<div class="modal fade" id="modifierCategorieModal" tabindex="-1" aria-labelledby="modifierCategorieModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modifierCategorieModalLabel">Modifier la catégorie</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="modifierCategorieForm">
                @csrf
                @method('PUT')
                <div class="modal-body">
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
                    <button type="submit" class="btn btn-primary">Modifier</button>
                </div>
            </form>
        </div>
    </div>
</div>


@endsection

@push('scripts')
<script>
    // Préparer les données pour la modale de modification
    var modifierModal = document.getElementById('modifierCategorieModal');
    modifierModal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget; // Bouton qui a déclenché la modale
        var id = button.getAttribute('data-id');
        var nom = button.getAttribute('data-nom');
        var description = button.getAttribute('data-description');

        // Mettre à jour l'URL du formulaire avec l'ID de la catégorie
        var form = document.getElementById('modifierCategorieForm');
        form.action = '/categories/' + id; // L'URL doit inclure l'ID de la catégorie

        // Remplir les champs avec les données de la catégorie
        document.getElementById('modifierNom').value = nom;
        document.getElementById('modifierDescription').value = description;
    });

    // Préparer les données pour la modale de "Voir"
    var voirModal = document.getElementById('voirCategorieModal');
    voirModal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget; // Bouton qui a déclenché la modale
        var nom = button.getAttribute('data-nom');
        var description = button.getAttribute('data-description');
        var date = button.getAttribute('data-date');

        // Mettre à jour la modale avec les données de la catégorie
        document.getElementById('voirNom').textContent = nom;
        document.getElementById('voirDescription').textContent = description;
        document.getElementById('voirDate').textContent = date;
    });
    // Préparer les données pour la modale de modification
var modifierModal = document.getElementById('modifierCategorieModal');
modifierModal.addEventListener('show.bs.modal', function (event) {
    var button = event.relatedTarget; // Bouton qui a déclenché la modale
    var id = button.getAttribute('data-id');
    var nom = button.getAttribute('data-nom');
    var description = button.getAttribute('data-description');

    // Mettre à jour l'URL du formulaire avec l'ID de la catégorie
    var form = document.getElementById('modifierCategorieForm');
    form.action = '/categories/' + id; // L'URL doit inclure l'ID de la catégorie

    // Remplir les champs avec les données de la catégorie
    document.getElementById('modifierNom').value = nom;
    document.getElementById('modifierDescription').value = description;
});

// Soumission AJAX du formulaire
$('#modifierCategorieForm').on('submit', function (e) {
    e.preventDefault();

    var formData = $(this).serialize(); // Sérialiser les données du formulaire

    $.ajax({
        url: $(this).attr('action'),
        method: 'PUT',
        data: formData,
        success: function (response) {
            alert(response.success);
            $('#modifierCategorieModal').modal('hide');
            location.reload(); // Recharge la page pour afficher les changements
        },
        error: function (error) {
            alert('Une erreur est survenue lors de la mise à jour de la catégorie.');
        }
    });
});

</script>
@endpush

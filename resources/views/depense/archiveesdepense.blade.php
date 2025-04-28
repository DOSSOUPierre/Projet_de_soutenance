@extends("layouts.master")
@section("contenu")
<body>
    <div class="container my-5">
        <a href="{{ route('listeDepense') }}" class="btn btn-primary mb-4">
            <i class="fas fa-home me-2"></i> Retour à la liste des Dépenses
        </a>
        <h2 class="text-center text-primary mb-4">Dépenses Archivées</h2>
    
        <div class="table-responsive"> <!-- Ajout pour empêcher le débordement -->
            <table class="table table-striped table-bordered table-hover mx-auto" style="max-width: 1200px;">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Description</th>
                        <th>Objet</th>
                        <th>Montant</th>
                        <th>Catégorie</th>
                        <th>Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($depenses as $depense)
                    <tr>
                        <td>{{ $depense->id }}</td>
                        <td>
                            <button class="btn btn-info btn-sm" style="max-width: 150px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;" data-bs-toggle="modal" data-bs-target="#descriptionModal" data-description="{{ $depense->description }}">
                                <i class="fas fa-eye"></i> Voir la description
                            </button>
                        </td>
                        <td>{{ $depense->objet }}</td>
                        <td>{{ $depense->montant }} FCFA</td>
                        <td>{{ $depense->categorie ? $depense->categorie->nom : 'Aucune catégorie' }}</td>

                        <td>{{ $depense->created_at->format('d/m/Y H:i') }}</td>
                        <td class="text-center">
                            {{-- <a href="{{ route('depense.show', $depense->id) }}" class="btn btn-info btn-sm me-1" title="Voir">
                                <i class="fas fa-eye"></i> Voir
                            </a> --}}
                            <form action="{{ route('depenses.destroy', $depense->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Voulez-vous vraiment supprimer cette dépense ?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" title="Supprimer la dépense">
                                    <i class="fas fa-trash-alt"></i> Supprimer
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center">Aucune dépense archivée.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal for description -->
    <div class="modal fade" id="descriptionModal" tabindex="-1" aria-labelledby="descriptionModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="descriptionModalLabel">Description de la dépense</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" style="max-height: 300px; overflow-y: auto; word-wrap: break-word; white-space: pre-wrap;">
                    <p id="modal-description" class="mb-0"></p>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Script to pass the description to the modal
        var descriptionModal = document.getElementById('descriptionModal');
        descriptionModal.addEventListener('show.bs.modal', function (event) {
            var button = event.relatedTarget; // Button that triggered the modal
            var description = button.getAttribute('data-description'); // Extract info from data-* attributes
            var modalBody = descriptionModal.querySelector('.modal-body p');
            modalBody.textContent = description; // Update the modal content
        });
    </script>

@endsection

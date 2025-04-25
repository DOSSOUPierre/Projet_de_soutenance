<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Dépenses</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/your_kit_code.js" crossorigin="anonymous"></script>
</head>

<body class="bg-light">

    <div class="container py-5">

        <!-- Bouton retour -->
        <a href="{{ route('dashboard') }}" class="btn btn-primary mb-4">
            <i class="fas fa-home me-2"></i> Retour à l’accueil
        </a>

        <!-- En-tête -->
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2 class="fw-bold text-primary">Liste des Dépenses</h2>
            <div>
                <button class="btn btn-secondary me-2" data-bs-toggle="modal" data-bs-target="#filtreModal">
                    <i class="fas fa-filter me-1"></i> Filtrer
                </button>
                <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#ajouterDepenseModal">
                    <i class="fas fa-plus me-2"></i> Ajouter une Dépense
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
                        @foreach($depenses as $index => $depense)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>
                                <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#descriptionModal" data-description="{{ $depense->description }}">
                                    <i class="fas fa-eye"></i> Voir la description
                                </button>
                            </td>
                            <td>{{ $depense->objet }}</td>
                            <td class="text-success fw-bold">{{ number_format($depense->montant, 2) }} FCFA</td>
                            <td>{{ $depense->telephone }}</td>
                            <td>{{ $depense->categorie->nom }}</td>
                            <td>{{ $depense->created_at->format('d/m/Y H:i') }}</td>
                            <td>
                                <div class="d-flex gap-2">
                                    <a href="{{ route('depense.show', $depense->id) }}" class="btn btn-info btn-sm" title="Voir">
                                        <i class="fas fa-eye"></i> Voir
                                    </a>
                                    <form action="{{ route('depenses.archiver', $depense->id) }}" method="POST" onsubmit="return confirm('Voulez-vous vraiment supprimer cette dépense ?')">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="btn btn-warning btn-sm">
                                            <i class="fas fa-archive"></i> Supprimer
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

        <!-- Affichage des résultats de filtrage -->
        <div id="resultatsFiltrage" class="mt-4">
            <!-- Les résultats AJAX seront injectés ici -->
        </div>
    </div>

    <!-- MODAL FILTRE -->
    <div class="modal fade" id="filtreModal" tabindex="-1" aria-labelledby="filtreModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <form id="filtreForm">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Filtrer les Dépenses</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row g-3 mb-3">
                            <div class="col-md-4">
                                <select name="filter" class="form-select" required>
                                    <option value="jour">Jour</option>
                                    <option value="semaine">Semaine</option>
                                    <option value="mois">Mois</option>
                                    <option value="annee">Année</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="date_debut">Date Début</label>
                                <input type="date" name="date_debut" id="date_debut" class="form-control" required>
                            </div>
                            <div class="col-md-4">
                                <label for="date_fin">Date Fin</label>
                                <input type="date" name="date_fin" id="date_fin" class="form-control" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary w-100">
                                    <i class="fas fa-search me-1"></i> Rechercher
                                </button>
                            </div>
                        </div>
                        <!-- Résultats filtrés affichés ici -->
                        <div id="resultatsFiltrageModal" class="mt-4"></div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- MODAL AJOUT DÉPENSE -->
    <div class="modal fade" id="ajouterDepenseModal" tabindex="-1" aria-labelledby="ajouterDepenseModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form method="POST" action="{{ route('depenses.store') }}">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Ajouter une Dépense</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label>Description</label>
                            <input type="text" name="description" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Objet</label>
                            <input type="text" name="objet" class="form-control" required>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label>Montant (FCFA)</label>
                                <input type="number" step="0.01" name="montant" class="form-control" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Téléphone</label>
                                <input type="text" name="telephone" class="form-control" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label>Catégorie</label>
                            <select name="categorie_id" class="form-select" required>
                                <option>Choisissez une catégorie :</option>
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
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="descriptionModalLabel">Description de la Dépense</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                </div>
                <div class="modal-body">
                    <p id="descriptionText"></p> <!-- Description de la dépense affichée ici -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <script>
        // Filtrage des dépenses via AJAX
        $('#filtreForm').on('submit', function(e) {
            e.preventDefault();
            let formData = $(this).serialize();

            $.ajax({
                url: "{{ route('depenses.filtrer') }}",
                method: "GET",
                data: formData,
                success: function(response) {
                    $('#resultatsFiltrageModal').html(response);
                    $('#filtreModal').modal('show');
                },
                error: function(xhr) {
                    $('#resultatsFiltrageModal').html('<div class="alert alert-danger">Une erreur est survenue.</div>');
                    console.error(xhr.responseText);
                }
            });
        });

        // Injecter la description dans la modale
        $('#descriptionModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var description = button.data('description');
            var modal = $(this);
            modal.find('#descriptionText').text(description);
        });
    </script>
</body>

</html>
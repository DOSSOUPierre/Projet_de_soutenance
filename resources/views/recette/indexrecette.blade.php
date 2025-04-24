<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Recettes</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome (bonne version via CDN) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" integrity="sha512-yEVZ1zW3zZpwh7v6+LkGfI1bKvPj2KKP5RYiZXBtGvKHXZNHUR2YrR5I2i2/Jo6fEc3B8rR1l1I9bP2i+UIm9Q==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body class="bg-light">

    <div class="container py-5">

        <!-- Bouton retour -->
        <a href="{{ route('dashboard') }}" class="btn btn-primary mb-4">
            <i class="fas fa-home me-2"></i> Retour à l’accueil
        </a>

        <!-- En-tête -->
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2 class="fw-bold text-success">Liste des Recettes</h2>
            <div>
                <button class="btn btn-secondary me-2" data-bs-toggle="modal" data-bs-target="#filtreModal">
                    <i class="fas fa-filter me-1"></i> Filtrer
                </button>
                <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#ajouterRecetteModal">
                    <i class="fas fa-plus me-2"></i> Ajouter une Recette
                </button>
            </div>
        </div>

        <!-- Tableau principal -->
        <div class="card shadow">
            <div class="card-body p-0">
                <table class="table table-bordered table-hover m-0 text-center align-middle">
                    <thead class="table-success text-uppercase">
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
                            <td>{{ $recette->description }}</td>
                            <td>{{ $recette->objet }}</td>
                            <td class="text-success fw-bold">{{ number_format($recette->montant, 2) }} FCFA</td>
                            <td>{{ $recette->telephone }}</td>
                            <td>{{ $recette->categorie->nom }}</td>
                            <td>{{ $recette->created_at->format('d/m/Y H:i') }}</td>
                            <td>
                                <a href="{{ route('recettes.show', $recette->id) }}" class="btn btn-info btn-sm me-2" title="Voir">
                                    <i class="fas fa-eye"></i> Voir
                                </a>
                                <form action="{{ route('recette.archiver', $recette->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Voulez-vous vraiment supprimer cette recette ?')">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn btn-warning btn-sm ms-2">
                                        <i class="fas fa-archive"></i> Supprimer
                                    </button>
                                </form>
                            </td>
                            
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- MODAL FILTRE -->
    <div class="modal fade" id="filtreModal" tabindex="-1" aria-labelledby="filtreModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <form id="filtreForm">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Filtrer les Recettes</h5>
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
                                <input type="date" name="date" class="form-control" required>
                            </div>
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-success w-100">
                                    <i class="fas fa-search me-1"></i> Rechercher
                                </button>
                            </div>
                        </div>
                        <div id="resultatsFiltrage">
                            <!-- Résultats AJAX ici -->
                        </div>
                    </div>
                </div>
            </form>
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
                                <input  type="number" step="0.01" name="montant" class="form-control" required>
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

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<script>
    $('#filtreForm').on('submit', function(e) {
        e.preventDefault();

        let formData = $(this).serialize();

        $.ajax({
            url: "{{ route('recettes.filtrer') }}",
            method: "GET",
            data: formData,
            success: function(response) {
                $('#resultatsFiltrage').html(response);
            },
            error: function(xhr) {
                let message = xhr.responseJSON?.error || "Une erreur est survenue.";
                $('#resultatsFiltrage').html('<div class="alert alert-danger">' + message + '</div>');
            }
        });
    });
</script>

</body>

</html>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dépenses Archivées</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
</head>
<body>
    <div class="container my-5">
        <a href="{{ route('listeDepense') }}" class="btn btn-primary mb-4">
            <i class="fas fa-home me-2"></i> Retour à la liste des Dépenses
        </a>
        <h2 class="text-center text-primary mb-4">Dépenses Archivées</h2>
    
        <table class="table table-striped table-bordered table-hover">
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
                    <td>{{ $depense->description }}</td>
                    <td>{{ $depense->objet }}</td>
                    <td>{{ $depense->montant }} FCFA</td>
                    <td>{{ $depense->categorie->nom }}</td>
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

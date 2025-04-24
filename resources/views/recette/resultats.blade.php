@if($resultats->isEmpty())
    <div class="alert alert-info">Aucune recette trouvée pour ce filtre.</div>
@else
    <table class="table table-bordered table-hover text-center align-middle mt-4">
        <thead class="table-success">
            <tr>
                <th>#</th>
                <th>Description</th>
                <th>Source</th>
                <th>Montant</th>
                <th>Téléphone</th>
                <th>Catégorie</th>
                <th>Date</th>
                {{-- <th>Actions</th> --}}
            </tr>
        </thead>
        <tbody>
            @foreach($resultats as $index => $recette)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $recette->description }}</td>
                    <td>{{ $recette->objet }}</td>
                    <td class="text-success fw-bold">{{ number_format($recette->montant, 2) }} FCFA</td>
                    <td>{{ $recette->telephone }}</td>
                    <td>{{ $recette->categorie->nom }}</td>
                    <td>{{ $recette->created_at->format('d/m/Y H:i') }}</td>
                    {{-- <td>
                        <div class="d-flex justify-content-center gap-2">
                            <a href="{{ route('recettes.show', $recette->id) }}" class="btn btn-info btn-sm" title="Voir">
                                <i class="fas fa-eye"></i> Voir
                            </a>
                            <form action="{{ route('recette.archiver', $recette->id) }}" method="POST" onsubmit="return confirm('Voulez-vous vraiment supprimer cette recette ?')">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="btn btn-warning btn-sm">
                                    <i class="fas fa-archive"></i> Supprimer
                                </button>
                            </form>
                        </div>
                    </td> --}}
                    
                </tr>
            @endforeach
        </tbody>
    </table>
@endif

@if($resultats->isEmpty())
    <div class="alert alert-info">Aucune dépense trouvée pour ce filtre.</div>
@else
    <table class="table table-bordered table-hover text-center align-middle mt-4">
        <thead class="table-success">
            <tr>
                <th>#</th>
                <th>Description</th>
                <th>Objet</th>
                <th>Montant</th>
                <th>Téléphone</th>
                <th>Catégorie</th>
                <th>Date</th>
                {{-- <th>Actions</th> --}}
            </tr>
        </thead>
        <tbody>
            @foreach($resultats as $index => $depense)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $depense->description }}</td>
                    <td>{{ $depense->objet }}</td>
                    <td class="text-success fw-bold">{{ number_format($depense->montant, 2) }} FCFA</td>
                    <td>{{ $depense->telephone }}</td>
                    <td>{{ $depense->categorie->nom }}</td>
                    <td>{{ $depense->created_at->format('d/m/Y H:i') }}</td>
                    {{-- <td>
                        <div class="d-flex justify-content-center gap-2">
                            <a href="{{ route('depense.show', $depense->id) }}" class="btn btn-info btn-sm">
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
                    </td> --}}
                </tr>
            @endforeach
        </tbody>
    </table>
@endif

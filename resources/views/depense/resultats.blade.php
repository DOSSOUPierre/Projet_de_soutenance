<div class="card shadow mb-4">
    <div class="card-header bg-primary text-white">
        <h5 class="mb-0">Résultats du Filtrage des Dépenses</h5>
    </div>
    <div class="card-body p-0">
        @if($resultats->isEmpty())
            <div class="alert alert-warning m-3">
                Aucune dépense trouvée pour cette période.
            </div>
        @else
            <table class="table table-bordered table-hover m-0 text-center align-middle">
                <thead class="table-secondary text-uppercase">
                    <tr>
                        <th>#</th>
                        <th>Description</th>
                        <th>Objet</th>
                        <th>Montant</th>
                        <th>Téléphone</th>
                        <th>Catégorie</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    @php $total = 0; @endphp
                    @foreach($resultats as $index => $depense)
                        @php $total += $depense->montant; @endphp
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $depense->description }}</td>
                            <td>{{ $depense->objet }}</td>
                            <td class="text-success fw-bold">{{ number_format($depense->montant, 2) }} FCFA</td>
                            <td>{{ $depense->telephone }}</td>
                            <td>{{ $depense->categorie->nom }}</td>
                            <td>{{ $depense->created_at->format('d/m/Y H:i') }}</td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr class="table-info fw-bold">
                        <td colspan="3">Total</td>
                        <td colspan="4">{{ number_format($total, 2) }} FCFA</td>
                    </tr>
                </tfoot>
            </table>
        @endif
    </div>
</div>
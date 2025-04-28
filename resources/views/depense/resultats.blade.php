@if($depenses->isEmpty())
    <tr>
        <td colspan="6" class="text-center text-muted">Aucune dépense trouvée pour la période sélectionnée.</td>
    </tr>
@else
    @foreach($depenses as $depense)
        <tr>
            <td>{{ $depense->created_at->format('d/m/Y') }}</td>
            <td>{{ $depense->categorieDepense->nom ?? 'Non défini' }}</td>
            <td>{{ number_format($depense->montant, 0, ',', ' ') }} FCFA</td>
            <td>{{ $depense->objet ?? '-' }}</td>
            <td>{{ $depense->description ?? '-' }}</td>

        </tr>
    @endforeach
@endif

@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Résultats du filtrage des recettes</h1>

    {{-- Message flash de succès --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Message d’erreur --}}
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    {{-- Retour à la liste complète --}}
    <a href="{{ route('listeRecette') }}" class="btn btn-secondary mb-4">← Retour à la liste des recettes</a>

    @if($resultats->isEmpty())
        <div class="alert alert-info">
            Aucune recette trouvée pour cette période.
        </div>
    @else
        <table class="table table-bordered table-hover">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Objet</th>
                    <th>Description</th>
                    <th>Montant</th>
                    <th>Catégorie</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($resultats as $recette)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $recette->objet }}</td>
                        <td>{{ $recette->description }}</td>
                        <td>{{ number_format($recette->montant, 2, ',', ' ') }} F</td>
                        <td>{{ $recette->categorie->nom ?? 'N/A' }}</td>
                        <td>{{ $recette->created_at->format('d/m/Y') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection

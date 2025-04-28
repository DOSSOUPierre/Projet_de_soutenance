@extends('layouts.master')

@section('contenu')

<div class="container">
    <h1 class="mb-4 text-center fw-bold">Détails de la Dépense</h1>

    <div class="card shadow-lg">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Dépense #{{ $depense->id }}</h4>
        </div>
        <div class="card-body">
            <p><strong>Montant :</strong> {{ $depense->montant }} FCFA</p>
            <p><strong>Catégorie :</strong> {{ $depense->categorie->nom }}</p>
            <p><strong>Description :</strong> {{ $depense->description }}</p>
            <p><strong>Objet :</strong> {{ $depense->objet }}</p>
            <p><strong>Téléphone :</strong> {{ $depense->telephone }}</p>
        </div>
        <div class="card-footer text-end">
            <a href="{{ route('listeDepense') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Retour à la liste
            </a>
        </div>
    </div>
</div>

@endsection

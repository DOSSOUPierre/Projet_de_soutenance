@extends('layouts.master')

@section('contenu')

<div class="container">
    <h1 class="mb-4 text-center fw-bold">Détails de la Recette</h1>

    <div class="card shadow-lg">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Recette #{{ $recette->id }}</h4>
        </div>
        <div class="card-body">
            <p><strong>Montant :</strong> {{ $recette->montant }} FCFA</p>
            <p><strong>Catégorie :</strong> {{ $recette->categorie->nom }}</p>
            <p><strong>Description :</strong> {{ $recette->description }}</p>
            <p><strong>Objet :</strong> {{ $recette->objet }}</p>
            <p><strong>Téléphone :</strong> {{ $recette->telephone }}</p>
        </div>
        <div class="card-footer text-end">
            <a href="{{ route('listeRecette') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Retour à la liste
            </a>
        </div>
    </div>
</div>

@endsection

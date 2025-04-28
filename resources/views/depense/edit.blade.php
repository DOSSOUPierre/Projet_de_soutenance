@extends('layouts.master')

@section('contenu')
<div class="container mt-5">
    <h2 class="text-center mb-4">Modifier la catégorie</h2>

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Détails de la catégorie</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('categories.update', $categorie->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-group mb-3">
                            <label for="nom" class="form-label">Nom de la catégorie</label>
                            <input type="text" class="form-control @error('nom') is-invalid @enderror" id="nom" name="nom" value="{{ old('nom', $categorie->nom) }}" required>
                            @error('nom')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="4">{{ old('description', $categorie->description) }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-between">
                            <button type="submit" class="btn btn-primary">Mettre à jour</button>
                            <a href="{{ route('categories.index') }}" class="btn btn-secondary">Retour</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .container {
        max-width: 900px;
    }
    .card {
        border-radius: 8px;
    }
    .card-header {
        font-size: 1.2rem;
    }
    .form-group label {
        font-weight: 500;
    }
</style>
@endpush

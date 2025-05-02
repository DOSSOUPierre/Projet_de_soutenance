@extends('layouts.master')

@section('contenu')
<div class="container mt-3">
    <h2 class="text-primary">
        <i class="fa fa-edit me-2"></i> Modifier la catégorie
    </h2>

    <!-- Message de succès -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('categories.update', $categorie->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nom" class="form-label">Nom</label>
            <input type="text" class="form-control" id="nom" name="nom" value="{{ old('nom', $categorie->nom) }}" required>
        </div>

        <div class="d-flex gap-2">
            <a href="{{ route('categories.index') }}" class="btn btn-secondary btn-sm">Retour</a>
            <button type="submit" class="btn btn-primary btn-sm">Modifier</button>
        </div>
    </form>
</div>
@endsection

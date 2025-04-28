@extends("layouts.master")

@section("contenu")

<!-- Bouton pour retourner à l'accueil -->
<a href="{{ route('dashboard') }}" class="back-btn">
    <i class="fas fa-home"></i> Retour à l'accueil
</a>

<!-- Vérification du rôle de l'utilisateur pour afficher le bouton "Créer un compte" -->
@if(auth()->user()->type === 'admin')
    <a href="{{ route('utilisateur.create') }}" class="back-btn create-account-btn" style="margin-bottom: 20px;">
        <i class="fas fa-user-plus"></i> Créer un compte
    </a>
@endif

<!-- Conteneur de la table d'utilisateurs -->
<div class="table-container">
    <h3 class="text-center">Liste des utilisateurs</h3>
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th>#</th>
                <th>Nom</th>
                <th>Email</th>
                <th>Téléphone</th>
                <th>Poste</th>
                <th>Type</th>
                <th>Date de création</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $index => $user)
                <tr>
                    <td>{{ $index + 1 }}</td> <!-- Compteur d'utilisateur -->
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->telephone }}</td>
                    <td>{{ $user->poste }}</td>
                    <td>{{ ucfirst($user->type) }}</td>
                    <td>{{ $user->created_at ? $user->created_at->format('d/m/Y H:i') : 'Non spécifié' }}</td>
                    <td>
                        <div class="action-buttons">
                            <!-- Lien pour voir les détails de l'utilisateur -->
                            <a href="{{ route('utilisateurs.details', $user->id) }}" class="action-btn view" title="Voir">
                                <i class="fas fa-eye"></i> 
                            </a>
                    
                            <!-- Lien pour éditer l'utilisateur -->
                            <a href="{{ route('utilisateurs.edit', $user->id) }}" class="action-btn edit" title="Modifier">
                                <i class="fas fa-edit"></i>
                            </a>
                    
                            <!-- Formulaire pour supprimer l'utilisateur -->
                            <form action="{{ route('utilisateurs.delete', $user->id) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="action-btn delete" title="Supprimer">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>                        
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Styles CSS -->
<style>
    /* Design général */
    body {
        font-family: 'Arial', sans-serif;
        background-color: #f4f7fc;
        color: #333;
    }

    .back-btn {
        display: inline-block;
        padding: 12px 20px;
        font-size: 16px;
        font-weight: 600;
        color: #fff;
        background-color: #007bff;
        border-radius: 25px;
        text-decoration: none;
        text-align: center;
        transition: all 0.3s ease;
        margin-top: 10px;
        box-shadow: 0 5px 15px rgba(0, 123, 255, 0.3);
    }

    .back-btn:hover {
        background-color: #0056b3;
        box-shadow: 0 5px 20px rgba(0, 123, 255, 0.5);
        transform: translateY(-3px);
    }

    .create-account-btn {
        background-color: #28a745;
        margin-bottom: 20px;
    }

    .create-account-btn:hover {
        background-color: #218838;
    }

    .table-container {
        margin: 30px auto;
        padding: 20px;
        background-color: #fff;
        border-radius: 10px;
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
        width: 90%;
        max-width: 1200px;
    }

    .table {
        width: 100%;
        border-collapse: collapse;
    }

    th, td {
        text-align: center;
        padding: 12px;
        border: 1px solid #ddd;
        font-size: 14px;
    }

    th {
        background-color: #007bff;
        color: white;
        text-transform: uppercase;
    }

    tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    tr:hover {
        background-color: #f1f1f1;
    }

    .action-btn {
        display: inline-flex;
        justify-content: center;
        align-items: center;
        margin: 5px;
        padding: 8px 12px;
        background-color: #007bff;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s ease, transform 0.2s ease;
    }

    .action-btn:hover {
        background-color: #0056b3;
        transform: scale(1.05);
    }

    .action-btn.delete {
        background-color: #dc3545;
    }

    .action-btn.delete:hover {
        background-color: #c82333;
    }

    .action-btn.edit {
        background-color: #28a745;
    }

    .action-btn.edit:hover {
        background-color: #218838;
    }

    .action-btn.view {
        background-color: #ffc107;
    }

    .action-btn.view:hover {
        background-color: #e0a800;
    }

    .action-buttons {
        display: flex;
        justify-content: center;
        gap: 8px;
        align-items: center;
    }
</style>

<!-- Scripts nécessaires -->
<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('js/popper.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/animate.js') }}"></script>
<script src="{{ asset('js/bootstrap-select.js') }}"></script>
<script src="{{ asset('js/perfect-scrollbar.min.js') }}"></script>
<script>
    var ps = new PerfectScrollbar('#sidebar');
</script>
<script src="{{ asset('js/custom.js') }}"></script>

@endsection

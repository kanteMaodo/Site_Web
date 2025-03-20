@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center alert-info">Liste des Commandes</h1>
    <a href="{{ route('client.liste') }}" class="btn btn-primary">Ajouter un produit</a>
    <br><br>
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif
    <table class="table table-striped">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Client</th>
                <th>Total des Commandes</th>
                <th>Statut</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($commandesParUtilisateur as $utilisateur)
            <tr>
                <td>{{ $utilisateur['user']->id }}</td>
                <td>{{ $utilisateur['user']->name }}</td>
                <td>{{ $utilisateur['total'] }} FCFA</td>
                <td>
                    <form action="{{ route('commande.update', $utilisateur['user']->id) }}" method="POST">
                        @csrf
                        <select name="statut" onchange="this.form.submit()">
                            <option value="en attente" {{ $utilisateur['statut'] == 'en attente' ? 'selected' : '' }}>En attente</option>
                            <option value="en cours" {{ $utilisateur['statut'] == 'en cours' ? 'selected' : '' }}>En cours</option>
                            <option value="prête" {{ $utilisateur['statut'] == 'annulee' ? 'selected' : '' }}>Prête</option>

                        </select>
                    </form>
                </td>
                <td>
                    <a href="{{ route('commande.show', $utilisateur['user']->id) }}" class="btn btn-primary">Voir Factures</a>
                    <a href="{{ route('commande.facture', $utilisateur['user']->id) }}" class="btn btn-secondary">Télécharger Facture</a>
                    <a href="#" class="btn btn-success">Modifier</a>
                    <form action="{{ route('commande.destroy',$utilisateur['user']->id )}}" method="POST" style=" display: inline-block">
                        @csrf
                        <button type="submit" class="btn btn-danger">Annuler</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
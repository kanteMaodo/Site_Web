@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center alert-info">Factures</h1>
    <a href="{{ route('commande.index') }}" class="btn btn-primary">Retour</a>
    <br><br>
    <table class="table table-striped">
        <thead class="table-dark">
            <tr>
                <th>id</th>
                <th>Nom Produit</th>
                <th>Quantité</th>
                <th>Prix</th>
                <th>Prix Total</th>
                <th>Statut</th>
            </tr>
        </thead>
        <tbody>
            @foreach($commandes as $commande)
            <tr>
                <td>{{ $commande->id }}</td>
                <td>{{ $commande->produit ? $commande->produit->nom : 'Produit inconnu' }}</td>
                <td>{{ $commande->quantite }}</td>
                <td>{{ $commande->prix }}</td>
                <td>{{ $commande->prix_total }}</td>
                <td>{{ $commande->statut }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
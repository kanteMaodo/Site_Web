@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Votre Panier</div>
                <div class="card-body">
                    @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                    @endif
                    @if(empty($panier))
                    <p>Votre panier est vide.</p>
                    @else
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Produit</th>
                                <th>Quantité</th>
                                <th>Prix</th>
                                <th>Total</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($panier as $id => $details)
                            <tr>
                                <td>{{ $details['nom'] }}</td>
                                <td>
                                    <form action="{{ route('panier.modifier', ['id' => $id] ) }}" method="POST">
                                        @csrf
                                        <input type="number" name="quantite" value="{{ $details['quantite'] }}" min="1">
                                        <button type="submit" class="btn btn-primary btn-sm">Modifier</button>
                                    </form>
                                </td>
                                <td>{{ $details['prix'] }} FCFA</td>
                                <td>{{ $details['prix'] * $details['quantite'] }} FCFA</td>
                                <td>
                                    <a href="{{ route('panier.supprimer', ['id' => $id]) }}" class="btn btn-danger btn-sm">Supprimer</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="text-right">
                        <strong>Total: {{ array_sum(array_map(function($item) { return $item['prix'] * $item['quantite']; }, $panier)) }} FCFA</strong>
                    </div>
                    <form action="{{ route('panier.valider') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-success">Valider la commande</button>
                    </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
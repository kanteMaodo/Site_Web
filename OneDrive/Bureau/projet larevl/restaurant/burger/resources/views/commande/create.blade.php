@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><strong>Ajouter une nouvelle Commande</strong></div>
                <div class="card-body">
                    <form method="POST" action="{{ route('commande.store') }}">
                        @csrf
                        <div class="form-group">
                            <label for="client">Nom du client</label>
                            <select name="user_id" id="client" class="form-control">
                                @foreach($users as $user)
                                <option value="{{ $user->id }}">{{ $user->nom }} - {{ $user->prenom }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="produit">Nom du produit</label>
                            <select name="produit_id" id="produit" class="form-control">
                                @foreach($produits as $produit)
                                <option value="{{ $produit->id }}">{{ $produit->nom }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="quantite">Quantité</label>
                            <input type="number" name="quantite" id="quantite" class="form-control" placeholder="Quantité">
                        </div>
                        <div class="form-group">
                            <label for="prix">Prix</label>
                            <input type="number" name="prix" id="prix" class="form-control" placeholder="Prix">
                        </div>
                        <div class="form-group">
                            <label for="prix_total">Prix total</label>
                            <input type="number" name="prix_total" id="prix_total" class="form-control" placeholder="Prix total">
                        </div>
                        <div class="form-group">
                            <label for="statut">Statut</label>
                            <select name="statut" id="statut" class="form-control">
                                <option value="en attente">En attente</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Ajouter</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
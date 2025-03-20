@extends('layouts.app')

<style>
    .image-spacing {
        margin-bottom: 20px;
        justify-content: space-around;
    }
    .footer {
        background-color: #f8f9fa;
        padding: 20px 0;
        text-align: center;
        margin-top: 30px;
        border-top: 1px solid #ddd;
    }
</style>

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Liste des Burgers</div>
                <div class="card-body">
                    <h4>Rechercher un Burger</h4>
                    <form action="#" method="GET">
                        <div class="form-group">
                            <label for="search">Rechercher par nom ou prix</label>
                            <input type="text" class="form-control" id="search" name="search" placeholder="Rechercher un Burger">
                        </div>
                        <br>
                        <button type="submit" class="btn btn-primary">Rechercher</button>
                    </form>
                    <div class="mt-4">
                        @if($clients->isEmpty())
                        <p>Aucun produit trouvé.</p>
                        @else
                        <div class="row py-5 d-flex justify-content-center">
                            @foreach($clients as $produit)
                            <div class="card mb-3 mt-2 rounded mx-3 text-center" style="width: 18rem;">
                                <img src="{{ asset('uploads/produits/' .$produit->image )}}" class="card-img-top" alt="{{ $produit->nom }}" width="100" height="150">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $produit->nom }}</h5>
                                    <br>
                                    <p class="card-text"><strong>Prix:</strong> {{ $produit->prix }} FCFA</p>
                                    <a href="{{ route('panier.ajouter', ['id' => $produit->id] )}}" method="GET" class="btn btn-primary text-center">Commander</a>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<footer class="footer">
    <p>&copy; {{ date('Y') }} ISI BURGER - Un plaisir à chaque bouchée ! 🍔</p>
</footer>
@endsection

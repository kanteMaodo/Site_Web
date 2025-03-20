@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-center align-items-center min-vh-90">

    <div class="card mb-3" style="max-width: 540px;">
        <div class="row g-0">
            <div class="col-md-12 text-center">
                <img src="{{ asset('uploads/produits/'.$produits->image) }}" alt=" image" width="540" height="400">
            </div>
            <div class="col-md-12">
                <div class="card-body">
                    <h5 class="card-title"><strong>{{ $produits->nom}}</strong></h5>
                    <p class="card-text">Prix : {{ $produits->prix }} Fcfa</p>
                    <p class="card-text"><small class="text-body-secondary"> Description : {{ $produits->description }}</small></p>
                </div>
            </div>
        </div>
        <a href="{{route('produit.index')}}" class="btn btn-primary">Retour</a>


    </div>
    <br>

</div>
@endsection
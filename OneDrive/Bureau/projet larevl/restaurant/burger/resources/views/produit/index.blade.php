@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center alert-info">Liste des produits</h1>
    <link href="https://unpkg.com/filepond/dist/filepond.css" rel="stylesheet" />
    <a href="{{ route('produit.create') }}" class="btn btn-primary">Ajouter un produit</a>
    <br><br>
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif
    <table class="table table-striped ">
        <thead class="table-dark">
            <tr>
                <th>Id</th>
                <th>Nom</th>
                <th>Prix</th>
                <th>Description</th>
                <th>Image</th>
                <th>Stock</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($produits as $produit)
            <tr>
                <td>{{ $produit->id }}</td>
                <td>{{ $produit->nom }}</td>
                <td>{{ $produit->prix }} FCFA</td>
                <td>{{ $produit->description }}</td>
                <td>
                    @if($produit->image != "")
                    <img src="{{ asset('uploads/produits/'.$produit->image) }}" alt="" width="50">
                    @endif

                </td>

                <td>{{ $produit->stock }}</td>

                <td>
                    <a href="{{ route('produit.edit', $produit->id) }}" class="btn btn-primary">Modifier</a>
                    <form action="{{ route('produit.destroy', $produit->id) }}" method="post" style="display: inline-block" onsubmit="return confirm('Voulez-vous vraiment supprimer ce produit ?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Supprimer</button>
                    </form>
                    <a href="{{route('produit.show', $produit->id)}}" class="btn btn-secondary">Details</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="d-flex justify-content-center">
        {{ $produits->links() }}
    </div>
</div>
@endsection
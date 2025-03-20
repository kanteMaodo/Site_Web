@extends('layouts.app')

@section('content')

<div class="container mt-5">
    <link href="https://unpkg.com/filepond/dist/filepond.css" rel="stylesheet" />
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><strong class="text-center">Modifier un produit</strong></div>
                <div class="card-body">
                    <form method="POST" action="{{ route('produit.update', $produit->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group
                        @error('nom')
                            has-error
                        @enderror">
                            <label for="nom">Nom du produit</label>
                            <input type="text" class="form-control" id="nom" name="nom" value="{{ $produit->nom }}">
                            @error('nom')
                            <span class="help-block
                            text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group
                        @error('prix')
                            has-error
                        @enderror">
                            <label for="prix">Prix</label>
                            <input type="number" class="form-control" id="prix" name="prix" value="{{ $produit->prix }}">
                            @error('prix')
                            <span class="help-block
                            text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group
                        @error('description')
                            has-error
                        @enderror">
                            <label for="description">Description</label>
                            <input type="text" class="form-control" id="description" name="description" value="{{ $produit->description }}">
                            @error('description')
                            <span class="help-block
                        text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group
                    @error('stock')
                        has-error
                    @enderror">
                            <label for="stock">Stock</label>
                            <input type="number" class="form-control" id="stock" name="stock" value="{{ $produit->stock }}">
                            @error('stock')
                            <span class="help-block
                    text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group
                @error('image')
                    has-error
                @enderror">
                            <label for="image">Image</label>
                            <input type="file" class="form-control" id="image" name="image">
                            <br>
                            @if($produit->image != "")

                            <img src="{{ asset('uploads/produits/' .$produit->image )}}" alt="" width="100" height="100">
                            @endif

                            @error('image')
                            <span class="help-block
                text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <br><br>
                        <button type="submit" class="btn btn-primary">Modifier</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
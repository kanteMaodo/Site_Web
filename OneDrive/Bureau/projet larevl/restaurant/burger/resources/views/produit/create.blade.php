@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <link href="https://unpkg.com/filepond/dist/filepond.css" rel="stylesheet" />
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><strong class="text-center">Ajouter un produit</strong></div>
                <div class="card-body">
                    <form method="POST" action="{{ route('produit.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group
                        @error('nom')
                            has-error
                        @enderror">
                            <label for="nom">Nom du produit</label>
                            <input type="text" class="form-control" id="nom" name="nom" value="{{ old('nom') }}">
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
                            <input type="number" class="form-control" id="prix" name="prix" value="{{ old('prix') }}">
                            @error('prix')
                            <span class="help-block
                            text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group
                        @error('description')
                            has-error
                        @enderror">
                            <label for="description"> Description</label>
                            <input type="text" class="form-control" id="description" name="description" value="{{ old(' description') }}">
                            @error('quantite')
                            <span class="help-block
                            text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group
                        @error('stock')
                            has-error
                        @enderror">
                            <label for="stock"> Stock</label>
                            <input type="number" class="form-control" id="stock" name="stock" value="{{ old('stock') }}">
                            @error('stock')
                            <span class="help-block
                            text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group
                        @error('image')
                            has-error
                        @enderror">
                            <label for="image"> Image</label>
                            <input type="file" class="form-control" id="image" name="image" value="{{ old('image') }}">
                            @error('image')
                            <span class="help-block
                            text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <br>
                        <button type="submit" class="btn btn-primary">Ajouter</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
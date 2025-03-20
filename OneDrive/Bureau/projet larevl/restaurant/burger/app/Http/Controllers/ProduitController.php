<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produit;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;

class ProduitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $produits = Produit::paginate(10);
        return view('produit.index', compact('produits'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('produit.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            'nom' => 'required|string|max:255',
            'prix' => 'required|numeric',
            'description' => 'required',
            'stock' => 'required',
        ];

        if ($request->image != "") {
            $rules['image'] = 'image';
        }

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->route('produit.create')->withInput()->withErrors($validator);
        }


        $produits = new Produit();
        $produits->nom = $request['nom'];
        $produits->prix = $request['prix'];
        $produits->description = $request['description'];
        $produits->stock = $request['stock'];
        $produits->save();

        if ($request->image != "") {
            // upload image
            $image = $request->image;
            $ext = $image->getClientOriginalExtension();
            $imageName = time() . '.' . $ext; // renameing image

            // save image to public folder
            $image->move(public_path('uploads/produits'), $imageName);
            // save image
            $produits->image = $imageName;
            $produits->save();
        }

        return redirect()->route('produit.index')->with('success', 'Produit ajouté avec succès');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $produits = Produit::find($id);
        return view('produit.show', compact('produits'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $produit = Produit::find($id);

        return view('produit.update', compact('produit'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $produits = Produit::find($id);

        $rules = [
            'nom' => 'required|string|max:255',
            'prix' => 'required|numeric',
            'description' => 'required',
            'stock' => 'required',
        ];

        if ($request->image != "") {
            $rules['image'] = 'image';
        }

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->route('produit.edit', $produits->id)->withInput()->withErrors($validator);
        }


        $produits->nom = $request['nom'];
        $produits->prix = $request['prix'];
        $produits->description = $request['description'];
        $produits->stock = $request['stock'];
        $produits->save();

        if ($request->image != "") {

            // Supprimer l'image précédente
            File::delete(public_path('uploads/produits/' . $produits->image));


            // upload image
            $image = $request->image;
            $ext = $image->getClientOriginalExtension();
            $imageName = time() . '.' . $ext; // renameing image

            // save image to public folder
            $image->move(public_path('uploads/produits'), $imageName);
            // save image
            $produits->image = $imageName;
            $produits->save();
        }

        return redirect()->route('produit.index')->with('success', 'Produit modifié avec succès');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $produit = Produit::find($id);

        // Supprimer l'image
        File::delete(public_path('uploads/produits/' . $produit->image));

        $produit->delete();
        return redirect()->route('produit.index')->with('success', 'Produit supprimé avec succès');
    }
}

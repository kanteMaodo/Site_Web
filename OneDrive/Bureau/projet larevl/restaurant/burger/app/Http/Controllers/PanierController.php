<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produit;
use App\Models\Commande;
use App\Models\CommandeGroupe;
use Illuminate\Support\Facades\Auth;
use App\Models\Facture;


class PanierController extends Controller
{
    public function index()
    {
        $panier = session()->get('panier');
        return view('panier', compact('panier'));
    }

    public function ajouter($id)
    {
        $produit = Produit::find($id);

        $panier = session()->get('panier');

        if (isset($panier[$id])) {
            $panier[$id]['quantite']++;
        } else {
            $panier[$id] = [
                'image' => $produit->image,
                'nom' => $produit->nom,
                'prix' => $produit->prix,
                'quantite' => 1,
            ];
        }

        session()->put('panier', $panier);

        return redirect()->route('panier.afficher')->with('success', 'Produit ajouté au panier');
    }

    public function afficher()
    {
        $panier = session()->get('panier');
        return view('panier.afficher', compact('panier'));
    }

    public function modifier(Request $request, $id)
    {
        $panier = session()->get('panier', []);

        if (isset($panier[$id])) {
            $panier[$id]['quantite'] = $request->input('quantite');
            session()->put('panier', $panier);
        }

        return redirect()->route('panier.afficher')->with('success', 'Quantité modifié ');
    }

    public function supprimer($id)
    {
        $panier = session()->get('panier', []);

        if (isset($panier[$id])) {
            unset($panier[$id]);
            session()->put('panier', $panier);
        }

        return redirect()->route('panier.afficher')->with('success', 'Produit supprimé au panier');
    }

    public function valider()
    {
        $panier = session()->get('panier', []);
        $user_id = Auth::id();

        $commandeGroupe = CommandeGroupe::create([
            'user_id' => $user_id,
            'prix_total' => array_sum(array_map(function ($item) {
                return $item['prix'] * $item['quantite'];
            }, $panier)),
            'statut' => 'en attente',
        ]);

        foreach ($panier as $id => $details) {
            Commande::create([
                'user_id' => $user_id,
                'produit_id' => $id,
                'quantite' => $details['quantite'],
                'prix' => $details['prix'],
                'prix_total' => $details['prix'] * $details['quantite'],
                'statut' => 'en attente',
                'commande_groupe_id' => $commandeGroupe->id,
            ]);
        }

        // generer une facture 


        session()->forget('panier');

        return redirect()->route('commande.index')->with('success', 'Commande passée avec succès!');
    }
}

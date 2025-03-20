<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Produit;
use App\Models\Commande;
use App\Models\CommandeGroupe;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use App\Mail\FactureMail;
use Illuminate\Support\Facades\Mail;

class CommandeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $commandesParUtilisateur = Commande::with('user', 'produits')
            ->get()
            ->groupBy('user_id')
            ->map(function ($commandes) {
                return [
                    'user' => $commandes->first()->user,
                    'commandes' => $commandes,
                    'statut' => $commandes->first()->statut,
                    'total' => $commandes->sum('prix_total')
                ];
            });

        return view('commande.index', compact('commandesParUtilisateur'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        
    }

    /**
     * Display the specified resource.
     */
    public function showFacture($userId)
    {
        $commandes = Commande::with('produits')
            ->where('user_id', $userId)
            ->get();
        // 

        return view('commande.defaut', compact('commandes'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $commande = Commande::findOrFail($id);
        $commande->statut = $request->statut;

        if ($request->statut == 'payée') {
            $commande->date_paiement = now();
            $commande->montant_paiement = $request->montant_paiement;
        }

        $commande->save();

        if ($request->statut == 'prête') {
            $this->genererFacture($commande);
        }

        return redirect()->route('commande.index')->with('success', 'Statut de la commande modifié avec succès');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $commandes = Commande::findOrFail($id);
        $commandes->statut = 'annulée';
        $commandes->save();
        return redirect()->route('commande.show', $commandes->user_id)->with('success', 'Commande annulée avec succès');
    }
    public function genererFacture($userId)
    {
        try {
            $commandes = Commande::with('produits')->where('user_id', $userId)->get();
            $user = User::findOrFail($userId);
            $produit = Produit::all();
            $total = $commandes->sum('prix_total');
            $quantite = $commandes->sum('quantite');
            $prix = $commandes->sum('prix');
            $prix_total = $commandes->sum('prix_total');
            $pdf = PDF::loadView('commande.facture', compact('commandes', 'user', 'total', 'quantite', 'prix', 'prix_total', 'produit'));

            return $pdf->download('facture_commande_' . $userId . '.pdf');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Erreur lors de la génération de la facture.');
        }
    }
    public function validerCommande(Request $request)
    {
    // Récupérer la commande validée
    $commande = Commande::findOrFail($request->commande_id);
    $user = $commande->user;
    $commandes = $commande->details; // Supposons que c'est la relation des articles commandés
    $quantite = $commande->quantite_totale;
    $prix_total = $commande->total;

    // Envoi de l’email avec la facture
    Mail::to($user->email)->send(new FactureMail($user, $commandes, $quantite, $prix_total));

    return response()->json(['message' => 'Commande validée et facture envoyée !']);
    }
}

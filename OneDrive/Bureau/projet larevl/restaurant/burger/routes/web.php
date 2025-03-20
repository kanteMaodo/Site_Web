<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\CommandeController;
use App\Http\Controllers\PanierController;
use App\Http\Controllers\ProduitController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;

// connexion , deconnexion et inscription

Route::get('/', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.submit');
Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register'])->name('register.submit');


Route::middleware('auth')->get('/home', function () {
    return view('home');
})->name('home');

// Route necessitant une authentification
Route::middleware('auth')->group(function () {

    // produits
    Route::get('/produit', [ProduitController::class, 'index'])->name('produit.index');
    Route::get('/produit/create', [ProduitController::class, 'create'])->name('produit.create');
    Route::post('/produit/store', [ProduitController::class, 'store'])->name('produit.store');
    Route::get('/produit/{id}', [ProduitController::class, 'show'])->name('produit.show');
    Route::get('/produit/{id}/edit', [ProduitController::class, 'edit'])->name('produit.edit');
    Route::put('/produit/{id}', [ProduitController::class, 'update'])->name('produit.update');
    Route::delete('/produit/{id}', [ProduitController::class, 'destroy'])->name('produit.destroy');

    // client
    Route::get('/client', [ClientController::class, 'index'])->name('client.index');
    Route::get('/client/liste ', [ClientController::class, 'index'])->name('client.liste');


    // panier 
    Route::get('/panier', [PanierController::class, 'afficher'])->name('panier.afficher');
    Route::get('/panier/ajouter/{id}', [PanierController::class, 'ajouter'])->name('panier.ajouter');
    Route::post('/panier/modifier/{id}', [PanierController::class, 'modifier'])->name('panier.modifier');
    Route::get('/panier/supprimer/{id}', [PanierController::class, 'supprimer'])->name('panier.supprimer');
    Route::post('/panier/valider', [PanierController::class, 'valider'])->name('panier.valider');



    // commandes 
    Route::get('/commande', [CommandeController::class, 'index'])->name('commande.index');
    Route::get('/commande/create', [CommandeController::class, 'create'])->name('commande.create');
    Route::post('/produit', [CommandeController::class, 'store'])->name('commande.store');
    Route::get('/factures/{user}', [CommandeController::class, 'showFacture'])->name('commande.show');
    Route::post('/commande/destroy/{id}', [CommandeController::class, 'destroy'])->name('commande.destroy');
    Route::get('/commande/facture/{userId}', [CommandeController::class, 'genererFacture'])->name('commande.facture');
    Route::post('commande/update/{id}', [CommandeController::class, 'update'])->name('commande.update');

    // paiements 

});

 
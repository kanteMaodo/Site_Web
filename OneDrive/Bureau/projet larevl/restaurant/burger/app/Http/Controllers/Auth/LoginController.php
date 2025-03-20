<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    // Afficher le formulaire de connexion
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Gérer la connexion d'un utilisateur
    public function login(Request $request)
    {
        // Validation des données
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        // Authentification de l'utilisateur
        if (Auth::attempt($validated)) {
            // Redirection après la connexion
            return redirect()->route('home');
        }

        // Redirection en cas d'échec de l'authentification
        return back()->withErrors([
            'email' => 'Les identifiants sont incorrects.',
        ]);
    }
}

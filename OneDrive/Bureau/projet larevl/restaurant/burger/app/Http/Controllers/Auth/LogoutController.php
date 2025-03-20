<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogoutController extends Controller
{
    // Déconnexion de l'utilisateur
    public function logout()
    {
        Auth::logout();

        return redirect()->route('login');
    }
}

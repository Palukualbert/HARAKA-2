<?php

namespace App\Http\Controllers;

use App\Http\Requests\ConnChauffRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthChauffeurController extends Controller
{

    public function login(){
        return view('layouts.connChauff');
    }

    public function auth(ConnChauffRequest $request)
    {

        $credentials = [
            'telephone' => $request->telephone,
            'password' => $request->mot_de_passe  // Mapper "mot_de_passe" à "password"
        ];

        if (Auth::guard('chauffeur')->attempt($credentials)) {
            return redirect()->intended(route('chauffeur.accepter'));
        } else {
            echo "hum";
        }
    }

}

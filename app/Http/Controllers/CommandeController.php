<?php

namespace App\Http\Controllers;

use App\Events\CommandeEvent;
use Illuminate\Http\Request;

class CommandeController extends Controller
{
    public function commande(){
        return view('layouts.commande');
    }

    public function submit(Request $request)
    {
        /*
        // Récupérer les données du formulaire
        $start = $request->input('start');
        $end = $request->input('end');
        $startCoords = $request->input('startCoords');
        $endCoords = $request->input('endCoords');
        $distance = $request->input('distance');
        $duration = $request->input('duration');
        $price = $request->input('price');
           */
        // Traiter les données ici, par exemple, en les sauvegardant dans la base de données

        // Rediriger vers une page de confirmation ou afficher un message de succès
        event(new CommandeEvent('Gopher'));
        return view('layouts.CommandePassee');
    }
}

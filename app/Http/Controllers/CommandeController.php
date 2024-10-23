<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use Illuminate\Http\Request;
use App\Events\CommandeEvent;
use App\Events\CommandAcceptEvent;

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

        $data['start'] = $request->start;

        $data['end'] = $request->end;

        $data['startCoords'] = $request->startCoords;

        $data['endCoords'] = $request->endCoords;

        $data['distance'] = $request->distance;

        $data['duration'] = $request->duration;

        $data['price'] = $request->price;
        $data['startCoords'] = $request->startCoords;
        $data['endCoords'] = $request->endCoords;
        event(new CommandeEvent(json_encode($data)));

        return view('layouts.CommandePassee');
    }


    public function saveCommande(Request $request)
    {

        list($latitudeDepartStart, $longitudeDepartStart) = explode(',', $request->startCoords);
        list($latitudeDestEnd, $longitudeDestEnd) = explode(',', $request->endCoords);

        $data = [
            'date' => now()->format('Y-m-d'),
            'statut' => true,
            'pointDepart' => $request->start,
            'destination' => $request->end,
            'coutEstime' => $request->price,
            'longitudeDepart' => $longitudeDepartStart,
            'latitudeDepart' => $latitudeDepartStart,
            'longitudeDest' => $longitudeDestEnd,
            'latitudeDest' => $latitudeDestEnd,
            'client_id' => 1,
            'vehicule_id' => 1,
        ];

        $commande = Commande::create($data);

        event(new CommandAcceptEvent(json_encode($commande->id)));

        return to_route('commande-encours', $commande->id);
    }

    public function commande_encours($id)
    {
        $commande = Commande::find($id);

        return view('layouts.commandeEncours', compact('commande'));
    }

}

<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use App\Models\Chauffeur;
use App\Models\Vehicule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ChauffeurController extends Controller
{

    public function liste()
    {

        $chauffeurs = Chauffeur::all();
        $categories = Categorie::all();
        return view('layouts.Liste_chauffeurs',compact('chauffeurs', 'categories'));
    }

    public function ajouterChauffeur()
    {
        $chauffeur = new Chauffeur(); // Objet vide pour la création
        return view('layouts.AjouterChauffeur', ['mode' => 'create', 'chauffeur' => $chauffeur]);
    }
    public function edit($id)
    {
        $chauffeur = Chauffeur::with('vehicules')->findOrFail($id);
        return view('layouts.AjouterChauffeur', ['mode' => 'edit', 'chauffeur' => $chauffeur]);
    }

    public function update(Request $request, $id)
    {
        $chauffeur = Chauffeur::findOrFail($id);

        $validatedData = $request->validate([
            'telephone' => 'required|string|max:13',
            'marque' => 'required|string|max:50',
            'plaqueImmat' => 'required|string|max:20',
            'couleurVehicule' => 'required|string|max:20',
            'categorie_id' => 'required|string|max:50',
        ]);

        // Mettre à jour les informations du chauffeur
        $chauffeur->update([
            'telephone' => $validatedData['telephone'],
        ]);

        // Mettre à jour les informations du véhicule
        $vehicule = $chauffeur->vehicules->first();
        $vehicule->update([
            'marque' => $validatedData['marque'],
            'plaqueImmat' => $validatedData['plaqueImmat'],
            'couleurVehicule' => $validatedData['couleurVehicule'],
            'categorie_id' => $validatedData['categorie_id'],
        ]);

        return to_route('chauffeur.liste')->with('success', 'Chauffeur modifié avec succès');
    }

    public function destroy($id){
        $chauffeur = Chauffeur::findOrFail($id); // Récupérer le chauffeur par ID
        $chauffeur->delete(); // Supprimer le chauffeur

        return to_route('chauffeur.liste')->with('success', 'Chauffeur supprimé avec succès');
    }
    public function enregistrer_chauffeur(Request $request){
        $motDePasse = $this->genererMotDePasse();

        $chauffeur = Chauffeur::create([
            'nom' => $request->nom,
            'adresse' => $request->adresse,
            'telephone' => $request->telephone,
            'disponible'=> 0,
            'password' => Hash::make($motDePasse),
            'mot_de_passe'=>$motDePasse
        ]);
        Vehicule::create([
            'marque' => $request->marque,
            'plaqueImmat' => $request->plaqueImmat,
            'couleurVehicule' => $request->couleurVehicule,
            'chauffeur_id' => $chauffeur->id,
            'categorie_id' => $request->categorie_id
        ]);
        return to_route('chauffeur.liste');

    }
    function genererMotDePasse()
    {
        return Str::random(6);
    }
    function accepter(){
        return view('layouts.Acceptation');
    }
}

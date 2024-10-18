<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use App\Models\Chauffeur;
use App\Models\Vehicule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

// Import du package DOMPDF
use PDF;
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

    // Méthode pour générer un rapport PDF
    public function generatePdf($id)
    {
        // Récupérer le chauffeur avec ses véhicules
        $chauffeur = Chauffeur::with('vehicules')->findOrFail($id);

        // Générer le PDF en passant les données du chauffeur
        $pdf = PDF::loadView('rapports.chauffeur_pdf', compact('chauffeur'));

        // Télécharger le fichier PDF
        return $pdf->download('rapport_chauffeur_' . $chauffeur->nom . '.pdf');

        //$pdf->stream "à utiliser si on souhaite ouvrir le fichier automatiquement dans un autre onglet"
        //return $pdf->stream('rapport_chauffeur_' . $chauffeur->nom . '.pdf');

    }

    // Méthode pour générer un rapport Excel
    /* public function generateExcel($id)
     {
         // Récupérer le chauffeur par ID
         $chauffeur = Chauffeur::findOrFail($id);

         // Générer le fichier Excel
         return Excel::download(new ChauffeurExport($chauffeur), 'rapport_chauffeur_' . $chauffeur->nom . '.xlsx');
     }*/
}

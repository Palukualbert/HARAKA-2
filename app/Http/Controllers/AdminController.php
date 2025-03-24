<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use App\Models\Chauffeur;
use App\Models\Vehicule;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function dashboard()
    {
        // Récupération des données
        $totalCommandes = Commande::count();
        $commandesDuJour = Commande::whereDate('created_at', Carbon::today())->count();
        $totalChauffeurs = Chauffeur::count();
        $totalVehicules = Vehicule::count();
        $dernieresCommandes = Commande::orderBy('created_at', 'desc')->get();

        return view('admin.dashboard', compact('totalCommandes', 'commandesDuJour', 'totalChauffeurs', 'totalVehicules', 'dernieresCommandes'));
    }
}



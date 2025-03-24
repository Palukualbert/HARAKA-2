@extends('layouts.app')



@section('content')
    <div class="container mt-5">
        <!-- En-tête du Dashboard -->
        <div class="row">
            <div class="col-12 text-center mb-4">
                <h1 class="fw-bold text-dark"><i class="fa fa-tachometer" aria-hidden="true"></i> Tableau de Bord</h1>
                <p class="text-muted">Aperçu global de l'activité en temps réel</p>
            </div>
        </div>

        <!-- Cartes Statistiques -->
        <div class="row g-4">
            <!-- Commandes du Jour -->
            <div class="col-md-3">
                <div class="card shadow-sm border-0 text-center p-3 bg-light">
                    <i class="fa fa-calendar-check-o fa-3x text-primary mb-2"></i>
                    <h5 class="card-title">Commandes du Jour</h5>
                    <p class="display-4 fw-bold text-primary">{{ $commandesDuJour }}</p>
                </div>
            </div>

            <!-- Nombre Total de Commandes -->
            <div class="col-md-3">
                <div class="card shadow-sm border-0 text-center p-3 bg-light">
                    <i class="fa fa-shopping-cart fa-3x text-success mb-2"></i>
                    <h5 class="card-title">Total Commandes</h5>
                    <p class="display-4 fw-bold text-success">{{ $totalCommandes }}</p>
                </div>
            </div>

            <!-- Nombre de Chauffeurs -->
            <div class="col-md-3">
                <div class="card shadow-sm border-0 text-center p-3 bg-light">
                    <i class="fa fa-id-badge fa-3x text-warning mb-2"></i>
                    <h5 class="card-title">Nombre de Chauffeurs</h5>
                    <p class="display-4 fw-bold text-warning">{{ $totalChauffeurs }}</p>
                </div>
            </div>

            <!-- Nombre de Véhicules -->
            <div class="col-md-3">
                <div class="card shadow-sm border-0 text-center p-3 bg-light">
                    <i class="fa fa-car fa-3x text-danger mb-2"></i>
                    <h5 class="card-title">Nombre de Véhicules</h5>
                    <p class="display-4 fw-bold text-danger">{{ $totalVehicules }}</p>
                </div>
            </div>
        </div>

        <!-- Tableau des Dernières Commandes -->
        <div class="row mt-5">
            <div class="col-md-12">
                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <h4 class="card-title mb-3"><i class="fa fa-list-alt"></i> Les Commandes</h4>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead class="table-dark">
                                <tr>
                                    <th>Date</th>
                                    <th>Départ</th>
                                    <th>Destination</th>
                                    <th>Coût Estimé</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($dernieresCommandes as $commande)
                                    <tr>
                                        <td>{{ $commande->date }}</td>
                                        <td>{{ $commande->pointDepart }}</td>
                                        <td>{{ $commande->destination }}</td>
                                        <td>{{ $commande->coutEstime }} FCFA</td>

                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Animation CSS -->
    <style>
        .card {
            transition: transform 0.2s ease-in-out;
        }
        .card:hover {
            transform: translateY(-5px);
        }
    </style>
@endsection

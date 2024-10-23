<h1>
    Commande encours
    <div class="container">
        <div class="card mt-4">
            <div class="card-header bg-primary text-white">
                <h5>Détails de la Commande</h5>
            </div>
            <div class="card-body">
                <p><strong>Date :</strong> {{ $commande['date'] }}</p>
                <p><strong>Point de départ :</strong> {{ $commande['pointDepart'] }}</p>
                <p><strong>Destination :</strong> {{ $commande['destination'] }}</p>
                <p><strong>Coût Estimé :</strong> {{ number_format($commande['coutEstime'], 2) }} Francs</p>
                <p><strong>Coordonnées de départ :</strong>
                    {{ $commande['latitudeDepart'] }} - - - {{ $commande['longitudeDepart'] }}
                </p>
                <p><strong>Coordonnées de destination :</strong>
                    {{ $commande['latitudeDest'] }} - - - {{ $commande['longitudeDest'] }}
                </p>
            </div>
            <div class="card-footer text-end">
                <a href="" class="btn btn-secondary">Retour</a>
            </div>
        </div>
    </div>
</h1>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Commande en cours - Taxi</title>

    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
          integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
          crossorigin=""/>
    <!-- Leaflet Routing Machine CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet-routing-machine/3.2.12/leaflet-routing-machine.css" />
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,400,300,500,600,700" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/linearicons.css')}}">
    <link rel="stylesheet" href="{{asset('css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('css/magnific-popup.css')}}">
    <link rel="stylesheet" href="{{asset('css/nice-select.css')}}">
    <link rel="stylesheet" href="{{asset('css/animate.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/jquery-ui.css')}}">
    <link rel="stylesheet" href="{{asset('css/main.css')}}">
    <style>
        /* Style pour la carte */
        #map {
            width: 100%;
            height: 400px;
            margin-bottom: 20px;
        }

        /* Style de la page */
        body {
            font-family: Arial, sans-serif;
            background-color: #1e1e1e;
            color: #fff;
            margin: 0;
            padding: 0;
        }

        h1 {
            text-align: center;
            color: #FFD700;
            margin-top: 20px;
        }

        .container {
            max-width: 600px;
            margin: auto;
        }

        .card {
            background-color: #333;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .card-header {
            background-color: #FFD700;
            color: black;
            text-align: center;
            padding: 15px;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
        }

        .card-body {
            padding: 20px;
        }

        .card-body p {
            margin: 10px 0;
            line-height: 1.6;
        }

        .card-footer {
            background-color: #222;
            padding: 10px;
            border-bottom-left-radius: 10px;
            border-bottom-right-radius: 10px;
            text-align: right;
        }

        .btn-secondary {
            background-color: #FFD700;
            color: black;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        .btn-secondary:hover {
            background-color: #ffcc00;
        }
    </style>
</head>
<body>

<h1>Commande en cours</h1>

<div class="container">
    <!-- Section de la carte -->
    <div id="map"></div>

    <div class="card mt-4">
        <div class="card-header">
            <h5>Détails de la Commande</h5>
        </div>
        <div class="card-body">
            <p><strong>Date :</strong> {{ $commande['date'] }}</p>
            <p><strong>Point de départ :</strong> {{ $commande['pointDepart'] }}</p>
            <p><strong>Destination :</strong> {{ $commande['destination'] }}</p>
            <p><strong>Coût Estimé :</strong> {{ number_format($commande['coutEstime'], 2) }} Francs</p>
        </div>
        <div class="card-footer flex space-between ">
            <a href="" class="btn btn-secondary">Annuler la commande</a>

            <a href="" class="btn btn-secondary">Retour</a>
        </div>
    </div>
</div>

<!-- Leaflet JS -->
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
        crossorigin=""></script>
<!-- Leaflet Routing Machine JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet-routing-machine/3.2.12/leaflet-routing-machine.min.js"></script>

<script>
    // Initialiser la carte avec la position de départ
    const map = L.map('map').setView([{{ $commande['latitudeDepart'] }}, {{ $commande['longitudeDepart'] }}], 13);

    // Ajouter une couche OpenStreetMap
    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '© OpenStreetMap'
    }).addTo(map);

    // Icône personnalisée pour la voiture jaune (chauffeur)
    const carIcon = L.icon({
        iconUrl: 'https://cdn-icons-png.flaticon.com/512/3202/3202926.png', // Icône voiture jaune 🚕
        iconSize: [40, 40],
        iconAnchor: [20, 40],
        popupAnchor: [0, -40]
    });

    // Icône pour le passager (bonhomme)
    const personIcon = L.icon({
        iconUrl: 'https://cdn-icons-png.flaticon.com/512/847/847969.png', // Icône bonhomme
        iconSize: [40, 40],
        iconAnchor: [20, 40],
        popupAnchor: [0, -40]
    });

    // Ajouter le marqueur du point de départ (passager)
    const startMarker = L.marker([{{ $commande['latitudeDepart'] }}, {{ $commande['longitudeDepart'] }}], { icon: personIcon })
        .addTo(map)
        .bindPopup('🚶 Point de départ: {{ $commande['pointDepart'] }}')
        .openPopup();

    // Ajouter un marqueur pour la destination
    const endMarker = L.marker([{{ $commande['latitudeDest'] }}, {{ $commande['longitudeDest'] }}])
        .addTo(map)
        .bindPopup('📍 Destination: {{ $commande['destination'] }}');

    // Ajouter un marqueur pour la position actuelle du chauffeur (qui sera mis à jour en temps réel)
    let chauffeurMarker = L.marker([{{ $commande['latitudeDepart'] }}, {{ $commande['longitudeDepart'] }}], { icon: carIcon })
        .addTo(map)
        .bindPopup('🚕 Position du chauffeur');

    // Fonction pour mettre à jour la position du chauffeur en temps réel
    function updateChauffeurPosition(lat, lng) {
        chauffeurMarker.setLatLng([lat, lng]); // Mise à jour de la position
        map.setView([lat, lng], 13); // Centrer la carte sur la position actuelle du chauffeur
    }

    // Demander l'accès à la position GPS de la machine (chauffeur)
    if (navigator.geolocation) {
        navigator.geolocation.watchPosition(
            function (position) {
                let lat = position.coords.latitude;
                let lng = position.coords.longitude;
                updateChauffeurPosition(lat, lng);
            },
            function (error) {
                console.error("Erreur de géolocalisation : ", error.message);
                alert("Impossible d'obtenir la position GPS du chauffeur !");
            },
            {
                enableHighAccuracy: true, // Précision maximale
                timeout: 5000, // Attente max avant erreur
                maximumAge: 0 // Ne pas utiliser une ancienne position
            }
        );
    } else {
        alert("La géolocalisation n'est pas supportée par votre navigateur.");
    }

    // Ajout d'un itinéraire entre le point de départ et la destination
    L.Routing.control({
        waypoints: [
            L.latLng({{ $commande['latitudeDepart'] }}, {{ $commande['longitudeDepart'] }}),
            L.latLng({{ $commande['latitudeDest'] }}, {{ $commande['longitudeDest'] }})
        ],
        routeWhileDragging: false,
        createMarker: function() { return null; } // Désactiver les marqueurs par défaut
    }).addTo(map);
</script>

</body>
</html>


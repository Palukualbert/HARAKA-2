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
        h1 {
            text-align: center;
            color: #FFD700;
        }
        .container {
            max-width: 600px;
            margin: auto;
        }
        .card {
            border: none;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            background-color: #333;
        }
        .card-header {
            background-color: #FFD700;
            color: black;
            text-align: center;
        }
        .card-body {
            color: #FFF;
        }
        .card-footer {
            background-color: #222;
            text-align: right;
        }
        .btn-secondary {
            background-color: #FFD700;
            color: black;
            border: none;
        }
        .styled-select {
            background: linear-gradient(to right, #FFD700, #000); /* Dégradé jaune -> noir */
            color: white; /* Texte en blanc */
            padding: 10px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            appearance: none; /* Supprime l'apparence par défaut */
            -webkit-appearance: none; /* Pour Safari */
            -moz-appearance: none; /* Pour Firefox */
        }

        .styled-select:focus {
            outline: none;
            border: 2px solid #FFD700; /* Bordure jaune au focus */
        }
        /* Changer la couleur du texte dans les options */
        .styled-select option {
            background: white; /* Fond blanc */
            color: black; /* Texte en noir */
        }

        /* Style de la flèche pour certains navigateurs */
        .styled-select::-ms-expand {
            display: none;
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

            <!-- Afficher les informations du chauffeur -->
            <p><strong>Nom du chauffeur :</strong> {{ $commande->vehicule->chauffeur->nom }}</p>
            <p><strong>Numéro de téléphone :</strong> {{ $commande->vehicule->chauffeur->telephone }}</p>

        </div>
        <div class="card-footer flex space-between">
            <a href="" class="btn btn-secondary">Annuler la commande</a>
            <select name="Paiement" id="paiement" class="styled-select" onchange="redirectToPayment()">
                <option value="" selected disabled>Paiement en ligne</option>
                <option value="mobile_money">Mobile Money</option>
                <option value="espece">Espèce</option>
            </select>
        </div>

        <script>
            function redirectToPayment() {
                var paiementSelect = document.getElementById("paiement");
                var selectedValue = paiementSelect.value;

                if (selectedValue === "mobile_money") {
                    window.location.href = "/payer"; // Remplace par l'URL de ta page
                }
            }
        </script>


    </div>
</div>

<!-- Leaflet JS -->
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
        crossorigin=""></script>
<!-- Leaflet Routing Machine JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet-routing-machine/3.2.12/leaflet-routing-machine.min.js"></script>

<script>
    // Configuration de la carte avec Leaflet.js
    const map = L.map('map').setView([{{ $commande['latitudeDepart'] }}, {{ $commande['longitudeDepart'] }}], 13);

    // Ajouter une couche OpenStreetMap
    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '© OpenStreetMap'
    }).addTo(map);

    // Définir une icône personnalisée (bonhomme en rouge)
    const personIcon = L.icon({
        iconUrl: 'https://cdn-icons-png.flaticon.com/512/847/847969.png', // Modèle original
        iconSize: [40, 40], // Taille de l'icône
        iconAnchor: [20, 40], // Position de l'ancre
        popupAnchor: [0, -40], // Position du popup
        className: 'custom-icon' // Appliquer un style CSS pour la couleur
    });

    // Ajouter le marqueur du point de départ avec l'icône personnalisée
    const startMarker = L.marker([{{ $commande['latitudeDepart'] }}, {{ $commande['longitudeDepart'] }}], { icon: personIcon })
        .addTo(map)
        .bindPopup('🚶 Point de départ: {{ $commande['pointDepart'] }}')
        .openPopup();

    // Ajouter un marqueur standard pour la destination
    const endMarker = L.marker([{{ $commande['latitudeDest'] }}, {{ $commande['longitudeDest'] }}])
        .addTo(map)
        .bindPopup('📍 Destination: {{ $commande['destination'] }}');

    // Ajout d'un itinéraire entre les deux points
    L.Routing.control({
        waypoints: [
            L.latLng({{ $commande['latitudeDepart'] }}, {{ $commande['longitudeDepart'] }}),
            L.latLng({{ $commande['latitudeDest'] }}, {{ $commande['longitudeDest'] }})
        ],
        routeWhileDragging: false,
        createMarker: function() { return null; }, // Désactiver les marqueurs par défaut
    }).addTo(map);
</script>

<style>
    /* 🎨 Changer la couleur de l'icône du bonhomme */
    .custom-icon img {
        filter: hue-rotate(0deg) saturate(500%) brightness(80%); /* 🔴 Rouge */
    }
</style>


</body>
</html>

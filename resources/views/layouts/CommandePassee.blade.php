<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chargement</title>
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,400,300,500,600,700" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/linearicons.css')}}">
    <link rel="stylesheet" href="{{asset('css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('css/magnific-popup.css')}}">
    <link rel="stylesheet" href="{{asset('css/nice-select.css')}}">
    <link rel="stylesheet" href="{{asset('css/animate.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/jquery-ui.css')}}">
    <link rel="stylesheet" href="{{asset('css/main.css')}}">

    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
          integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
          crossorigin=""/>
    <!-- Leaflet Routing Machine CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet-routing-machine/3.2.12/leaflet-routing-machine.css" />
    <!-- Leaflet JS -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
            integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
            crossorigin=""></script>
    <!-- Leaflet Routing Machine JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet-routing-machine/3.2.12/leaflet-routing-machine.min.js"></script>
    <style>
        /* Styles de base pour centrer l'animation de chargement */
        body, html {
            height: 100%;
            margin: 0;
            display: flex;
            flex-direction: column; /* Permet l'affichage du message en dessous */
            justify-content: center;
            align-items: center;
            background-color: #f0f0f0;
            font-family: "Poppins", sans-serif;
        }

        /* Style du spinner */
        .loader {
            border: 16px solid #FFFF00; /* Couleur du bord */
            border-top: 16px solid #000; /* Couleur du haut */
            border-radius: 50%;
            width: 120px;
            height: 120px;
            animation: spin 2s linear infinite; /* Animation de rotation */
        }

        /* Animation du spinner */
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        /* Texte de chargement */
        .loading-text {
            margin-top: 20px;
            font-size: 24px;
            color: #000000;
        }

        /* Message d'aucun chauffeur trouvé */
        .no-driver-message {
            margin-top: 20px;
            font-size: 24px;
            color: #ff0000; /* Couleur rouge pour le message d'erreur */
            display: none; /* Caché par défaut */
        }

        /* Style du bouton de réessai */
        .retry {
            margin-top: 20px;
            display: none; /* Caché par défaut */
        }
    </style>
</head>
<body>
<div class="loader" id='loader'></div>
<div class="loading-text" id="loading-text" >Recherche de taxis en cours...</div>
<div class="no-driver-message" id="no-driver-message">Aucun chauffeur trouvé.</div>
<div class="retry" id="retry">
    <button id="refresh" style="color: #0b0b0b; font-size: 15px;" class="genric-btn warning circle arrow">Re-essayer</button>
</div>

@vite('resources/js/app.js') <!-- Assurez-vous que votre fichier app.js est correctement inclus -->

<script>

    let driverFound = false; // Variable pour vérifier si un chauffeur a été trouvé


    setTimeout(()=>{
        window.Echo.channel('acceptCommandeChannel')
        .listen('CommandAcceptEvent', (e)=>{
            console.log(e.commande)

            window.location.href=`/commande-encours/${e.commande}`
        })
    }, 1000)

    // Vérifier après 10 secondes
    setTimeout(() => {
        if (!driverFound) {
            // Si aucun chauffeur n'a été trouvé, afficher le message
            document.getElementById('no-driver-message').style.display = 'block';
            document.getElementById('loader').style.display = 'none';
            document.getElementById('loading-text').style.display = 'none';
            document.getElementById('retry').style.display = 'block'; // Afficher le bouton de réessai
        }
    }, 10000); // 10000 ms = 10 secondes

    // Ajouter un gestionnaire d'événements au bouton de réessai
    document.getElementById('refresh').addEventListener('click', () => {
        location.reload(); // Recharger la page
    });
</script>

</body>
</html>

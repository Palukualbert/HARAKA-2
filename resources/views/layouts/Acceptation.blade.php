<!DOCTYPE html>
<html lang="fr">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta charset="UTF-8">
    <title>Taxi - Chauffeur</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,400,300,500,600,700" rel="stylesheet">

    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" crossorigin=""/>

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        /* Conteneur principal */
        .container-fluid {
            flex: 1;
        }

        /* Carte */
        #map {
            height: 400px;
            border-radius: 8px;
        }

        /* Conteneur des commandes centré */
        #orderContainer {
            display: flex;
            flex-direction: column;
            align-items: center; /* Centre les cartes horizontalement */
            width: 100%;
            margin-top: 20px; /* Ajuster la hauteur */
        }

        /* Cartes de commande plus grandes */
        .order-card {
            width: 100%;
            max-width: 700px; /* Largeur augmentée */
            min-height: 230px; /* Hauteur augmentée */
            opacity: 0;
            transform: translateY(-10px);
            transition: opacity 0.5s ease-in-out, transform 0.5s ease-in-out;
            padding: 20px; /* Plus d'espace intérieur */
            font-size: 16px; /* Texte plus grand */
        }

        /* Centrer les commandes sur grand écran */
        .commandes-container {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        /* Ajustement responsive */
        @media (max-width: 992px) { /* Tablettes et mobiles */
            .order-card {
                max-width: 95%; /* Prend presque toute la largeur */
                min-height: auto; /* Hauteur flexible */
                padding: 15px;
            }
        }
    </style>
</head>
<body>

<!-- Navbar Bootstrap -->
<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm fixed-top">
    <div class="container">
        <a class="navbar-brand" href="/">
            <img src="img/haraka.png" alt="Logo" height="50">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="/accepter">Acceptation</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Commande en cours</a></li>
            </ul>
        </div>
    </div>
</nav>

<!-- Contenu principal -->
<div class="container-fluid mt-5 pt-4">
    <div class="row justify-content-center">
        <div class="col-lg-8 commandes-container">
            <h3 class="mb-3 text-primary text-center">Commandes reçues</h3>
            <div id="orderContainer"></div>
        </div>
    </div>
    <div class="row justify-content-center text-center">
        <div class="col-lg-8">
            <div id="map" class="bg-light w-100"></div>
        </div>
    </div>
</div>

@vite('resources/js/app.js')
@include('partials.footer')

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<script>
    setTimeout(() => {
        window.Echo.channel('commandeChannel')
            .listen('CommandeEvent', (e) => {
                const orderDetails = JSON.parse(e.message);
                createOrderInfo(
                    orderDetails.start,
                    orderDetails.end,
                    orderDetails.distance,
                    orderDetails.duration,
                    orderDetails.price,
                    orderDetails.startCoords,
                    orderDetails.endCoords
                );
            });
    }, 100);

    function createOrderInfo(startAddress, endAddress, distance, duration, price, startCoords, endCoords) {
        const orderContainer = document.getElementById('orderContainer');

        // Création de la carte de commande Bootstrap
        const orderCard = document.createElement('div');
        orderCard.className = 'order-card card shadow-sm p-3 text-center';

        orderCard.innerHTML = `
            <h5 class="card-title text-primary">Nouvelle Commande</h5>
            <p class="mb-1"><strong>Départ :</strong> ${startAddress}</p>
            <p class="mb-1"><strong>Destination :</strong> ${endAddress}</p>
            <p class="mb-1"><strong>Distance :</strong> ${distance} km</p>
            <p class="mb-1"><strong>Durée :</strong> ${duration} minutes</p>
            <p class="mb-3"><strong>Prix :</strong> ${price} FC</p>
            <form method="POST" action="{{route('save-commande')}}">
                @csrf
        <input type="hidden" name="start" value="${startAddress}">
                <input type="hidden" name="end" value="${endAddress}">
                <input type="hidden" name="distance" value="${distance}">
                <input type="hidden" name="duration" value="${duration}">
                <input type="hidden" name="price" value="${price}">
                <input type="hidden" name="startCoords" value="${startCoords}">
                <input type="hidden" name="endCoords" value="${endCoords}">
                <button type="submit" class="btn btn-primary w-100">Accepter la commande</button>
            </form>
        `;

        // Ajouter la commande en haut
        orderContainer.prepend(orderCard);

        // Forcer le scroll vers la commande
        orderCard.scrollIntoView({ behavior: 'smooth', block: 'start' });

        // Animation d'apparition
        setTimeout(() => {
            orderCard.style.opacity = 1;
            orderCard.style.transform = 'translateY(0)';
        }, 100);
    }
</script>

</body>
</html>

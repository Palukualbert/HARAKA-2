<!DOCTYPE html>
<html lang="zxx" class="no-js">
<head>
    <!-- Mobile Specific Meta -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Favicon -->
    <link rel="shortcut icon" href="img/fav.png">
    <!-- Meta Description -->
    <meta name="description" content="">
    <!-- Meta Keyword -->
    <meta name="keywords" content="">
    <!-- meta character set -->
    <meta charset="UTF-8">
    <!-- Site Title -->
    <title>Taxi - Chauffeur</title>

    <!-- Font and CSS Includes -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,400,300,500,600,700" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/linearicons.css')}}">
    <link rel="stylesheet" href="{{asset('css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('css/magnific-popup.css')}}">
    <link rel="stylesheet" href="{{asset('css/nice-select.css')}}">
    <link rel="stylesheet" href="{{asset('css/animate.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/jquery-ui.css')}}">
    <link rel="stylesheet" href="{{asset('css/main.css')}}">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" crossorigin=""/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet-routing-machine/3.2.12/leaflet-routing-machine.css" />

    <style>
        /* General Styles */
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
            padding-top: 70px;
        }

        header {
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 1000;
            background-color: white;
            box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.1);
        }

        /* Map and Controls Styles */
        #map {
            height: 400px;
            margin-bottom: 20px;
        }

        .container {
            max-width: 100%;
        }

        .order-info {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        .order-info h4 {
            margin-bottom: 15px;
            font-weight: 600;
            font-size: 20px;
        }

        .order-info p {
            margin-bottom: 10px;
            font-size: 16px;
        }

        .order-info button {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            border: none;
            border-radius: 5px;
            background-color: #007bff;
            color: white;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .order-info button:hover {
            background-color: #0056b3;
        }

        .order-info .btn-danger {
            background-color: #dc3545;
        }

        .order-info .btn-danger:hover {
            background-color: #c82333;
        }

        /* Responsive Styles */
        @media (max-width: 768px) {
            #map {
                height: 300px;
            }
        }

        @media (max-width: 576px) {
            .order-info h4 {
                font-size: 18px;
            }

            .order-info p {
                font-size: 14px;
            }

            .order-info button {
                font-size: 14px;
            }
        }
    </style>
</head>
<body>
@include('partials.header')

<section style="margin: 40px auto; width: 90%; max-width: 1200px;">
    <!-- Map -->
    <div id="map"></div>

    <!-- Order Information -->
    <div id="orderContainer"></div>

</section>
    @vite('resources/js/app.js')
    @include('partials.footer')

<!-- JavaScript and Libraries -->
<script src="{{ asset('js/vendor/jquery-2.2.4.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" crossorigin="anonymous"></script>
<script src="{{ asset('js/vendor/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/easing.min.js') }}"></script>
<script src="{{ asset('js/hoverIntent.js') }}"></script>
<script src="{{ asset('js/superfish.min.js') }}"></script>
<script src="{{ asset('js/jquery.ajaxchimp.min.js') }}"></script>
<script src="{{ asset('js/jquery.magnific-popup.min.js') }}"></script>
<script src="{{ asset('js/jquery-ui.js') }}"></script>
<script src="{{ asset('js/jquery.nice-select.min.js') }}"></script>
<script src="{{ asset('js/mail-script.js') }}"></script>
<script src="{{ asset('js/main.js') }}"></script>

<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" crossorigin=""></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet-routing-machine/3.2.12/leaflet-routing-machine.min.js"></script>

<script>



    setTimeout(()=>{
        window.Echo.channel('commandeChannel')
            .listen('CommandeEvent',(e)=>{
                function createOrderInfo(startAddress, endAddress, orderPrice) {
                    // Créer la div principale
                    const orderInfoDiv = document.createElement('div');
                    orderInfoDiv.className = 'order-info';

                    // Créer le titre
                    const title = document.createElement('h4');
                    title.innerText = 'Nouvelle Commande';
                    orderInfoDiv.appendChild(title);

                    // Créer le point de départ
                    const startPoint = document.createElement('p');
                    startPoint.innerHTML = `<strong>Point de départ :</strong> <span id="startAddress">${startAddress}</span>`;
                    orderInfoDiv.appendChild(startPoint);

                    // Créer la destination
                    const endPoint = document.createElement('p');
                    endPoint.innerHTML = `<strong>Destination :</strong> <span id="endAddress">${endAddress}</span>`;
                    orderInfoDiv.appendChild(endPoint);

                    // Créer le prix
                    const price = document.createElement('p');
                    price.innerHTML = `<strong>Prix :</strong> <span id="orderPrice">${orderPrice} FC</span>`;
                    orderInfoDiv.appendChild(price);

                    // Créer le bouton "Accepter la commande"
                    const acceptButton = document.createElement('button');
                    acceptButton.id = 'acceptButton';
                    acceptButton.innerText = 'Accepter la commande';
                    acceptButton.addEventListener('click', function() {
                        alert(`Commande acceptée. Dirigez-vous vers ${startAddress} pour prendre le client.`);
                        // Ajoutez ici l'appel API pour informer le serveur de l'acceptation
                    });
                    orderInfoDiv.appendChild(acceptButton);

                    // Créer le bouton "Annuler la commande"
                    const cancelButton = document.createElement('button');
                    cancelButton.id = 'cancelButton';
                    cancelButton.className = 'btn-danger';
                    cancelButton.innerText = 'Annuler la commande';
                    cancelButton.style.marginTop = '10px';
                    cancelButton.addEventListener('click', function() {
                        const reason = prompt('Veuillez indiquer le motif de l\'annulation:');
                        if (reason) {
                            alert(`Commande annulée. Raison: ${reason}`);
                            // Ajoutez ici l'appel API pour informer le serveur de l'annulation
                        }
                    });
                    orderInfoDiv.appendChild(cancelButton);

                    // Ajouter le bloc de commande à l'élément de conteneur
                    document.getElementById('orderContainer').appendChild(orderInfoDiv);
                }

                // Exemple d'utilisation de la fonction pour créer une commande
                createOrderInfo('Avenue des Acacias', 'Avenue de l\'Université', 7500);


                const map = L.map('map').setView([-11.6647, 27.4794], 13);
                L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    maxZoom: 19,
                    attribution: '© OpenStreetMap'
                }).addTo(map);

                // Simuler la réception d'une commande pour le chauffeur
                let orderDetails = {
                    start: 'Avenue des Acacias',
                    end: 'Avenue de l\'Université',
                    price: 7500,
                    startCoords: [-11.6627, 27.4824],
                    endCoords: [-11.6790, 27.4720]
                };

                // Afficher les détails de la commande
                document.getElementById('startAddress').innerText = orderDetails.start;
                document.getElementById('endAddress').innerText = orderDetails.end;
                document.getElementById('orderPrice').innerText = orderDetails.price.toFixed(2);

                // Afficher l'itinéraire sur la carte
                showRoute(orderDetails.startCoords, orderDetails.endCoords, orderDetails.start, orderDetails.end);

                function showRoute(startCoords, endCoords, startAddress, endAddress) {
                    if (window.routeControl) {
                        map.removeControl(window.routeControl);
                        window.routeControl = null;
                    }

                    const startMarker = L.marker(startCoords).addTo(map)
                        .bindPopup('Point de départ: ' + startAddress)
                        .openPopup();

                    const endMarker = L.marker(endCoords).addTo(map)
                        .bindPopup('Destination: ' + endAddress);

                    window.routeControl = L.Routing.control({
                        waypoints: [
                            L.latLng(startCoords[0], startCoords[1]),
                            L.latLng(endCoords[0], endCoords[1])
                        ],
                        routeWhileDragging: true,
                        router: L.routing.osrmv1({
                            serviceUrl: 'https://router.project-osrm.org/route/v1'
                        }),
                        createMarker: function() { return null; }
                    }).addTo(map);
                }

                // Gestion du clic sur le bouton "Accepter la commande"
                document.getElementById('acceptButton').addEventListener('click', function () {
                    alert('Commande acceptée. Dirigez-vous vers ' + orderDetails.start + ' pour prendre le client.');
                    // Implémenter l'appel API pour informer le serveur de l'acceptation
                });

                // Gestion du clic sur le bouton "Annuler la commande"
                document.getElementById('cancelButton').addEventListener('click', function () {
                    const reason = prompt('Veuillez indiquer le motif de l\'annulation:');
                    if (reason) {
                        alert('Commande annulée. Raison: ' + reason);
                        // Implémenter l'appel API pour informer le serveur de l'annulation
                    }
                });

                console.log('Hi there !')
            })
    },200)


</script>

</body>
</html>

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



    setTimeout(() => {
        window.Echo.channel('commandeChannel')
            .listen('CommandeEvent', (e) => {
                // Afficher l'objet e pour voir la structure complète
                console.log('Données reçues de l\'événement :', e);

                // Accéder aux données dans la clé message et parser le JSON
                const orderDetails = JSON.parse(e.message); // Convertir la chaîne JSON en objet

                // Vérifier si les données sont récupérées correctement
                console.log('Start:', orderDetails.start);
                console.log('End:', orderDetails.end);
                console.log('Distance:', orderDetails.distance);
                console.log('Duration:', orderDetails.duration);
                console.log('Price:', orderDetails.price);

                // Utiliser ces données pour créer l'interface
                function createOrderInfo(startAddress, endAddress, distance, duration, price) {
                    const orderInfoDiv = document.createElement('div');
                    orderInfoDiv.className = 'order-info';

                    const title = document.createElement('h4');
                    title.innerText = 'Nouvelle Commande';
                    orderInfoDiv.appendChild(title);

                    const startPoint = document.createElement('p');
                    startPoint.innerHTML = `<strong>Point de départ :</strong> <span id="startAddress">${startAddress}</span>`;
                    orderInfoDiv.appendChild(startPoint);

                    const endPoint = document.createElement('p');
                    endPoint.innerHTML = `<strong>Destination :</strong> <span id="endAddress">${endAddress}</span>`;
                    orderInfoDiv.appendChild(endPoint);

                    const distanceElement = document.createElement('p');
                    distanceElement.innerHTML = `<strong>Distance :</strong> <span id="distance">${distance} km</span>`;
                    orderInfoDiv.appendChild(distanceElement);

                    const durationElement = document.createElement('p');
                    durationElement.innerHTML = `<strong>Durée :</strong> <span id="duration">${duration} minutes</span>`;
                    orderInfoDiv.appendChild(durationElement);

                    const priceElement = document.createElement('p');
                    priceElement.innerHTML = `<strong>Prix :</strong> <span id="orderPrice">${price} FC</span>`;
                    orderInfoDiv.appendChild(priceElement);

                    const acceptButton = document.createElement('button');
                    acceptButton.id = 'acceptButton';
                    acceptButton.innerText = 'Accepter la commande';
                    acceptButton.addEventListener('click', function () {
                        alert(`Commande acceptée. Dirigez-vous vers ${startAddress} pour prendre le client.`);
                    });
                    orderInfoDiv.appendChild(acceptButton);

                    const cancelButton = document.createElement('button');
                    cancelButton.id = 'cancelButton';
                    cancelButton.className = 'btn-danger';
                    cancelButton.innerText = 'Annuler la commande';
                    cancelButton.style.marginTop = '10px';
                    cancelButton.addEventListener('click', function () {
                        const reason = prompt('Veuillez indiquer le motif de l\'annulation:');
                        if (reason) {
                            alert(`Commande annulée. Raison: ${reason}`);
                        }
                    });
                    orderInfoDiv.appendChild(cancelButton);

                    document.getElementById('orderContainer').appendChild(orderInfoDiv);
                }

                // Appeler la fonction pour afficher les informations de commande
                createOrderInfo(
                    orderDetails.start,     // Point de départ
                    orderDetails.end,       // Destination
                    orderDetails.distance,  // Distance
                    orderDetails.duration,  // Durée
                    orderDetails.price      // Prix
                );
            });
    }, 200);




</script>

</body>
</html>

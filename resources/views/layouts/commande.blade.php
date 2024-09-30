    <!DOCTYPE html>
    <html lang="zxx" class="no-js">
    <head>
        <!-- Mobile Specific Meta -->
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <!-- Favicon-->
        <!--<link rel="shortcut icon" href="img/fav.png">-->
        <!-- Author Meta -->
        <meta name="author" content="colorlib">
        <!-- Meta Description -->
        <meta name="description" content="">
        <!-- Meta Keyword -->
        <meta name="keywords" content="">
        <!-- meta character set -->
        <meta charset="UTF-8">
        <!-- Site Title -->
        <title>Taxi</title>

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
            header {
                position: fixed;
                top: 0;
                width: 100%;
                z-index: 1000;
                background-color: white;
            }
            body {
                padding-top: 70px;
            }
            /* Styles pour les boutons */
            .btn {
                border: none;
                padding: 10px 20px;
                font-size: 16px;
                cursor: pointer;
                transition: background-color 0.3s, color 0.3s, transform 0.2s;
            }

            /* Style pour le bouton Itinéraire */
            #routeButton {
                background-color: black;
                color: white;
            }

            /* Effet de survol pour le bouton Itinéraire */
            #routeButton:hover {
                background-color: #333;
                color: #f1f1f1;
                transform: scale(1.05);
            }

            /* Style pour le bouton Commander */
            #orderButton {
                background-color: #FFFF00;
                color: black;
                border: 2px solid #000;
            }

            /* Effet de survol pour le bouton Commander */
            #orderButton:hover {
                background-color: #f1f1f1;
                color: #000;
                transform: scale(1.05);
            }

            #map {
                height: 400px;
                z-index: 0;
            }
            .leaflet-routing-container.leaflet-control-custom {
                position: absolute;
                top: 20px; /* Ajustez cette valeur pour positionner la boîte verticalement */
                right: 20px; /* Ajustez cette valeur pour positionner la boîte horizontalement */
                z-index: 1000; /* Assurez-vous que la boîte est bien au-dessus de la carte */
                background: white;
                padding: 10px;
                box-shadow: 0 0 15px rgba(0,0,0,0.5);
                border-radius: 5px;
                max-width: 300px; /* Limitez la largeur si nécessaire */
            }
            #controls {
                margin: 10px 0;
                padding: 10px;
                background: #f9f9f9;
                border-radius: 5px;
                display: flex;
                flex-direction: column;
                gap: 10px;
            }
            #controls label {
                margin-right: 10px;
            }
            #controls input,
            #controls button {
                padding: 10px;
                font-size: 16px;
                border-radius: 5px;
                width: 100%;
                box-sizing: border-box;
            }
            #routeButton, #orderButton {
                border: none;
                cursor: pointer;
                flex-grow: 1;
                width: 48%;
                display: inline-block;
            }
            #routeButton {
                background-color: #007bff;
                color: white;
            }
            #routeButton:hover {
                background-color: #0056b3;
            }
            #orderButton {
                background-color: #ffc107;
                color: white;
            }
            #orderButton:hover {
                background-color: #e0a800;
            }
            .spinner {
                border: 4px solid rgba(0, 0, 0, 0.1);
                width: 24px;
                height: 24px;
                border-radius: 50%;
                border-left-color: #000;
                animation: spin 1s infinite linear;
                display: inline-block;
                vertical-align: middle;
                margin-left: 10px;
            }
            @keyframes spin {
                0% { transform: rotate(0deg); }
                100% { transform: rotate(360deg); }
            }
            #loadingOverlay {
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: rgba(255, 255, 255, 0.9);
                display: flex;
                align-items: center;
                justify-content: center;
                z-index: 2000;
                visibility: hidden;
            }
            #loadingMessage {
                text-align: center;
                font-size: 24px;
                font-weight: bold;
            }
            @media (min-width: 768px) {
                #controls {
                    flex-direction: row;
                    align-items: center;
                    justify-content: space-between;
                }
                #controls .form-group {
                    flex-grow: 1;
                    margin-right: 10px;
                }
                #controls button {
                    width: auto;
                    margin-top: 0;
                }
                .leaflet-control-custom {
                    position: fixed;
                    top: 232px;
                    right: 70px;
                    background: white;
                    padding: 20px;
                    box-shadow: 0 0 15px rgba(0,0,0,0.5);
                    z-index: 1000;
                    color: black;
                }
            }
        </style>
    </head>
    <body>
    @include('partials.header')

    <section style="margin: 80px auto 40px auto; width: 90%;">
        <div id="controls" class="container mt-4">
            <div class="form-group">
                <label for="start" class="form-label">Point de départ :</label>
                <input type="text" id="start" class="form-control" placeholder="Nom de l'avenue">
            </div>
            <div class="form-group">
                <label for="end" class="form-label">Destination :</label>
                <input type="text" id="end" class="form-control" placeholder="Nom de l'avenue">
            </div>
            <div class="form-group">
                <label for="category">Catégorie</label>
                <select class="form-control" id="category" name="nomCategorie">
                    <option value="">Choisissez une categorie</option>
                    <option value="1">VIP</option>
                    <option value="2">ORDINAIRE</option>
                </select>
            </div>
            <div style="display: flex; width: 100%; margin-top: 10px; gap: 20px;">
                <button id="routeButton" class="btn" style="flex: 1; max-width: 45%; background-color: black; color: white"> Itinéraire</button>
            </div>

            <form style="display: flex; width: 100%; margin-top: 10px; gap: 20px;" id="orderForm" method="POST" action="{{ route('order.submit') }}">
                @csrf
                <input type="hidden" name="start" id="formStart">
                <input type="hidden" name="end" id="formEnd">
                <input type="hidden" name="startCoords" id="formStartCoords">
                <input type="hidden" name="endCoords" id="formEndCoords">
                <input type="hidden" name="distance" id="formDistance">
                <input type="hidden" name="duration" id="formDuration">
                <input type="hidden" name="price" id="formPrice">
                <button id="orderButton" type="submit" class="btn btn-outline-info" style="flex: 1; max-width: 45%; background-color: #FFFF00; color: black">Commander</button>
            </form>
        </div>

        <div id="routeDialog" style="display: none; position: absolute; top: 10px; right: 10px; background: white; padding: 10px; border: 1px solid #ccc; border-radius: 5px; z-index: 1000;">
            <button id="closeRouteDialog" style="background-color: red; color: white; border: none; padding: 5px; cursor: pointer;">X</button>
            <div id="routeDetails"></div>
        </div>


        <div id="map" style="width: 100%; height: 400px;"></div>

        <div id="loadingOverlay">
            <div id="loadingMessage">
                Recherche de taxi en cours<span class="spinner"></span>
            </div>
        </div>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/leaflet.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet-routing-machine/3.2.12/leaflet-routing-machine.min.js"></script>

        <script>
            const map = L.map('map').setView([-11.6647, 27.4794], 13);
            L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
                attribution: '© OpenStreetMap'
            }).addTo(map);

            const API_KEY = '4948b4ccd6a84509857ce4712d71329a';

            function geocodeAddress(address, callback) {
                fetch(`https://api.opencagedata.com/geocode/v1/json?q=${encodeURIComponent(address)}, Lubumbashi&key=${API_KEY}&language=fr`)
                    .then(response => response.json())
                    .then(data => {
                        if (data.results.length > 0) {
                            const { lat, lng } = data.results[0].geometry;
                            callback([parseFloat(lat), parseFloat(lng)]);
                        } else {
                            alert("Adresse non trouvée : " + address);
                        }
                    })
                    .catch(err => {
                        alert("Erreur de géocodage : " + err);
                    });
            }

            let routeDetails = {}; // Variable globale pour stocker les détails de l'itinéraire

            function showRoute(startCoords, endCoords, startAddress, endAddress) {
                // Supprimer la route précédente si elle existe
                if (window.routeControl) {
                    map.removeControl(window.routeControl);
                    window.routeControl = null;
                }

                // Ajouter les marqueurs de départ et de destination
                const startMarker = L.marker(startCoords).addTo(map)
                    .bindPopup('Point de départ: ' + startAddress)
                    .openPopup();
                const endMarker = L.marker(endCoords).addTo(map)
                    .bindPopup('Destination: ' + endAddress);

                // Centrer la carte entre les deux points
                const centerLat = (startCoords[0] + endCoords[0]) / 2;
                const centerLng = (startCoords[1] + endCoords[1]) / 2;
                map.setView([centerLat, centerLng], 13);

                // Ajouter la route sur la carte
                window.routeControl = L.Routing.control({
                    waypoints: [
                        L.latLng(startCoords[0], startCoords[1]),
                        L.latLng(endCoords[0], endCoords[1])
                    ],
                    routeWhileDragging: true,
                    router: L.routing.osrmv1({
                        serviceUrl: 'https://router.project-osrm.org/route/v1'
                    }),
                    createMarker: function() { return null; },
                    show: false,
                    addWaypoints: false,
                    draggableWaypoints: false,
                }).on('routesfound', function(e) {
                    const routes = e.routes;
                    const summary = routes[0].summary;

                    // Stocker les détails de l'itinéraire dans la variable globale
                    routeDetails = {
                        startAddress,
                        endAddress,
                        startCoords,
                        endCoords,
                        distanceInKm: (summary.totalDistance / 1000).toFixed(2),
                        timeInMinutes: Math.round(summary.totalTime / 60),
                        price: ((summary.totalDistance / 1000) * 1500).toFixed(2)
                    };

                    document.getElementById('formStart').value = startAddress;
                    document.getElementById('formEnd').value = endAddress;
                    document.getElementById('formStartCoords').value = startCoords;
                    document.getElementById('formEndCoords').value = endCoords;
                    document.getElementById('formDistance').value = routeDetails.distanceInKm;
                    document.getElementById('formDuration').value = routeDetails.timeInMinutes;
                    document.getElementById('formPrice').value = routeDetails.price;

                    // Créer la boîte de dialogue personnalisée
                    const routeInfo = `
            <div class="route-info card leaflet-routing-container leaflet-control leaflet-control-custom">
                <div class="card-body">
                    <h3 class="card-title">Information de l'itinéraire</h3>
                    <p><strong>Point de départ :</strong> ${startAddress}</p>
                    <p><strong>Destination :</strong> ${endAddress}</p>
                    <p><strong>Distance :</strong> ${routeDetails.distanceInKm} km</p>
                    <p><strong>Durée estimée :</strong> ${routeDetails.timeInMinutes} minutes</p>
                    <p><strong>Prix :</strong> ${routeDetails.price} FC</p>
                    <button class="btn btn-danger" onclick="closeRouteInfo()">Fermer</button>
                </div>
            </div>
        `;

                    const routeInfoContainer = document.createElement('div');
                    routeInfoContainer.innerHTML = routeInfo;
                    document.getElementById('map').appendChild(routeInfoContainer);
                }).addTo(map);
            }


            // Fonction pour fermer la boîte de dialogue personnalisée
            function closeRouteInfo() {
                const routeInfoContainer = document.querySelector('.leaflet-control-custom');
                if (routeInfoContainer) {
                    routeInfoContainer.remove();
                }
            }




            document.getElementById('routeButton').addEventListener('click', function () {
                const start = document.getElementById('start').value;
                const end = document.getElementById('end').value;

                if (start && end) {
                    geocodeAddress(start, function(startCoords) {
                        geocodeAddress(end, function(endCoords) {
                            showRoute(startCoords, endCoords, start, end);
                        });
                    });
                } else {
                    alert("Veuillez entrer des noms d'avenues pour les deux points.");
                }
            });
        </script>
    </section>

    @include('partials.footer')

    <script src="{{ asset('js/vendor/jquery-2.2.4.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
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

    </body>
    </html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chargement</title>
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
    </style>
</head>
<body>
<div class="loader"></div>
<div class="loading-text">Recherche de taxis en cours...</div>
<div class="no-driver-message" id="no-driver-message">Aucun chauffeur trouvé.</div>

@vite('resources/js/app.js') <!-- Assurez-vous que votre fichier app.js est correctement inclus -->

<script>
    let driverFound = false; // Variable pour vérifier si un chauffeur a été trouvé

    // Simuler la réception d'un événement après 5 secondes pour le test
    // 5 secondes pour la simulation

    // Vérifier après 10 secondes
    setTimeout(() => {
        if (!driverFound) {
            // Si aucun chauffeur n'a été trouvé, afficher le message
            document.getElementById('no-driver-message').style.display = 'block';
        }
    }, 10000); // 10000 ms = 10 secondes
</script>
</body>
</html>

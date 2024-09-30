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
            justify-content: center;
            align-items: center;
            background-color: #f0f0f0;
            font-family: "Poppins", sans-serif;
        }

        /* Style du spinner */
        .loader {
            border: 16px solid #FFFF00; /* Light grey */
            border-top: 16px solid #000; /* Blue */
            border-radius: 50%;
            width: 120px;
            height: 120px;

            animation: spin 2s linear infinite;
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
    </style>
</head>
<body>
<div class="loader"></div>
<div class="loading-text">Recherche de taxis encours  ...</div>
@vite('resources/js/app.js')
</body>
<script >
    setTimeout(()=>{
        window.Echo.channel('testingChannel')
            .listen('testingEvent',(e)=>{
                console.log('Hi there !')
            })
    },200)
</script>
</html>

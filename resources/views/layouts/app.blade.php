<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard')</title>

    <!-- Liens CSS -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,400,300,500,600,700" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/linearicons.css') }}">
    <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">

    <style>
        /* Footer */
        .footer-area {
            padding: 10px 0;
            background-color: #000;
            margin-top: 30px;
        }

        .footer-text {
            color: white;
            font-size: 14px;
            text-align: center;
        }

        /* Header */
        #header {
            background-color: #000;
            width: 100%;
        }
        /* Menu principal */
        .nav-menu {
            display: flex;
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .nav-menu li {
            margin-left: 20px;
        }

        .nav-menu a {
            text-decoration: none;
            color: white;
            font-weight: 500;
        }

        /* Alignement du menu à gauche sur grand écran */
        @media (min-width: 769px) {
            #nav-menu-container {
                margin-left: auto; /* Décale le menu à gauche */
            }
        }
        /* Menu mobile */
        @media (max-width: 768px) {
            .navbar-toggle {
                display: flex;
                cursor: pointer;
                font-size: 30px;
                color: white;
                background: none;
                border: none;
            }

            .nav-menu {
                display: none;
                flex-direction: column;
                width: 100%;
                text-align: center;
                background: #000;
                position: absolute;
                top: 60px;
                z-index: 99;
            }

            .nav-menu.open {
                display: flex !important;
            }

            .nav-menu li {
                margin: 10px 0;
            }
        }

        /* Affichage normal du menu sur grand écran */
        @media (min-width: 769px) {
            .navbar-toggle {
                display: none;
            }

            .nav-menu {
                display: flex; /* Affiche le menu normalement */
                justify-content: flex-end;
            }
        }

    </style>
</head>

<body>

<!-- 🟢 HEADER -->
<header id="header">
    <div class="header-top"></div>
    <div class="container">
        <!-- Toggle à gauche -->
        <div class="navbar-toggle" onclick="toggleMenu()">&#9776;</div>

        <!-- Logo à droite -->
        <a href="/"><img src="{{ asset('img/haraka.png') }}" style="height: 60px; width: 110px; max-width: 100%;" alt="Haraka" /></a>
        <!-- Menu -->
        <nav id="nav-menu-container" style="">
            <ul class="nav-menu">
                <li><a href="#">Ajouter Chauffeur</a></li>
                <li><a href="#">Générer Rapport</a></li>
                <li><a href="#">Se déconnecter</a></li>
            </ul>
        </nav>
    </div>
</header>

<!-- 🟠 CONTENU DYNAMIQUE -->
<div class="container" style="margin-top: 10%">
    @yield('content')
</div>

<!-- 🔵 FOOTER -->
<footer class="footer-area">
    <div class="container text-center">
        <p class="footer-text">
            &copy; <script>document.write(new Date().getFullYear());</script> Tous droits réservés | Haraka
        </p>
    </div>
</footer>

<!-- Scripts -->
<script src="{{ asset('js/vendor/jquery-2.2.4.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="{{ asset('js/vendor/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/main.js') }}"></script>

<script>
    function toggleMenu() {
        var menu = document.querySelector('#nav-menu-container .nav-menu');
        if (menu) {
            menu.classList.toggle('open');
        }
    }
</script>


</body>
</html>

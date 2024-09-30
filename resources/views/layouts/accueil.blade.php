<!DOCTYPE html>
<html lang="zxx" class="no-js">
<head>
    <!-- Mobile Specific Meta -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Favicon-->
    <link rel="shortcut icon" href="">
    <!-- Author Meta -->
    <meta name="author" content="colorlib">
    <!-- Meta Description -->
    <meta name="description" content="">
    <!-- Meta Keyword -->
    <meta name="keywords" content="">
    <!-- meta character set -->
    <meta charset="UTF-8">
    <!-- Site Title -->
    <title>Haraka</title>

    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,400,300,500,600,700" rel="stylesheet">
    <!--
    CSS
    ============================================= -->
    <link rel="stylesheet" href="{{asset('css/linearicons.css')}}">
    <link rel="stylesheet" href="{{asset('css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('css/magnific-popup.css')}}">
    <link rel="stylesheet" href="{{asset('css/nice-select.css')}}">
    <link rel="stylesheet" href="{{asset('css/animate.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/jquery-ui.css')}}">
    <link rel="stylesheet" href="{{asset('css/main.css')}}">
    <style>
        @font-face {
            font-family: "Loved by the king";
        }
        h6{
            font-family: "Loved by the king";
        }

        /* CSS supplémentaire pour le centrage */
        .banner-area {
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            min-height: 100vh; /* Assure que la section prend toute la hauteur de l'écran */
        }

        .banner-content {
            margin: 0 auto;
        }

        @media (max-width: 768px) {
            .banner-content {
                padding: 0 15px; /* Ajoutez un peu de padding pour les petits écrans */
            }
        }

        @media (max-width: 576px) {
            .banner-content {
                width: 100%; /* S'assure que le contenu prend toute la largeur de l'écran */
                text-align: center;
            }

            .banner-content h6,
            .banner-content p,
            .banner-content a {
                font-size: 16px; /* Ajuste la taille de la police pour les petits écrans */
            }
        }
    </style>
</head>
<body>
<!-- #header -->
@include('partials.header')
<!-- #header -->
<!-- start banner Area -->
<section class="banner-area relative" id="home">
    <div class="overlay overlay-bg"></div>
    <div class="container">
        <div class="row fullscreen d-flex align-items-center justify-content-between">
            <div class="banner-content col-lg-6 col-md-6 ">
                <h6 class="text-white" style="text-align: center;">Commandez en quelques clics!</h6>
                <p class="pt-10 pb-10 text-white" style="text-align: center; font-size: 15px">
                    Réservez votre taxi en ligne et arrivez à destination en toute sérénité.
                </p>
                <div style="text-align: center;">
                    <a href="/service" class="genric-btn warning circle arrow" style="color: #0b0b0b; font-size: 15px;" >Passer votre commande<span class="lnr lnr-arrow-right"></span></a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End banner Area -->

<script src="{{ asset('js/vendor/jquery-2.2.4.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="{{ asset('js/vendor/bootstrap.min.js') }}"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBhOdIF3Y9382fqJYt5I_sswSrEw5eihAA"></script>
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

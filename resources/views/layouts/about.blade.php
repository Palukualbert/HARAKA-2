
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
    .footer-area {
        padding: 10px 0; /* Réduit la hauteur du footer */
        background-color: #000000; /* Couleur de fond, ajustez si nécessaire */
    }

    .footer-text {
        margin: 0; /* Supprime les marges autour du texte */
        font-size: 14px; /* Ajustez la taille de la police si nécessaire */
        color: white; /* Couleur du texte */
    }

    .footer-area .container {
        display: flex;
        justify-content: center; /* Centre le contenu horizontalement */
        align-items: center; /* Centre le contenu verticalement */
        height: 5%; /* Assure que le footer occupe toute la hauteur disponible dans son conteneur */
    }
    .single-service span {
        font-size: 30px; /* Ajuste la taille de l'icône */
        display: block;
        margin-bottom: 15px; /* Espace entre l'icône et le titre */
        color: #333; /* Couleur de l'icône */
    }

</style>
<body>
@include('partials.header')
<section class="services-area section-gap">
    <div class="container py-5">
        <div class="row section-title">
            <h1 style="font-family: 'Loved by the king'">Qui sommes-nous ?</h1>
            <p>Nous sommes une entreprise dédiée à faciliter la recherche de taxis en temps réel. Grâce à notre solution innovante, nous connectons rapidement les clients aux chauffeurs pour tout déplacement.
                Notre mission est de rendre vos trajets plus fluides et efficaces.</p>
        </div>
        <div class="row">
            <div class="col-lg-4 single-service">
                <span class="lnr lnr-car"></span>
                <a href="/service"><h4>Commande d'un taxi</h4></a>
                <p>Réservez un taxi en quelques étapes simples grâce à notre application. Choisissez votre point de départ, indiquez votre destination et sélectionnez la catégorie de véhicule souhaitée (VIP ou Ordinaire).</p>
            </div>
            <div class="col-lg-4 single-service">
                <span class="fa fa-dollar"></span>
                <a href="/paiement"><h4>Paiement en ligne</h4></a>
                <p>Effectuez vos paiements en ligne de manière sécurisée et pratique. Notre application offre des options de paiement flexibles pour que vous puissiez régler vos trajets en toute simplicité, directement depuis l'application.</p>
            </div>
            <div class="col-lg-4 single-service">
                <span class="lnr lnr-map"></span>
                <a href="#"><h4>Suivi en temps réel</h4></a>
                <p>Suivez l'arrivée de votre taxi en temps réel grâce à notre suivi intégré. Visualisez votre position sur la carte ainsi que celle du chauffeur qui a accepté votre commande.</p>
            </div>
        </div>
    </div>
</section>

<footer class="footer-area">
    <div class="container text-center">
        <p class="footer-text">
            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
            Copyright &copy;<script>document.write(new Date().getFullYear());</script> Tous Droits reservés | <i class="fa fa-html5" aria-hidden="true"></i> by <span> haraka</span>
        </p>
    </div>
</footer>

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

</body>

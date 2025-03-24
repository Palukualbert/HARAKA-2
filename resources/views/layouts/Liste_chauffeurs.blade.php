<!DOCTYPE html>
<html lang="zxx" class="no-js">
<head>
    <!-- Mobile Specific Meta -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Favicon-->
    <!--<link rel="shortcut icon" href="img/haraka.png">-->
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
    <link rel="stylesheet" href="{{asset('css/linearicons.css')}}">
    <link rel="stylesheet" href="{{asset('css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('css/magnific-popup.css')}}">
    <link rel="stylesheet" href="{{asset('css/nice-select.css')}}">
    <link rel="stylesheet" href="{{asset('css/animate.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/jquery-ui.css')}}">
    <link rel="stylesheet" href="{{asset('css/main.css')}}">

    <style>
        .icon-btn {
            margin-right: 15px; /* Espacement entre les icônes */
            color: #000; /* Couleur par défaut des icônes */
            text-decoration: none;
            font-size: 25px;
        }
        .icon-btn.add {
            color: #007bff; /* Bleu */
        }
        .icon-btn.edit {
            color: #28a745; /* Vert */
        }
        .icon-btn.delete {
            color: #dc3545; /* Rouge */
        }

        /* Custom styles for responsive design */
        header .container {
            max-width: 100%;
            padding-left: 15px;
            padding-right: 15px;
        }

        header h3 {
            margin: 0;
            font-size: 20px;
        }

        .header-top {
            padding: 5px 0;
        }

        @media (max-width: 768px) {
            header h3 {
                font-size: 18px;
            }
            .nav-menu {
                display: flex;
                flex-direction: column;
                align-items: center;
            }
            .nav-menu li {
                margin-bottom: 10px;
            }
        }

        @media (max-width: 576px) {
            .table thead {
                display: none;
            }
            .table, .table tbody, .table tr, .table td {
                display: block;
                width: 100%;
            }
            .table tr {
                margin-bottom: 15px;
            }
            .table td {
                text-align: right;
                padding-left: 50%;
                position: relative;
            }
            .table td::before {
                content: attr(data-label);
                position: absolute;
                left: 15px;
                width: 50%;
                padding-right: 15px;
                text-align: left;
                font-weight: bold;
            }
            .btn {
                width: 100%;
                margin-bottom: 10px;
            }
        }

         .footer-area {
             padding: 10px 0; /* Réduit la hauteur du footer */
             background-color: #000000; /* Couleur de fond, ajustez si nécessaire */
             margin-top: 30%;

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
    </style>
</head>

<body>

<header id="header">
    <div class="header-top"></div>
    <div class="container main-menu">
        <div class="row align-items-center justify-content-between d-flex">
            <a href="/"><img src="img/haraka.png" style="height: 60px; width: 110px; max-width: 100%;" alt="" title="" /></a>
            <nav id="nav-menu-container">
                <ul class="nav-menu">
                    <li><a href="#">Ajouter Chauffeur</a></li>
                    <li><a href="#">Générer Rapport</a></li>
                    <li><a href="#">Se déconnecter</a></li>
                </ul>
            </nav><!-- #nav-menu-container -->
        </div>
    </div>
</header>

<section style="margin: 70px auto; width: 90%; max-width: 1200px;">

    <div class="section-top-border">
        <h3 class="mb-30" style="font-family: 'Rockwell Condensed'; font-size: 30px">ADMINISTRATION DES CHAUFFEURS</h3>
        <a href="/ajouterChauffeur" class="btn btn-primary mb-4">Ajouter un Chauffeur</a>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead class="table-dark" style="color: yellow">
                <tr>
                    <th scope="col">N°</th>
                    <th scope="col">Téléphone</th>
                    <th scope="col">Mot de passe</th>
                    <th scope="col">Marque du véhicule</th>
                    <th scope="col">Immatriculation</th>
                    <th scope="col">Couleur</th>
                    <th scope="col">Catégorie</th>
                    <th scope="col">Actions</th>
                </tr>
                </thead>
                <tbody>
                @php $i=0 ; @endphp
                @foreach($chauffeurs as $chauffeur)
                    @php $i ++ ; @endphp
                    <tr>
                        <td data-label="N°">{{ $i }}</td>
                        <td data-label="Numéro de téléphone">{{$chauffeur->telephone}} </td>

                        <td data-label="Numéro de téléphone">{{$chauffeur->mot_de_passe}} </td>

                        @foreach($chauffeur->vehicules as $vehicule)

                            <td data-label="Marque du véhicule">{{$vehicule->marque}}</td>
                            <td data-label="Immatriculation">{{$vehicule->plaqueImmat}}</td>
                            <td data-label="Couleur">{{$vehicule->couleurVehicule}}</td>

                            @if(!is_null($vehicule->categorie))
                                <td data-label="Catégorie">{{$vehicule->categorie->nomCategorie}}</td>
                            @else
                                <td data-label="Catégorie">Aucune catégorie</td>
                            @endif


                            <td data-label="Actions">
                                <!-- Bouton Modifier -->
                                <a href="/chauffeur/{{$chauffeur->id}}/edit" class="btn btn-warning btn-sm">Modifier</a>
                                <!-- Bouton Supprimer -->
                                <form action="{{ route('chauffeur.delete', $chauffeur->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce chauffeur ?');">Supprimer</button>
                                </form>
                                <!-- Bouton Générer PDF -->
                                <a href="{{ route('chauffeur.rapport.pdf', $chauffeur->id) }}" class="btn btn-info btn-sm" target="_blank">
                                    <i class="fa fa-file-pdf-o"></i> PDF
                                </a>
                            </td>

                        @endforeach
                    </tr>
                @endforeach

                </tbody>
            </table>
        </div>
    </div>

</section>

<footer class="footer-area">
    <div class="container text-center">
        <p class="footer-text">
            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
            Copyright &copy;<script>document.write(new Date().getFullYear());</script> Tous Droits reservés | <i class="fa fa-html5" aria-hidden="true"></i> par <span> haraka</span>
        </p>
    </div>
</footer>

<script src="{{ asset('js/vendor/jquery-2.2.4.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
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

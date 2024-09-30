<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Formulaire Chauffeurs</title>
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,400,300,500,600,700" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/linearicons.css')}}">
    <link rel="stylesheet" href="{{asset('css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('css/magnific-popup.css')}}">
    <link rel="stylesheet" href="{{asset('css/nice-select.css')}}">
    <link rel="stylesheet" href="{{asset('css/animate.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/jquery-ui.css')}}">
    <link rel="stylesheet" href="{{asset('css/main.css')}}">
</head>
<body>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8" style="bottom: 10px">
            <div class="card mt-5">
                <div class="card-header text-center">
                    <h4>{{$mode == 'create' ? 'Ajouter un Chauffeur' : 'Modifier Chauffeur'}}</h4>
                </div>
                <div class="card-body">
                    <form action="{{ $mode == 'create' ? route('chauffeur.store') : route('chauffeur.update', $chauffeur->id) }}" method="post">
                        @csrf
                        @if($mode == 'edit')
                            @method('PUT')
                        @endif

                        <div class="form-group">
                            <label for="phoneNumber">Nom du chauffeur</label>
                            <input type="text" class="form-control" id="phoneNumber" name="nom" placeholder="Entrez le nom du chaffeur" value="{{ old('nom', $chauffeur->nom ?? '') }}">
                        </div>

                        <div class="form-group">
                            <label for="phoneNumber">Adresse du chauffeur</label>
                            <input type="text" class="form-control" id="phoneNumber" name="adresse" placeholder="Entrez l'adresse du chauffeur" value="{{ old('adresse', $chauffeur->adresse ?? '') }}">
                        </div>

                        <div class="form-group">
                            <label for="phoneNumber">Numéro de téléphone</label>
                            <input type="text" class="form-control" id="phoneNumber" name="telephone" placeholder="Entrez le numéro de téléphone" value="{{ old('telephone', $chauffeur->telephone ?? '') }}">
                        </div>

                        <div class="form-group">
                            <label for="vehicleBrand">Marque du véhicule</label>
                            <input type="text" class="form-control" id="vehicleBrand" name="marque" placeholder="Entrez la marque du véhicule" value="{{ old('marque', $chauffeur->vehicules->first()->marque ?? '') }}">
                        </div>

                        <div class="form-group">
                            <label for="registrationNumber">Immatriculation</label>
                            <input type="text" class="form-control" id="registrationNumber" name="plaqueImmat" placeholder="Entrez le numéro d'immatriculation" value="{{ old('plaqueImmat', $chauffeur->vehicules->first()->plaqueImmat ?? '') }}">
                        </div>

                        <div class="form-group">
                            <label for="color">Couleur</label>
                            <input type="text" class="form-control" id="color" name="couleurVehicule" placeholder="Entrez la couleur du véhicule" value="{{ old('couleurVehicule', $chauffeur->vehicules->first()->couleurVehicule ?? '') }}">
                        </div>

                        <div class="form-group">
                            <label for="category">Catégorie</label>
                            <select class="form-control" id="category" name="categorie_id">
                                <option value="">Choisissez une categorie</option>
                                <option value="1">VIP</option>
                                <option value="2">ORDINAIRE</option>
                            </select>
                            </div>

                        <div class="text-center">
                            <button type="submit" class="btn btn-warning" style="color: black">
                                {{ $mode == 'create' ? 'Ajouter un chauffeur' : 'Modifier Chauffeur' }}
                            </button>
                        </div>
                    </form>


                </div>
            </div>
        </div>
    </div>
</div>

@include('partials.footer');


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

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

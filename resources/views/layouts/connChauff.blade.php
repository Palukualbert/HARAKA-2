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
</head>
<body>
<div class="container py-lg-5" style="margin-top: 70px">
    <div class="row justify-content-center">
        <div class="col-md-6"> <!-- Réduction de la largeur -->
            <div class="card">
                <div style="text-align: center;">
                    <a href="/"><img src="img/haraka.png" style="height: 90px; width: 110px; max-width: 100%;" alt="" title="" /></a>
                </div>
                <div class="card-header" style="text-align: center">Connexion</div>

                <div class="card-body">
                    <form method="POST" action="">
                        @csrf
                        <div class="form-group">
                            <label for="telephone" class="form-label">Phone :</label>
                            <div class="input-group">

                                <input id="telephone" type="tel" class="form-control @error('telephone') is-invalid @enderror" name="telephone" value="{{ old('telephone') }}" autocomplete="telephone" autofocus>
                            </div>

                            @error('telephone')
                            <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group mt-3">
                            <label for="mot_de_passe" class="form-label">Mot de passe :</label>
                            <input id="mot_de_passe" type="password" class="form-control @error('mot_de_passe') is-invalid @enderror" name="mot_de_passe" autocomplete="current-password">

                            @error('mot_de_passe')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group mt-4 text-center">
                            <button type="submit" class="btn btn-warning" style="color: black;">Se connecter</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>



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

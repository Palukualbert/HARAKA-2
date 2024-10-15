<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CinetPay-SDK-PHP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">
    <style>
        body {
            background: linear-gradient(135deg, #ffdd00 50%, #000000 50%);
            font-family: 'Arial', sans-serif;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .card {
            margin-top: 50px;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0px 10px 30px rgba(0, 0, 0, 0.1);
            background-color: #ffffff;
            max-width: 800px;
            width: 100%;
        }
        .heading {
            font-size: 28px;
            font-weight: bold;
            color: #343a40;
            text-align: center;
            margin-bottom: 25px;
            letter-spacing: 1px;
        }
        .form-group p {
            font-size: 15px;
            font-weight: 600;
            color: #495057;
            margin-bottom: 5px;
        }
        .form-control, .form-select {
            border-radius: 8px;
            border: 1px solid #ced4da;
            padding: 12px;
            font-size: 16px;
        }
        .form-control:focus, .form-select:focus {
            border-color: #80bdff;
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
        }
        .btn-warning {
            background-color: rgba(255, 255, 0, 0.96);
            border-color: rgba(255, 255, 0, 0.96);
            border-radius: 8px;
            padding: 12px 25px;
            font-size: 18px;
            font-weight: bold;
            transition: all 0.3s ease;
        }
        .btn-warning:hover {
            background-color: rgba(255, 255, 0, 0.96);
            border-color: rgba(255, 255, 0, 0.96);
        }
        .btn i {
            margin-left: 8px;
        }
        .card-details {
            padding: 0 20px;
        }
        @media (max-width: 768px) {
            .card {
                padding: 20px;
            }
            .heading {
                font-size: 24px;
            }
        }
    </style>
</head>

<body>
<div class="container d-flex justify-content-center">
    <div class="card">
        <p class="heading">PAIEMENT MOBILE MONEY</p>
        <form action="{{ route('client.submit') }}" method="post" class="card-details">
            <div class="row mb-4">
                <div class="col-md-6">
                    <div class="form-group">
                        <p class="text-dark">Nom</p>
                        <input type="text" class="form-control" name="customer_name" id="customer_name">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <p class="text-dark">Prénom</p>
                        <input type="text" class="form-control" name="customer_surname" id="customer_surname">
                    </div>
                </div>
            </div>

            <div class="row mb-4">
                <div class="col-md-6">
                    <div class="form-group">
                        <p class="text-dark">Montant</p>
                        <input type="number" class="form-control" name="amount" id="amount">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <p class="text-dark">Devise</p>
                        <select class="form-select" name="currency" id="currency">
                            <option value="CDF">CDF</option>
                            <option value="XOF">XOF</option>
                            <option value="XAF">XAF</option>
                            <option value="GNF">GNF</option>
                            <option value="USD">USD</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="row mb-4">
                <div class="col-12">
                    <div class="form-group">
                        <p class="text-dark">Description</p>
                        <input type="text" class="form-control" name="description">
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-center">
                <button type="submit" name="valider" class="btn btn-warning">
                    Valider <i class="fas fa-arrow-right"></i>
                </button>
            </div>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>

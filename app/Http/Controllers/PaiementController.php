<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaiementController extends Controller
{
    public function paiement(){
        return view('layouts.cinetpay.paiement');
    }
    public function submit(){
        return view('client.submit');
    }
}

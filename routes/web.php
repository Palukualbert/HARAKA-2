<?php

use Illuminate\Support\Facades\Route;
Route::get('/', function () {
    return view('layouts.accueil');
});
Route::get('/service', [\App\Http\Controllers\CommandeController::class, 'commande']);

Route::get('/ajouterChauffeur', [\App\Http\Controllers\ChauffeurController::class,'ajouterChauffeur']);

Route::post('/enregistrer', [\App\Http\Controllers\ChauffeurController::class,'enregistrer_chauffeur'])->name('chauffeur.store');

Route::get('/chauffeur/{id}/edit', [\App\Http\Controllers\ChauffeurController::class, 'edit'])->name('chauffeur.edit');

Route::put('/chauffeur/{id}', [\App\Http\Controllers\ChauffeurController::class, 'update'])->name('chauffeur.update');

Route::delete('/chauffeur/{id}/delete', [App\Http\Controllers\ChauffeurController::class, 'destroy'])->name('chauffeur.delete');

Route::get('/liste', [\App\Http\Controllers\ChauffeurController::class,'liste'])->name('chauffeur.liste');

Route::get('/payer',[\App\Http\Controllers\PaiementController::class, 'paiement'])->name('client.payer');
Route::post('/valider',[\App\Http\Controllers\PaiementController::class, 'submit'])->name('client.submit');
Route::get('/paiement', function () {
    return view('layouts.paiement');
});
Route::get('/about', function () {
    return view('layouts.about');
});

Route::get('/login',[\App\Http\Controllers\AuthChauffeurController::class, 'login'])->name('chauffeur.login');

Route::post('/login',[\App\Http\Controllers\AuthChauffeurController::class, 'auth']);

Route::get('/accepter',[\App\Http\Controllers\ChauffeurController::class, 'accepter'])->name('chauffeur.accepter');

Route::post('/order/submit', [\App\Http\Controllers\CommandeController::class, 'submit'])->name('order.submit');

// Testing
Route::get('/commande', function () {
    return view('layouts.CommandePassee');
});

Route::get('/test', function (){
    event(new \App\Events\testingEvent());
    return 'done';
});

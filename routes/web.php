<?php

use App\Http\Controllers\AdminController;
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

Route::get('/chauffeur/{id}/rapport/pdf', [\App\Http\Controllers\ChauffeurController::class, 'generatePdf'])->name('chauffeur.rapport.pdf');
Route::get('/liste', [\App\Http\Controllers\ChauffeurController::class,'liste'])->name('chauffeur.liste');
Route::get('/commandes', [CommandeController::class, 'index'])->name('commande.liste');
Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
Route::get('/payer',[\App\Http\Controllers\PaiementController::class, 'paiement'])->name('client.payer');
Route::post('/payment', [\App\Http\Controllers\PaiementController::class, 'Payment'])->name('payment');
Route::match(['get','post'],'/notify_url', [\App\Http\Controllers\PaiementController::class, 'notify_url'])->name('notify_url');
Route::match(['get','post'],'/return_url', [\App\Http\Controllers\PaiementController::class, 'return_url'])->name('return_url');

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

Route::post('/save-commande',[\App\Http\Controllers\CommandeController::class, 'saveCommande'])->name('save-commande');
// Testing
Route::get('/commande', function () {
    return view('layouts.CommandePassee');
});

Route::get('/commande-encours/{id}', [\App\Http\Controllers\CommandeController::class, 'commande_encours'])->name('commande-encours');
Route::get('/commande-encours-chauffeur/{id}', [\App\Http\Controllers\CommandeController::class, 'commande_encours_chauffeur'])->name('commande-encours-chauffeur');

Route::get('/test', function (){
    event(new \App\Events\CommandAcceptEvent());
    return 'done';
});


Route::get('/env',function (){
   dd(env('APIKEY'));
});

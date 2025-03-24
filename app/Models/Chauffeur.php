<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Chauffeur extends Authenticatable
{
    use HasFactory;
    protected $fillable = ['nom','adresse','password','mot_de_passe','telephone', 'disponible'];

    protected $hidden = [
        'password',
        'remember_token',
    ];
    public function getAuthIdentifierName()
    {
        return 'telephone'; // Retourner le nom de la colonne utilisée pour l'authentification
    }
    public function vehicules()
    {
        return $this->hasMany(Vehicule::class);
    }
    public function commandes()
    {
        return $this->hasManyThrough(Commande::class, Vehicule::class);
    }

}

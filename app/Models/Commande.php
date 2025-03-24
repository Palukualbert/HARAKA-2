<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commande extends Model
{
    use HasFactory;
    protected $fillable = [
        'date',
        'statut',
        'pointDepart',
        'destination',
        'coutEstime',
        'longitudeDepart',
        'latitudeDepart',
        'latitudeDest',
        'longitudeDest',
        'client_id',
        'vehicule_id',
    ];

    public function vehicule()
    {
        return $this->belongsTo(Vehicule::class);
    }

    public function chauffeur()
    {
        // Relation via le véhicule
        return $this->hasOneThrough(Chauffeur::class, Vehicule::class, 'id', 'vehicule_id', 'vehicule_id', 'id');
    }
}

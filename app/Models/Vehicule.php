<?php

namespace App\Models;

use App\Http\Controllers\CommandeController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicule extends Model
{
    use HasFactory;
    protected $fillable = ['marque', 'plaqueImmat', 'couleurVehicule', 'chauffeur_id', 'categorie_id'];

    public function categorie()
    {
        return $this->belongsTo(Categorie::class, 'categorie_id');
    }

    public function chauffeur()
    {
        return $this->belongsTo(Chauffeur::class, 'chauffeur_id');
    }

    public function commandes(){
        return $this->hasMany(Commande::class, 'vehicule_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

   
class Voiture extends Model
{
    use HasFactory;

    protected $fillable = [
        'matricule',
        'marque',
        'modele',
        'nbre_place',
        'transmission',
        'type_carburant',
        'prix_chauffeur_jour',
        'prix_voiture_jour',
        'image_voiture',
        'proprietaire_id',
    ];

    public function proprietaire()
    {
        return $this->belongsTo(Proprietaire::class);
    }
    public function reservations() {
        return $this->hasMany(Reservation::class);
    }
    
}
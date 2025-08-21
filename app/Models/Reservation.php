<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;
     
    protected $fillable = [
          'client_id',
          'voiture_id',
          'date_debut', 
          'date_fin', 
          'avec_chauffeur', 
          'statut'
    ];
    

    public function client() {
        return $this->belongsTo(Client::class);
    }
    
    public function voiture() {
        return $this->belongsTo(Voiture::class);
    }

    public function paiement() {
        return $this->hasOne(paiement::class);
    }
    
}

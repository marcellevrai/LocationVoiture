<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class paiement extends Model
{
    use HasFactory;

    protected $fillable = [
        'reservation_id',   
        'reference', 
    ];

    public function Reservation(){
        return $this->belongsTo(Reservation::class);
    }
}

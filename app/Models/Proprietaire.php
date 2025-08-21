<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Voiture;


class proprietaire extends Authenticatable
{
    use HasApiTokens, Notifiable;

    protected $fillable = [
        'name',
        'firstname',
        'number',
        'email',
        'password',
    ];
    public function voitures()
    {
    return $this->hasMany(Voiture::class);
    }

}
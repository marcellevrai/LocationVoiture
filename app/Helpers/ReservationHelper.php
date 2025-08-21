<?php

namespace App\Helpers;

use App\Models\Reservation;
use Carbon\Carbon;

class ReservationHelper
{
    public static function verifierReservationsExpirees()
    {
        $reservations = Reservation::where('statut', 'en attente')->get();

        foreach ($reservations as $reservation) {
            if ($reservation->created_at->diffInHours(now()) >= 24) {
                $reservation->update(['statut' => 'expirée']);
            }
        }
    }
}

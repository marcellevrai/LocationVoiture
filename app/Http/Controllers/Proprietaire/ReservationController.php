<?php

namespace App\Http\Controllers\Proprietaire;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\ReservationHelper;


class ReservationController extends Controller
{
    
    public function __construct()
    {
        ReservationHelper::verifierReservationsExpirees();
    }
    
    public function index(Request $request)
{
    $proprio = auth('proprietaire')->user();

    $search = $request->input('search');

    $reservations = \App\Models\Reservation::with(['client', 'voiture'])
        ->whereHas('voiture', function ($q) use ($proprio) {
            $q->where('proprietaire_id', $proprio->id);
        })
        ->when($search, function ($query, $search) {
            $query->whereHas('client', function ($q) use ($search) {
                $q->where('name', 'like', "%$search%")
                  ->orWhere('firstname', 'like', "%$search%");
            });
        })
        ->latest()
        ->paginate(10);

    return view('proprietaire.reservation.index', compact('reservations', 'search'));
}

}

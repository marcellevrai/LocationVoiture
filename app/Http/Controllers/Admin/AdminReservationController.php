<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use Illuminate\Http\Request;
use App\Helpers\ReservationHelper;

class AdminReservationController extends Controller
{
     public function __construct()
    {
        ReservationHelper::verifierReservationsExpirees();
    }
    public function index()
    {
        $reservations = Reservation::with('voiture', 'client')->latest()->get();
        return view('admin.reservationsIndex', compact('reservations'));
    }

    public function searchByStatut(Request $request)
    {
        $statut = $request->input('statut');

        $query = Reservation::with('voiture', 'client')->latest();

        if ($statut) {
            $query->where('statut', $statut);
        }

        $reservations = $query->get();

        return response()->json([
            'html' => view('admin.reservationslist', compact('reservations'))->render(),
        ]);
    }
}

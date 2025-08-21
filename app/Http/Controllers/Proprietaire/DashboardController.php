<?php

namespace App\Http\Controllers\Proprietaire;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use app\helpers\ReservationHelper;

class DashboardController extends Controller
{
    public function __construct()
    {
        ReservationHelper::verifierReservationsExpirees();
    }
    
    public function dashboard()
    {

        $proprio = auth('proprietaire')->user();
        $reservationsConfirmees = \App\Models\Reservation::where('statut', 'confirmé')
        ->whereHas('voiture', function ($q) use ($proprio) {
            $q->where('proprietaire_id', $proprio->id);
        })
        ->get();

        $revenusEstimes = $reservationsConfirmees->sum(function ($reservation) {
        $jours = \Carbon\Carbon::parse($reservation->date_debut)
            ->diffInDays(\Carbon\Carbon::parse($reservation->date_fin)) + 1;

        $voiture = $reservation->voiture;
        $total = $voiture->prix_voiture_jour * $jours;

        if ($reservation->avec_chauffeur && $voiture->prix_chauffeur_jour) {
            $total += $voiture->prix_chauffeur_jour * $jours;
        }

        return $total;
        });


        return view('proprietaire.dashboard', [
            'totalVoitures' => $proprio->voitures()->count(),
            'revenusEstimes' => $revenusEstimes,
            'totalReservations' => \App\Models\Reservation::whereHas('voiture', function ($q) use ($proprio) {
                $q->where('proprietaire_id', $proprio->id);
            })->count(),
            'dernieresReservations' => \App\Models\Reservation::with(['voiture', 'client'])
                ->whereHas('voiture', function ($q) use ($proprio) {
                    $q->where('proprietaire_id', $proprio->id);
                })
                ->latest()->take(5)->get(),
                
        ]);
}

}

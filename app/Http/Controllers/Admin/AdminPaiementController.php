<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\paiement;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AdminPaiementController extends Controller
{
    public function index()
{
    $paiements = paiement::with('reservation.client', 'reservation.voiture')
                    ->latest()->take(10)->get();
    foreach ($paiements as $paiement) {
        $reservation = $paiement->reservation;
        $voiture = $reservation->voiture;

        $jours = Carbon::parse($reservation->date_debut)->diffInDays(Carbon::parse($reservation->date_fin)) + 1;

        $total = $voiture->prix_voiture_jour * $jours;

        if ($reservation->avec_chauffeur && $voiture->prix_chauffeur_jour) {
            $total += $voiture->prix_chauffeur_jour * $jours;
        }

        $paiement->total_calculé = $total;
    }

    return view('admin.paiementindex', compact('paiements'));
}
public function search(Request $request)
{
    $query = $request->input('query');

    $paiements = Paiement::with('reservation.client', 'reservation.voiture')
        ->where(function ($q) use ($query) {
            $q->whereHas('reservation.client', function ($q2) use ($query) {
                $q2->where('name', 'like', "%$query%")
                   ->orWhere('firstname', 'like', "%$query%");
            })
            ->orWhereDate('paiements.created_at', $query);
        })
        ->latest()
        ->get();      

    foreach ($paiements as $paiement) {
        $reservation = $paiement->reservation;
        $voiture = $reservation->voiture;

        $jours = \Carbon\Carbon::parse($reservation->date_debut)
            ->diffInDays(\Carbon\Carbon::parse($reservation->date_fin)) + 1;

        $total = $voiture->prix_voiture_jour * $jours;

        if ($reservation->avec_chauffeur && $voiture->prix_chauffeur_jour) {
            $total += $voiture->prix_chauffeur_jour * $jours;
        }

        $paiement->total_calculé = $total;
    }

    return response()->json([
        'html' => view('admin.paiementliste', compact('paiements'))->render()
    ]);
}


}

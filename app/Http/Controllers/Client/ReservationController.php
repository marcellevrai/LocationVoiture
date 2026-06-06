<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\paiement;
use Illuminate\Http\Request;
use App\Models\Voiture;

use Carbon\Carbon;
use App\Models\Reservation;
use Barryvdh\DomPDF\Facade\Pdf;



class ReservationController extends Controller
{
            
    public function create(Voiture $voiture)
   {
    return view('client.reservations.create', compact('voiture'));
   }


public function store(Request $request, Voiture $voiture)
{
    $request->validate([
        'date_debut' => 'required|date|after_or_equal:today',
        'date_fin' => 'required|date|after_or_equal:date_debut',
        'avec_chauffeur' => 'nullable|boolean',
    ]);

    // Vérifier chevauchement
    $existe = Reservation::where('voiture_id', $voiture->id)
    ->where('statut', 'confirmé')
    ->where(function($q) use ($request) {
        $q->whereBetween('date_debut', [$request->date_debut, $request->date_fin])
          ->orWhereBetween('date_fin', [$request->date_debut, $request->date_fin])
          ->orWhere(function($q2) use ($request) {
              $q2->where('date_debut', '<=', $request->date_debut)
                 ->where('date_fin', '>=', $request->date_fin);
          });
    })
    ->exists();


    if ($existe) {
        return back()->with('error', 'Cette voiture est déjà réservée à ces dates. Veuillez en choisir une autre.');
    }

    // Calcul du prix (non stocké)
    $jours = Carbon::parse($request->date_debut)->diffInDays(Carbon::parse($request->date_fin)) + 1;
    $total = $voiture->prix_voiture_jour * $jours;

    if ($request->avec_chauffeur && $voiture->prix_chauffeur_jour) {
        $total += $voiture->prix_chauffeur_jour * $jours;
    }

    // Enregistrement de la réservation (sans stocker le prix)
    $reservation = Reservation::create([
        'client_id' => auth()->guard('client')->id(),
        'voiture_id' => $voiture->id,
        'date_debut' => $request->date_debut,
        'date_fin' => $request->date_fin,
        'avec_chauffeur' => $request->avec_chauffeur ?? false,
        'statut' => 'en attente',
    ]);

    return redirect()->route('reservation.facture', $reservation->id)->with('success', 'Réservation enregistrée. Statut : en attente.');
}

// facture methode 
    public function facture(Reservation $reservation)
   {
    // Vérifie si le client est bien propriétaire de la réservation
    if ($reservation->client_id !== auth('client')->id()) {
        abort(403);
    }

    $voiture = $reservation->voiture;

    $jours = \Carbon\Carbon::parse($reservation->date_debut)
        ->diffInDays(\Carbon\Carbon::parse($reservation->date_fin)) + 1;

    $total = $voiture->prix_voiture_jour * $jours;

    if ($reservation->avec_chauffeur && $voiture->prix_chauffeur_jour) {
        $total += $voiture->prix_chauffeur_jour * $jours;
    }

    return view('client.reservations.facture', compact('reservation', 'voiture', 'jours', 'total'));
   }

   // affichage des reservation
   public function index()
   {
    $client = auth('client')->user();

    $reservations = $client->reservations()->with('voiture')->latest()->get();

    return view('client.reservations.index', compact('reservations'));
  }

  
  public function paiementSimule(Request $request, Reservation $reservation)
  {
    if ($reservation->client_id !== auth('client')->id()) {
        abort(403);
    }

    $request->validate([
        'nom_carte' => 'required|string|max:255',
        'numero_carte' => 'required|digits:16',
        'expiration_mois' => 'required|digits:2',
        'expiration_annee' => 'required|digits:2',
        'cs' => 'required|digits:3',
    ]);
    
    // Simulation de paiement réussi
    $reservation->update(['statut' => 'confirmé']);

    Paiement::create([
        'reservation_id' => $reservation->id,
        'reference' => strtoupper(uniqid('PAY_')), // Génère une référence unique
    ]);

    return redirect()->route('reservation.index')->with('success', 'Paiement confirmé. Merci !');
}

  public function telechargerFacture(Reservation $reservation){
    if ($reservation->client_id !== auth('client')->id()){
        abort('403');
    }
    if ($reservation->statut !== 'confirmé'){
        return redirect()->back()->with('error', 'la feccture est disponible seulement apres confirmation du paiement');
    }

    $voiture = $reservation->voiture;

    $jours = \Carbon\Carbon::parse($reservation->date_debut)
        ->diffInDays(\Carbon\Carbon::parse($reservation->date_fin)) + 1;

    $total = $voiture->prix_voiture_jour * $jours;

    if ($reservation->avec_chauffeur && $voiture->prix_chauffeur_jour) {
        $total += $voiture->prix_chauffeur_jour * $jours;
    }

    $pdf = Pdf::loadView('client.reservations.FacturePdf', compact('reservation', 'voiture', 'jours', 'total'));

    $filename = 'Facture_reservation_'.$reservation->id.'.pdf';

    return $pdf->download($filename);
  }
    public function annuler($id)
    {
        $reservation = Reservation::findOrFail($id);

        if ($reservation->statut == 'en attente') {
            $reservation->statut = 'annulée';
            $reservation->save();

            return back()->with('success', 'Réservation annulée avec succès.');
        }

        return back()->with('error', 'Cette réservation ne peut pas être annulée.');
    }




}

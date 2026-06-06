<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\proprietaire;
use App\Models\Reservation;
use App\Models\Voiture;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    
    public function index(){
        $totalClients = Client::count();
        $totalReservations = Reservation::count();
        $totalProprietaires = proprietaire::count();
        $totalVoitures = Voiture::count();
        $reservationRecentes = Reservation::with('voiture', 'client')->latest()->take(5)->get();
        $reservationsParStatut = Reservation::selectRaw('statut, COUNT(*) as total')
        ->groupBy('statut')
        ->pluck('total', 'statut');


        $data = [
            'totalClients' => $totalClients,
            'totalReservations' => $totalReservations,
            'totalVoitures' => $totalVoitures,
            'totalProprietaires' => $totalProprietaires,
            'reservationRecentes' => $reservationRecentes,
            'reservationsParStatut' => $reservationsParStatut,
        ];

        return view('admin.dashboard', $data);

    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use App\Models\Voiture;
use Illuminate\Http\Request;

class AdminvoitureController extends Controller
{
    public function index()
    {
        $voitures = Voiture::latest()->take(10)->get();
        return view('admin.voituresIndex', compact('voitures'));
    }

    public function search(Request $request)
    {
        $search = $request->input('query');
        $voitures = Voiture::where('matricule', 'like', "%$search%")->latest()->get();

        return response()->json([
            'html' => view('admin.voituresliste', compact('voitures'))->render()
        ]);
    }
    public function reservations($voiture_id)
    {
        $voiture = Voiture::with('proprietaire')->findOrFail($voiture_id);
        $reservations = Reservation::where('voiture_id', $voiture_id)
                        ->with('client')
                        ->latest()
                        ->get();

        return view('admin.voiturereservation', compact('voiture', 'reservations'));
    }

}

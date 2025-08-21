<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Voiture;

class VoiturePubliqueController extends Controller
{
    public function index()
    {
        $voitures = Voiture::latest()->paginate(6); // pagination 6 voitures
        return view('client.voitures.index', compact('voitures'));
    }

    public function show(Voiture $voiture)
    {
        return view('client.voitures.show', compact('voiture'));
    }


    public function filtre(Request $request)
   {
    $voitures = Voiture::query();

    if ($request->filled('q')) {
        $voitures->where(function ($query) use ($request) {
            $query->where('marque', 'like', '%' . $request->q . '%')
                  ->orWhere('modele', 'like', '%' . $request->q . '%');
        });
    }

    if ($request->filled('transmission')) {
        $voitures->where('transmission', $request->transmission);
    }

    if ($request->filled('carburant')) {
        $voitures->where('type_carburant', $request->carburant);
    }

    $voitures = $voitures->latest()->paginate(6);

    return view('client.voitures.index', compact('voitures'));
    }

    
}

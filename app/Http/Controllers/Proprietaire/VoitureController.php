<?php

namespace App\Http\Controllers\Proprietaire;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Voiture;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class VoitureController extends Controller
{
    public function create()
    {
        return view('proprietaire.voitures.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'matricule' => 'required|unique:voitures',
            'marque' => 'required|string|max:100',
            'modele' => 'required|string|max:100',
            'nbre_place' => 'required|integer|min:1',
            'transmission' => 'required|string',
            'type_carburant' => 'required|string',
            'prix_chauffeur_jour' => 'nullable|integer',
            'prix_voiture_jour' => 'required|integer',
            'image_voiture' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('image_voiture')) {
            $imagePath = $request->file('image_voiture')->store('voitures', 'public');
        }

        Voiture::create([
            'matricule' => $request->matricule,
            'marque' => $request->marque,
            'modele' => $request->modele,
            'nbre_place' => $request->nbre_place,
            'transmission' => $request->transmission,
            'type_carburant' => $request->type_carburant,
            'prix_chauffeur_jour' => $request->prix_chauffeur_jour,
            'prix_voiture_jour' => $request->prix_voiture_jour,
            'image_voiture' => $imagePath,
            'proprietaire_id' => Auth::guard('proprietaire')->id(),
        ]);

        return redirect()->back()->with('success', 'Voiture enregistrée avec succès.');
    }
    //voiture liste function
    public function index()
   {
      $voitures = Auth::guard('proprietaire')->user()->voitures()->latest()->get();
      return view('proprietaire.voitures.index', compact('voitures'));
   }


     //modification de voiture 
   public function update(Request $request, Voiture $voiture)
    {
    

    $request->validate([
        'prix_voiture_jour' => 'required|numeric|min:0',
        'prix_chauffeur_jour' => 'nullable|numeric|min:0',
    ]);

    $voiture->update([
        'prix_voiture_jour' => $request->prix_voiture_jour,
        'prix_chauffeur_jour' => $request->prix_chauffeur_jour,
    ]);

    return redirect()->route('proprietaire.voitures.index')->with('success', 'Prix mis à jour avec succès.');
   }
   
    //suppressionn de la voiture 
   public function destroy(Voiture $voiture)
   {
       
   
       // Suppression du fichier image si présent
       if ($voiture->image_voiture && Storage::disk('public')->exists($voiture->image_voiture)) {
           Storage::disk('public')->delete($voiture->image_voiture);
       }
   
       $voiture->delete();
   
       return redirect()->route('proprietaire.voitures.index')->with('success', 'Voiture supprimée avec succès.');
   }
   


}

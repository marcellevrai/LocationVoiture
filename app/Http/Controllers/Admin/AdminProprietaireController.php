<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\proprietaire;
use App\Models\Voiture;
use Illuminate\Http\Request;

class AdminProprietaireController extends Controller
{
    public function index(){
        $proprietaires = proprietaire::latest()->take(10)->get();
        
        return view('admin.proprietaires', compact('proprietaires'));
    }

    public function search(Request $request){

        $search = $request->input('query');

        $proprietaires = proprietaire::where('name', 'like', "%$search%")->orWhere('firstname', 'like', "%$search%")->orWhere('email', 'like', "%$search%")->latest()->get();
        
        return response()->json([
            'html' => view('admin.proprietairesliste', compact('proprietaires'))->render()
        ]);
    }

    public function voiture($id){

        $proprietaire = proprietaire::findOrfail($id);

        $voitures = $proprietaire->voitures()->withCount('reservations')->latest()->get();

        return view('admin.ProprioVoiture', compact('proprietaire', 'voitures'));

    }
}

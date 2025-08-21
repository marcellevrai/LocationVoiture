<?php

namespace App\Http\Controllers\Proprietaire;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProprietaireController extends Controller
{
    public function profil()
{
    $proprio = auth('proprietaire')->user();
    return view('proprietaire.profil.index', compact('proprio'));
}

public function updateProfil(Request $request)
{
    $request->validate([
        'firstname' => 'required|string|max:255',
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:proprietaires,email,' . auth('proprietaire')->id(),
        'number' => 'required|string|max:20',
    ]);

    $proprio = auth('proprietaire')->user();
    $proprio->update($request->only(['firstname', 'name', 'email', 'number']));

    return back()->with('success', 'Profil mis à jour avec succès ✅');
}
public function updatePassword(Request $request)
{
    $request->validate([
        'current_password' => 'required',
        'new_password' => 'required|confirmed|min:6',
    ]);

    $user = auth('proprietaire')->user();

    if (!Hash::check($request->current_password, $user->password)) {
        return back()->with('error', 'Le mot de passe actuel est incorrect.');
    }

    $user->update(['password' => bcrypt($request->new_password)]);
 
    return back()->with('success', 'Mot de passe mis à jour avec succès.');
}

}

<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Client;

class ClientController extends Controller
{
    // ✅ Affichage du profil
    public function profil()
    {
        $client = auth('client')->user();
        return view('client.profil.index', compact('client'));
    }

    // ✅ Mise à jour des informations du profil
    public function updateProfil(Request $request)
    {
        $request->validate([
            'firstname' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:clients,email,' . auth('client')->id(),
            'number' => 'required|string|max:20',
        ]);

        $client = auth('client')->user();
        $client->update($request->only(['firstname', 'name', 'email', 'number']));

        return back()->with('success', 'Profil mis à jour avec succès ✅');
    }

    // ✅ Mise à jour du mot de passe
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:6|confirmed',
        ]);

        $client = auth('client')->user();

        if (!Hash::check($request->current_password, $client->password)) {
            return back()->with('error', 'Le mot de passe actuel est incorrect ❌');
        }

        $client->update([
            'password' => Hash::make($request->new_password),
        ]);

        return back()->with('success', 'Mot de passe mis à jour avec succès 🔐');
    }
}

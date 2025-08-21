<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Proprietaire;

class ProprietaireAuthController extends Controller
{
    public function showLoginForm()
    {
        return view('proprietaire.auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::guard('proprietaire')->attempt($credentials)) {
            $request->session()->regenerate();
           // $proprio = auth('proprietaire')->user();
            return redirect()->intended('/proprietaire/dashboard'); 
           // return view('proprietaire.dashboard'); 

        }

        return back()->withErrors([
            'email' => 'Email ou mot de passe incorrect.',
        ]);
    }

    public function showRegisterForm()
    {
        return view('proprietaire.auth.register');
    }

    public function register(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'firstname' => 'required|string|max:255',
            'number' => 'required|string|max:20',
            'email' => 'required|email|unique:proprietaires',
            'password' => 'required|confirmed|min:8',
        ]);

        $proprietaire = Proprietaire::create([
            'name' => $data['name'],
            'firstname' => $data['firstname'],
            'number' => $data['number'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        Auth::guard('proprietaire')->login($proprietaire);

        return redirect()->route('proprietaire.login'); 
    }

    public function logout(Request $request)
    {
        Auth::guard('proprietaire')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('proprietaire.login');
    }
}

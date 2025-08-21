<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;

class AdminClientController extends Controller
{
    public function index(){
        $clients = Client::latest()->take(10)->get();
        return view('admin.clients', compact('clients'));
    }

    public function search(Request $request){
        $search = $request->input('query');
        $clients = Client::where('name', 'like', "%$search%")->orWhere('firstname', 'like', "%$search%")->orwhere('email', 'like', "%$search%")->latest()->get();

        return response()->json([
            'html' => view('admin.clientsliste', compact('clients'))->render()
        ]);
        
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Clients;
use Illuminate\Http\Request;



class ClientsController extends Controller
{
    public function index()
    {
            $clients = Clients::all();
        return view('clients.index', compact('clients'));
    }

    public function create()
    {
        return view('clients.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'full_name'=> 'required|max:50',
            'phone_number' =>'required|max:20',
            'email' => 'required|max:100'
        ]);

        Clients::create([
            'full_name' => $request->full_name,
            'phone_number' => $request->phone_number,
            'email' => $request->email,
        ]);
        return redirect()->route('clients.index')->with('success', 'cliente agregado correctamente');
    }

    public function edit(Clients $client)
    {

        return view('clients.edit', compact('client'));
    }

    public function update(Request $request, Clients $client)
    {
         $request->validate([
            'full_name'=> 'required|max:50',
            'phone_number' =>'required|max:20',
            'email' => 'required|max:100'
         ]);
         $client->update($request->all());

         return redirect()->route('clients.index')->with('success', 'cliente editado correctamente');

    }

    public function destroy(Clients $client)
    {
        $client->delete();
        return redirect()->route('clients.index')->with('success', 'cliente eliminado correctamente');
    }
};

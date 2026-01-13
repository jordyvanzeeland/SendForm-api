<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\Client;
use Illuminate\Http\Request;

class ClientsController extends Controller
{
    /**
     * Require authentication for all methods in this controller.
     */

    public function __construct(){
        $this->middleware('auth:api');
    }

    /**
     * Retrieve all registered clients
     */

    public function getAllClients(){
        $clients = Client::get();
        return response()->json($clients, 200);
    }

    /**
     * Retrieve a single client by it's id
     * If client is not found, then it returns a 404 error
     */

    public function getClientByID(int $clientid){
        $client = Client::find($clientid);

        if(!client){
            return response()->json(['message' => 'Client not found']);
        }

        return response()->json($client, 200);
    }

    /**
     * Register a new client
     */

     public function newClient(Request $request){
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'domain' => 'required|string|max:255',
            'mailto' => 'required|string|max:255',
            'active' => 'required|integer'
        ]);

        $newClient = Client::create($validated);
        return response()->json(['message' => 'New client registered', 'client' => $newClient], 201);
     }

     /**
     * Update a registered client, given by it's id.
     * If client is not found, then it returns a 404 error
     */

     public function updateClient(Request $request, int $clientid){
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'domain' => 'required|string|max:255',
            'mailto' => 'required|string|max:255',
            'active' => 'required|integer'
        ]);

        $client = Client::find($clientid);

        if(!client){
            return response()->json(['message' => 'Client not found']);
        }

        $client->update($validated);
        return response()->json(['message' => 'Client updated', 'client' => $client], 200);
     }

     /**
     * Delete a registered client, given by it's id.
     * If client is not found, then it returns a 404 error
     */

     public function deleteClient(int $clientid){
        $client = Client::find($clientid);

        if(!client){
            return response()->json(['message' => 'Client not found']);
        }
        
        $client->delete();
        return response()->json(['message' => 'Client deleted', 'client' => $client], 200);
     }
}
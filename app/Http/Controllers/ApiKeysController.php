<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\ApiKey;
use Illuminate\Http\Request;

class ApiKeysController extends Controller
{
    /**
     * Require authentication for all methods in this controller.
     */

    public function __construct(){
        $this->middleware('auth:api');
    }

    /**
     * Retrieve all registered api keys
     */

    public function getAllKeys(){
        $keys = ApiKey::get();
        return response()->json($keys, 200);
    }

    /**
     * Retrieve a single api key by it's id
     * If key is not found, then it returns a 404 error
     */

    public function getKeyByID(int $keyid){
        $key = ApiKey::find($keyid);

        if(!key){
            return response()->json(['message' => 'Api key not found']);
        }

        return response()->json($key, 200);
    }

    /**
     * Register a new api key
     */

     public function newKey(Request $request){
        $validated = $request->validate([
            'clientid' => 'required|integer',
            'key' => 'required|string|max:255'
        ]);

        $newKey = ApiKey::create($validated);
        return response()->json(['message' => 'New api key registered', 'key' => $newKey], 201);
     }

     /**
     * Update a registered api key, given by it's id.
     * If key is not found, then it returns a 404 error
     */

     public function updateKey(Request $request, int $keyid){
        $validated = $request->validate([
            'clientid' => 'required|integer',
            'key' => 'required|string|max:255'
        ]);

        $key = Client::find($keyid);

        if(!key){
            return response()->json(['message' => 'Api key not found']);
        }

        $key->update($validated);
        return response()->json(['message' => 'Api key updated', 'key' => $client], 200);
     }

     /**
     * Delete a registered api key, given by it's id.
     * If key is not found, then it returns a 404 error
     */

     public function deleteKey(int $keyid){
        $key = Client::find($keyid);

        if(!key){
            return response()->json(['message' => 'Api key not found']);
        }
        
        $key->delete();
        return response()->json(['message' => 'Api key deleted', 'key' => $client], 200);
     }
}
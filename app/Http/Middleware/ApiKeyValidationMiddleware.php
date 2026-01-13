<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\ApiKey;

class ApiKeyValidationMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        $key = $request->header('X-API-KEY');
        
        if(!$key){
            return response()->json(['message' => 'API key is missing'], 401);
        }

        $apiKey = ApiKey::with('client')->where('key', $key)->first();

        if($request->host() !== $apiKey->client->domain){
            return response()->json(['message' => 'Request is coming from an unknown host : ' . $request->host()]);
        }

        if(!$apiKey || !$apiKey->client->active){
            return response()->json(['message' => 'Invalid API key'], 400);
        }

        $request->attributes->set('client', $apiKey->client);

        return $next($request);
    }
}
<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\GenericMail;

class MailController extends Controller
{
    public function send(Request $request){
        $data = $request->validate([
            'from_name' => 'required|string',
            'from_email' => 'required|email',
            'subject' => 'required|string',
            'message' => 'required|string',
        ]);

        $client = $request->get('client');

        if(!$client){
            return response()->json(["message" => "Client not found"]);
        }

        Mail::to($client->mailto)->send(new GenericMail($data, $client->name));
        return response()->json(['status' => 'sended to ' . $client->mailto]);
    }
}
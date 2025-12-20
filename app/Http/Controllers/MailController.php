<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

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
        Mail::to($client->mailto)->send(new GenericMail($data));

        return response()->json(['status' => 'sent']);
    }
}
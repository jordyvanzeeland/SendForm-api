<?php

namespace App\Mail;
use App\Models\Client;
use Illuminate\Mail\Mailable;

class GenericMail extends Mailable
{
    public function __construct(public array $data, public string $client) {}

    public function build()
    {
        return $this->from('no-reply@jordyvanzeeland.nl', $this->client)
            ->replyTo($this->data['from_email'], $this->data['from_name'])
            ->subject('Contactformulier ingevuld')
            ->view('emails.generic')
            ->with(['from_name' => $this->data['from_name'], 'from_email' => $this->data['from_email'], 'content' => $this->data['message']]);
    }
}
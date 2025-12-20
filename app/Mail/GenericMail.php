<?php

namespace App\Mail;

class GenericMail extends Mailable
{
    public function __construct(public array $data) {}

    public function build()
    {
        return $this->from($this->data['from_email'], $this->data['from_name'])
            ->subject($this->data['subject'])
            ->view('emails.generic')
            ->with(['content' => $this->data['message']]);
    }
}
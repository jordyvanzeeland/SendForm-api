<?php

namespace App\Mail;
use Illuminate\Mail\Mailable;

class GenericMail extends Mailable
{
    public function __construct(public array $data) {}

    public function build()
    {
        return $this->from(config('mail.from.address'), $this->data['from_name'])
            ->replyTo($this->data['from_email'], $this->data['from_name'])
            ->subject($this->data['subject'])
            ->view('emails.generic')
            ->with(['from_name' => $this->data['from_name'], 'from_email' => $this->data['from_email'], 'content' => $this->data['message']]);
    }
}
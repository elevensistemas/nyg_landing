<?php

namespace App\Mail;

use App\Models\ContactRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactRequestReceived extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public ContactRequest $contactRequest)
    {
    }

    public function build(): static
    {
        return $this->subject('Nueva consulta desde el sitio web — NYG Transporte')
            ->markdown('emails.contact-request-received', ['contactRequest' => $this->contactRequest]);
    }
}

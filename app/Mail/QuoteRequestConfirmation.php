<?php

namespace App\Mail;

use App\Models\QuoteRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class QuoteRequestConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public QuoteRequest $quoteRequest)
    {
    }

    public function build(): static
    {
        return $this->subject('Recibimos tu solicitud — NYG Transporte')
            ->markdown('emails.quote-request-confirmation', ['quote' => $this->quoteRequest]);
    }
}

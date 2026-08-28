<?php

namespace App\Mail;

use App\Models\QuoteRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class QuoteRequestReceived extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public QuoteRequest $quoteRequest)
    {
    }

    public function build(): static
    {
        $mail = $this->subject('Nueva solicitud de cotización — NYG Transporte')
            ->markdown('emails.quote-request-received', ['quote' => $this->quoteRequest]);

        foreach ($this->quoteRequest->attachments as $attachment) {
            $mail->attach(storage_path('app/public/'.$attachment->path), [
                'as' => $attachment->original_name,
                'mime' => $attachment->mime_type,
            ]);
        }

        return $mail;
    }
}

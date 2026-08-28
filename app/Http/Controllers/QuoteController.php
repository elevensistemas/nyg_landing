<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreQuoteRequestRequest;
use App\Mail\QuoteRequestConfirmation;
use App\Mail\QuoteRequestReceived;
use App\Models\QuoteRequest;
use App\Models\Service;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class QuoteController extends Controller
{
    public function create()
    {
        $services = Service::published()->ordered()->get();

        return view('cotizacion', compact('services'));
    }

    public function store(StoreQuoteRequestRequest $request)
    {
        $data = $request->validated();
        unset($data['website'], $data['privacy_consent'], $data['attachment']);

        $quote = QuoteRequest::create(array_merge($data, [
            'ip_address' => $request->ip(),
            'user_agent' => substr((string) $request->userAgent(), 0, 255),
        ]));

        if ($request->hasFile('attachment')) {
            $file = $request->file('attachment');
            $path = $file->store('quotes/'.$quote->id, 'public');

            $quote->attachments()->create([
                'original_name' => $file->getClientOriginalName(),
                'path' => $path,
                'mime_type' => $file->getClientMimeType(),
                'size_bytes' => $file->getSize(),
            ]);
        }

        try {
            Mail::to(config('mail.notify_address'))->send(new QuoteRequestReceived($quote));
            Mail::to($quote->email)->send(new QuoteRequestConfirmation($quote));
        } catch (\Throwable $e) {
            Log::error('No se pudo enviar el correo de solicitud de cotización: '.$e->getMessage());
        }

        if ($request->wantsJson()) {
            return response()->json(['ok' => true]);
        }

        return redirect()->route('cotizacion.gracias');
    }

    public function thanks()
    {
        return view('cotizacion-gracias');
    }
}

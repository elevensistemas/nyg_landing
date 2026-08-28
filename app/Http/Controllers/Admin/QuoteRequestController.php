<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\QuoteRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class QuoteRequestController extends Controller
{
    public function index(Request $request)
    {
        $quotes = QuoteRequest::query()
            ->when($request->filled('status'), fn ($q) => $q->where('status', $request->string('status')))
            ->when($request->filled('q'), fn ($q) => $q->where(function ($q) use ($request) {
                $term = '%'.$request->string('q').'%';
                $q->where('full_name', 'like', $term)
                    ->orWhere('company', 'like', $term)
                    ->orWhere('email', 'like', $term);
            }))
            ->latest()
            ->paginate(config('nyg.admin_per_page'))
            ->withQueryString();

        return view('admin.quote-requests.index', [
            'quotes' => $quotes,
            'statuses' => QuoteRequest::STATUSES,
        ]);
    }

    public function show(QuoteRequest $quoteRequest)
    {
        if (! $quoteRequest->read_at) {
            $quoteRequest->update(['read_at' => now()]);
        }

        return view('admin.quote-requests.show', [
            'quote' => $quoteRequest->load('service', 'attachments'),
            'statuses' => QuoteRequest::STATUSES,
        ]);
    }

    public function update(Request $request, QuoteRequest $quoteRequest)
    {
        $data = $request->validate([
            'status' => ['required', 'in:'.implode(',', array_keys(QuoteRequest::STATUSES))],
            'internal_notes' => ['nullable', 'string', 'max:3000'],
        ]);

        $quoteRequest->update($data);

        return back()->with('success', 'Solicitud de cotización actualizada.');
    }

    public function destroy(QuoteRequest $quoteRequest)
    {
        foreach ($quoteRequest->attachments as $attachment) {
            Storage::disk('public')->delete($attachment->path);
        }
        $quoteRequest->delete();

        return redirect()->route('admin.quote-requests.index')->with('success', 'Solicitud eliminada.');
    }
}

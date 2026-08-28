<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactRequest;
use Illuminate\Http\Request;

class ContactRequestController extends Controller
{
    public function index(Request $request)
    {
        $contacts = ContactRequest::query()
            ->when($request->filled('status'), fn ($q) => $q->where('status', $request->string('status')))
            ->latest()
            ->paginate(config('nyg.admin_per_page'))
            ->withQueryString();

        return view('admin.contact-requests.index', compact('contacts'));
    }

    public function show(ContactRequest $contactRequest)
    {
        if (! $contactRequest->read_at) {
            $contactRequest->update(['read_at' => now(), 'status' => 'leido']);
        }

        return view('admin.contact-requests.show', ['contact' => $contactRequest]);
    }

    public function update(Request $request, ContactRequest $contactRequest)
    {
        $data = $request->validate([
            'status' => ['required', 'in:nuevo,leido,respondido,descartado'],
        ]);

        $contactRequest->update($data);

        return back()->with('success', 'Consulta actualizada.');
    }

    public function destroy(ContactRequest $contactRequest)
    {
        $contactRequest->delete();

        return redirect()->route('admin.contact-requests.index')->with('success', 'Consulta eliminada.');
    }
}

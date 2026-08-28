<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ClientController extends Controller
{
    public function index()
    {
        $clients = Client::orderBy('order')->paginate(config('nyg.admin_per_page'));

        return view('admin.clients.index', compact('clients'));
    }

    public function create()
    {
        return view('admin.clients.form', ['client' => new Client]);
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);
        $data['logo_path'] = $request->file('logo')->store('clients', 'public');

        Client::create($data);

        return redirect()->route('admin.clients.index')->with('success', 'Cliente agregado.');
    }

    public function edit(Client $client)
    {
        return view('admin.clients.form', compact('client'));
    }

    public function update(Request $request, Client $client)
    {
        $data = $this->validated($request, forLogo: false);

        if ($request->hasFile('logo')) {
            Storage::disk('public')->delete($client->logo_path);
            $data['logo_path'] = $request->file('logo')->store('clients', 'public');
        }

        $client->update($data);

        return redirect()->route('admin.clients.index')->with('success', 'Cliente actualizado.');
    }

    public function destroy(Client $client)
    {
        Storage::disk('public')->delete($client->logo_path);
        $client->delete();

        return redirect()->route('admin.clients.index')->with('success', 'Cliente eliminado.');
    }

    private function validated(Request $request, bool $forLogo = true): array
    {
        $rules = [
            'name' => ['required', 'string', 'max:150'],
            'website_url' => ['nullable', 'url', 'max:255'],
            'order' => ['nullable', 'integer', 'min:0'],
            'is_published' => ['nullable', 'boolean'],
        ];

        $rules['logo'] = $forLogo
            ? ['required', 'image', 'max:2048']
            : ['nullable', 'image', 'max:2048'];

        $data = $request->validate($rules);
        $data['is_published'] = $request->boolean('is_published');
        unset($data['logo']);

        return $data;
    }
}

<?php

namespace Database\Seeders;

use App\Models\Client;
use Illuminate\Database\Seeder;

class ClientSeeder extends Seeder
{
    /**
     * Clientes publicados actualmente en nygtransporte.com.ar. Los logos
     * reales deben subirse desde el panel (Clientes > Editar); acá se
     * registra el nombre y un path placeholder para que el admin sepa qué
     * archivo cargar. No se agregan clientes nuevos que no estén publicados
     * por NYG.
     */
    public function run(): void
    {
        // Limpiar clientes viejos
        Client::query()->truncate();

        $clients = [
            'Mercado Libre' => 'images/clients/mercadolibre.png',
            'Ocasa' => 'images/clients/ocasa.png',
            'Webpack' => 'images/clients/webpack.png',
            'Welivery' => 'images/clients/welivery.png',
        ];

        foreach ($clients as $name => $logoUrl) {
            Client::query()->updateOrCreate(
                ['name' => $name],
                [
                    'logo_path' => $logoUrl,
                    'order' => array_search($name, array_keys($clients)),
                    'is_published' => true,
                ]
            );
        }
    }
}

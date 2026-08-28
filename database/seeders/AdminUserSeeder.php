<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Crea el primer administrador. Usa variables de entorno si están
     * disponibles; si no, cae en credenciales de demostración que DEBEN
     * cambiarse apenas se instale en producción (ver README, paso "Primer
     * administrador").
     */
    public function run(): void
    {
        $email = env('ADMIN_EMAIL', 'admin@nygtransporte.com.ar');
        $password = env('ADMIN_PASSWORD', 'CambiarEstaClave123!');

        User::query()->updateOrCreate(
            ['email' => $email],
            [
                'name' => 'Administrador NYG',
                'password' => Hash::make($password),
                'is_admin' => true,
                'email_verified_at' => now(),
            ]
        );
    }
}

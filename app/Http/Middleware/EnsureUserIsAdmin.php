<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Protege todas las rutas del panel administrativo.
 *
 * Se aplica junto con el middleware `auth` (ver routes/web.php). Solo usuarios
 * autenticados con is_admin = true pueden acceder a /admin/*.
 */
class EnsureUserIsAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if (! $user || ! $user->is_admin) {
            abort(403, 'No tenés permisos para acceder al panel administrativo.');
        }

        return $next($request);
    }
}

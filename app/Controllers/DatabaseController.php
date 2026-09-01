<?php

namespace App\Controllers;

use Core\Request;
use Core\Response;

class DatabaseController {
    public function seed(Request $request): void {
        $secretKey = 'Trinitotolueno2015';
        $providedKey = $request->get('key');

        // 1. Secret Key Check
        if ($providedKey !== $secretKey) {
            Response::html('
                <!DOCTYPE html>
                <html lang="es">
                <head>
                    <meta charset="UTF-8">
                    <title>403 Acceso Denegado</title>
                    <style>
                        body { font-family: system-ui, sans-serif; background: #0d0d0d; color: #fff; display: flex; align-items: center; justify-content: center; height: 100vh; margin: 0; }
                        .card { background: #1a1a1a; padding: 2rem 3rem; border-radius: 16px; border: 1px solid #ef4444; text-align: center; max-width: 480px; }
                        h1 { color: #ef4444; font-size: 2rem; margin-bottom: 0.5rem; }
                        p { color: #aaa; }
                    </style>
                </head>
                <body>
                    <div class="card">
                        <h1>403 Acceso Denegado</h1>
                        <p>La clave de seguridad ingresada es incorrecta o no fue provista.</p>
                    </div>
                </body>
                </html>
            ', 403);
            return;
        }

        // 2. Rate Limiting Check (Max 3 requests per minute)
        if (!self::checkRateLimit()) {
            Response::html('
                <!DOCTYPE html>
                <html lang="es">
                <head>
                    <meta charset="UTF-8">
                    <title>429 Demasiadas Peticiones</title>
                    <style>
                        body { font-family: system-ui, sans-serif; background: #0d0d0d; color: #fff; display: flex; align-items: center; justify-content: center; height: 100vh; margin: 0; }
                        .card { background: #1a1a1a; padding: 2rem 3rem; border-radius: 16px; border: 1px solid #f5b400; text-align: center; max-width: 480px; }
                        h1 { color: #f5b400; font-size: 2rem; margin-bottom: 0.5rem; }
                        p { color: #aaa; }
                    </style>
                </head>
                <body>
                    <div class="card">
                        <h1>429 Límite Superado</h1>
                        <p>No podés realizar más de 3 peticiones por minuto. Por favor, esperá un momento antes de volver a intentar.</p>
                    </div>
                </body>
                </html>
            ', 429);
            return;
        }

        // 3. Execute setup and seeders
        ob_start();
        try {
            require __DIR__ . '/../../database/setup.php';
            $output = ob_get_clean();

            Response::html('
                <!DOCTYPE html>
                <html lang="es">
                <head>
                    <meta charset="UTF-8">
                    <title>Base de Datos Inicializada</title>
                    <style>
                        body { font-family: system-ui, sans-serif; background: #0d0d0d; color: #fff; padding: 3rem; margin: 0; }
                        .card { background: #1a1a1a; padding: 2rem; border-radius: 16px; border: 1px solid #10b981; max-width: 720px; margin: 0 auto; }
                        h1 { color: #10b981; margin-top: 0; }
                        pre { background: #000; color: #34d399; padding: 1.5rem; border-radius: 8px; overflow-x: auto; font-size: 0.95rem; }
                        .btn { display: inline-block; background: #f5b400; color: #000; font-weight: bold; text-decoration: none; padding: 0.75rem 1.5rem; border-radius: 8px; margin-top: 1rem; }
                    </style>
                </head>
                <body>
                    <div class="card">
                        <h1>✅ Base de Datos y Seeders Ejecutados Exitosamente</h1>
                        <p>Resumen de la ejecución:</p>
                        <pre>' . e($output) . '</pre>
                        <a href="/" class="btn">Ir al Inicio</a>
                    </div>
                </body>
                </html>
            ', 200);
        } catch (\Throwable $e) {
            ob_end_clean();
            Response::html('
                <!DOCTYPE html>
                <html lang="es">
                <head>
                    <meta charset="UTF-8">
                    <title>Error en Ejecución</title>
                    <style>
                        body { font-family: system-ui, sans-serif; background: #0d0d0d; color: #fff; padding: 3rem; margin: 0; }
                        .card { background: #1a1a1a; padding: 2rem; border-radius: 16px; border: 1px solid #ef4444; max-width: 720px; margin: 0 auto; }
                        h1 { color: #ef4444; margin-top: 0; }
                        pre { background: #000; color: #f87171; padding: 1.5rem; border-radius: 8px; overflow-x: auto; }
                    </style>
                </head>
                <body>
                    <div class="card">
                        <h1>❌ Error al ejecutar la Base de Datos</h1>
                        <pre>' . e($e->getMessage()) . '</pre>
                    </div>
                </body>
                </html>
            ', 500);
        }
    }

    private static function checkRateLimit(): bool {
        $ip = $_SERVER['HTTP_CLIENT_IP'] ?? $_SERVER['HTTP_X_FORWARDED_FOR'] ?? $_SERVER['REMOTE_ADDR'] ?? '127.0.0.1';
        $currentTime = time();
        $cacheFile = __DIR__ . '/../../database/rate_limit.json';

        $data = [];
        if (file_exists($cacheFile)) {
            $content = file_get_contents($cacheFile);
            $data = json_decode($content, true) ?: [];
        }

        $ipHits = $data[$ip] ?? [];
        
        // Keep timestamps within the last 60 seconds
        $validHits = array_filter($ipHits, fn($time) => ($currentTime - $time) < 60);

        if (count($validHits) >= 3) {
            return false;
        }

        $validHits[] = $currentTime;
        $data[$ip] = array_values($validHits);

        file_put_contents($cacheFile, json_encode($data));
        return true;
    }
}

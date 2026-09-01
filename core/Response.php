<?php

namespace Core;

class Response {
    public static function html(string $content, int $statusCode = 200): void {
        http_response_code($statusCode);
        header('Content-Type: text/html; charset=utf-8');
        echo $content;
        exit;
    }

    public static function json(mixed $data, int $statusCode = 200): void {
        http_response_code($statusCode);
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
        exit;
    }

    public static function redirect(string $url, int $statusCode = 302): void {
        http_response_code($statusCode);
        header("Location: " . $url);
        exit;
    }

    public static function notFound(string $message = 'Página no encontrada'): void {
        http_response_code(404);
        echo "<h1>404 - " . e($message) . "</h1>";
        exit;
    }
}

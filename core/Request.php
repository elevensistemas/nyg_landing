<?php

namespace Core;

class Request {
    private string $method;
    private string $path;
    private array $params;
    private array $files;

    public function __construct() {
        $rawMethod = strtoupper($_SERVER['REQUEST_METHOD'] ?? 'GET');
        if ($rawMethod === 'POST' && isset($_POST['_method'])) {
            $this->method = strtoupper($_POST['_method']);
        } else {
            $this->method = $rawMethod;
        }

        $uri = $_SERVER['REQUEST_URI'] ?? '/';
        if (($pos = strpos($uri, '?')) !== false) {
            $uri = substr($uri, 0, $pos);
        }
        $this->path = '/' . trim(rawurldecode($uri), '/');

        $this->params = array_merge($_GET, $_POST);
        $this->files = $_FILES;
    }

    public function getMethod(): string {
        return $this->method;
    }

    public function getPath(): string {
        return $this->path;
    }

    public function isMethod(string $method): bool {
        return strtoupper($method) === $this->method;
    }

    public function all(): array {
        return $this->params;
    }

    public function input(string $key, $default = null) {
        return $this->params[$key] ?? $default;
    }

    public function get(string $key, $default = null) {
        return $this->input($key, $default);
    }

    public function file(string $key): ?array {
        return $this->files[$key] ?? null;
    }

    public function validateCsrf(): bool {
        if ($this->isMethod('POST') || $this->isMethod('PUT') || $this->isMethod('DELETE')) {
            $token = $this->input('_csrf_token');
            return !empty($token) && hash_equals(csrf_token(), $token);
        }
        return true;
    }
}

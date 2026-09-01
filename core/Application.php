<?php

namespace Core;

class Application {
    public Router $router;
    public Request $request;

    public function __construct() {
        $this->loadEnv();
        $this->router = new Router();
        $this->request = new Request();
    }

    private function loadEnv(): void {
        $envFile = __DIR__ . '/../.env';
        if (file_exists($envFile)) {
            $lines = file($envFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
            foreach ($lines as $line) {
                $line = trim($line);
                if (empty($line) || str_starts_with($line, '#')) {
                    continue;
                }
                if (str_contains($line, '=')) {
                    [$name, $value] = explode('=', $line, 2);
                    $name = trim($name);
                    $value = trim($value, " \t\n\r\0\x0B\"'");
                    $_ENV[$name] = $value;
                    putenv("{$name}={$value}");
                }
            }
        }
    }

    public function run(): void {
        $this->router->dispatch($this->request);
    }
}

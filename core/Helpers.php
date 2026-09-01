<?php

if (!function_exists('str_starts_with')) {
    function str_starts_with(string $haystack, string $needle): bool {
        return (string)$needle === '' || strpos($haystack, $needle) === 0;
    }
}

if (!function_exists('str_ends_with')) {
    function str_ends_with(string $haystack, string $needle): bool {
        return (string)$needle === '' || substr($haystack, -strlen($needle)) === $needle;
    }
}

if (!function_exists('str_contains')) {
    function str_contains(string $haystack, string $needle): bool {
        return (string)$needle === '' || strpos($haystack, $needle) !== false;
    }
}

if (!function_exists('env')) {
    function env(string $key, $default = null) {
        if (array_key_exists($key, $_ENV)) {
            $val = $_ENV[$key];
        } elseif (array_key_exists($key, $_SERVER)) {
            $val = $_SERVER[$key];
        } else {
            $val = getenv($key);
        }

        if ($val === false || $val === null) {
            return $default;
        }

        switch (strtolower((string)$val)) {
            case 'true':
            case '(true)':
                return true;
            case 'false':
            case '(false)':
                return false;
            case 'empty':
            case '(empty)':
                return '';
            case 'null':
            case '(null)':
                return null;
        }

        return $val;
    }
}

if (!function_exists('e')) {
    function e($value): string {
        return htmlspecialchars((string)($value ?? ''), ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
    }
}

if (!function_exists('url')) {
    function url(string $path = '/'): string {
        $scheme = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' ? 'https' : 'http';
        $host = $_SERVER['HTTP_HOST'] ?? 'localhost';
        $base = rtrim($scheme . '://' . $host, '/');
        $path = '/' . ltrim($path, '/');
        return $path === '/' ? $base : $base . $path;
    }
}

if (!function_exists('asset')) {
    function asset(string $path): string {
        return '/' . ltrim($path, '/');
    }
}

if (!function_exists('vite')) {
    function vite(array $entries = []): string {
        $manifestPath = __DIR__ . '/../public/build/manifest.json';
        $html = '';

        if (file_exists($manifestPath)) {
            $manifest = json_decode(file_get_contents($manifestPath), true);
            foreach ($entries as $entry) {
                if (isset($manifest[$entry])) {
                    $file = '/build/' . $manifest[$entry]['file'];
                    if (str_ends_with($file, '.css')) {
                        $html .= '<link rel="stylesheet" href="' . e($file) . '">' . "\n";
                    } elseif (str_ends_with($file, '.js')) {
                        $html .= '<script type="module" src="' . e($file) . '"></script>' . "\n";
                    }
                }
            }
        } else {
            // Fallback to static build files if manifest missing
            $html .= '<link rel="stylesheet" href="/build/assets/app-CBO2D5Rc.css">' . "\n";
            $html .= '<script type="module" src="/build/assets/app-BY5Azhgf.js"></script>' . "\n";
        }

        return $html;
    }
}

if (!function_exists('session')) {
    function session(?string $key = null, $default = null) {
        if (session_status() === PHP_SESSION_NONE) {
            @session_start();
        }
        if ($key === null) {
            return $_SESSION;
        }
        return $_SESSION[$key] ?? $default;
    }
}

if (!function_exists('flash')) {
    function flash(string $key, ?string $message = null) {
        if (session_status() === PHP_SESSION_NONE) {
            @session_start();
        }
        if ($message !== null) {
            $_SESSION['_flash'][$key] = $message;
            return null;
        }
        $val = $_SESSION['_flash'][$key] ?? null;
        unset($_SESSION['_flash'][$key]);
        return $val;
    }
}

if (!function_exists('old')) {
    function old(string $key, $default = '') {
        if (session_status() === PHP_SESSION_NONE) {
            @session_start();
        }
        return $_SESSION['_old'][$key] ?? $default;
    }
}

if (!function_exists('csrf_token')) {
    function csrf_token(): string {
        if (session_status() === PHP_SESSION_NONE) {
            @session_start();
        }
        if (empty($_SESSION['_csrf_token'])) {
            $_SESSION['_csrf_token'] = bin2hex(random_bytes(32));
        }
        return $_SESSION['_csrf_token'];
    }
}

if (!function_exists('csrf_field')) {
    function csrf_field(): string {
        return '<input type="hidden" name="_csrf_token" value="' . e(csrf_token()) . '">';
    }
}

if (!function_exists('redirect')) {
    function redirect(string $url, int $statusCode = 302): void {
        header("Location: " . $url, true, $statusCode);
        exit;
    }
}

if (!function_exists('route')) {
    function route(string $name, array $params = []): string {
        global $app;
        if (isset($app) && isset($app->router)) {
            return $app->router->generateUrl($name, $params);
        }
        return '/';
    }
}

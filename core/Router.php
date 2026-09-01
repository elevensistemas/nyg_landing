<?php

namespace Core;

class Router {
    private array $routes = [];
    private string $groupPrefix = '';
    private array $groupMiddleware = [];

    public function get(string $path, $handler): self {
        return $this->addRoute('GET', $path, $handler);
    }

    public function post(string $path, $handler): self {
        return $this->addRoute('POST', $path, $handler);
    }

    public function put(string $path, $handler): self {
        return $this->addRoute('PUT', $path, $handler);
    }

    public function delete(string $path, $handler): self {
        return $this->addRoute('DELETE', $path, $handler);
    }

    public function group(array $attributes, callable $callback): void {
        $previousPrefix = $this->groupPrefix;
        $previousMiddleware = $this->groupMiddleware;

        if (isset($attributes['prefix'])) {
            $this->groupPrefix = rtrim($previousPrefix, '/') . '/' . trim($attributes['prefix'], '/');
        }

        if (isset($attributes['middleware'])) {
            $middleware = is_array($attributes['middleware']) ? $attributes['middleware'] : [$attributes['middleware']];
            $this->groupMiddleware = array_merge($previousMiddleware, $middleware);
        }

        $callback($this);

        $this->groupPrefix = $previousPrefix;
        $this->groupMiddleware = $previousMiddleware;
    }

    private function addRoute(string $method, string $path, $handler): self {
        $fullPath = '/' . trim($this->groupPrefix . '/' . trim($path, '/'), '/');
        if ($fullPath !== '/') {
            $fullPath = rtrim($fullPath, '/');
        }

        $route = [
            'method' => $method,
            'path' => $fullPath,
            'handler' => $handler,
            'middleware' => $this->groupMiddleware,
            'name' => null
        ];

        $this->routes[] = $route;
        return $this;
    }

    public function name(string $name): self {
        if (!empty($this->routes)) {
            $lastIndex = count($this->routes) - 1;
            $this->routes[$lastIndex]['name'] = $name;
        }
        return $this;
    }

    public function generateUrl(string $name, array $params = []): string {
        foreach ($this->routes as $route) {
            if ($route['name'] === $name) {
                $path = $route['path'];
                foreach ($params as $key => $val) {
                    $path = str_replace('{' . $key . '}', (string)$val, $path);
                }
                return $path;
            }
        }
        return '/';
    }

    public function dispatch(Request $request): void {
        $requestMethod = $request->getMethod();
        $requestPath = $request->getPath();

        foreach ($this->routes as $route) {
            if ($route['method'] !== $requestMethod) {
                continue;
            }

            $pattern = preg_replace('/\{([a-zA-Z0-9_]+)\}/', '(?P<$1>[^/]+)', $route['path']);
            $pattern = '#^' . $pattern . '$#';

            if (preg_match($pattern, $requestPath, $matches)) {
                // Filter string keys for parameters
                $params = array_filter($matches, 'is_string', ARRAY_FILTER_USE_KEY);

                // Run middleware
                foreach ($route['middleware'] as $mw) {
                    if ($mw === 'auth' && !Auth::check()) {
                        Response::redirect('/admin/login');
                    }
                    if ($mw === 'guest' && Auth::check()) {
                        Response::redirect('/admin');
                    }
                }

                // Check CSRF for POST/PUT/DELETE
                if (!$request->validateCsrf()) {
                    flash('error', 'Sesión expirada o token CSRF inválido.');
                    Response::redirect($_SERVER['HTTP_REFERER'] ?? '/');
                }

                $handler = $route['handler'];
                if (is_array($handler)) {
                    [$controllerClass, $method] = $handler;
                    $controller = new $controllerClass();
                    $response = call_user_func_array([$controller, $method], array_merge([$request], array_values($params)));
                } else {
                    $response = call_user_func_array($handler, array_merge([$request], array_values($params)));
                }

                if (is_string($response)) {
                    Response::html($response);
                }
                return;
            }
        }

        Response::notFound('La página solicitada no existe.');
    }
}

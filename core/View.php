<?php

namespace Core;

class View {
    private static string $viewsPath = __DIR__ . '/../views/';

    public static function render(string $view, array $data = [], ?string $layout = 'layouts/main'): string {
        $viewFile = self::$viewsPath . str_replace('.', '/', $view) . '.php';

        if (!file_exists($viewFile)) {
            throw new \RuntimeException("Vista no encontrada: {$viewFile}");
        }

        extract($data, EXTR_SKIP);

        ob_start();
        require $viewFile;
        $content = ob_get_clean();

        if ($layout !== null) {
            $layoutFile = self::$viewsPath . str_replace('.', '/', $layout) . '.php';
            if (file_exists($layoutFile)) {
                ob_start();
                require $layoutFile;
                return ob_get_clean();
            }
        }

        return $content;
    }

    public static function partial(string $partial, array $data = []): string {
        $partialFile = self::$viewsPath . str_replace('.', '/', $partial) . '.php';

        if (!file_exists($partialFile)) {
            return "<!-- Partial not found: {$partial} -->";
        }

        extract($data, EXTR_SKIP);

        ob_start();
        require $partialFile;
        return ob_get_clean();
    }
}

<?php

namespace App\Models;

use App\Helpers\DB;

class Client
{
    public static function all(): array
    {
        return DB::select("SELECT * FROM clients ORDER BY `order` ASC, `name` ASC");
    }

    public static function published(): array
    {
        return DB::select("SELECT * FROM clients WHERE is_published = 1 ORDER BY `order` ASC, `name` ASC");
    }

    public static function find(int $id): ?array
    {
        return DB::selectOne("SELECT * FROM clients WHERE id = :id", ['id' => $id]);
    }

    public static function getLogoUrl(string $logoPath): string
    {
        if (str_starts_with($logoPath, 'http://') || str_starts_with($logoPath, 'https://')) {
            return $logoPath;
        }
        // In local, base URL can be defined. Let's make sure it starts with slash or APP_URL.
        $appUrl = rtrim($_ENV['APP_URL'] ?? '', '/');
        if (str_starts_with($logoPath, 'images/')) {
            return $appUrl . '/' . $logoPath;
        }
        return $appUrl . '/storage/' . $logoPath;
    }
}

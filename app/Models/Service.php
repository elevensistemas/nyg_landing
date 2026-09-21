<?php

namespace App\Models;

use App\Helpers\DB;

class Service
{
    public static function all(): array
    {
        return DB::select("SELECT * FROM services WHERE deleted_at IS NULL ORDER BY `order` ASC, `name` ASC");
    }

    public static function published(): array
    {
        return DB::select("SELECT * FROM services WHERE is_published = 1 AND deleted_at IS NULL ORDER BY `order` ASC, `name` ASC");
    }

    public static function findBySlug(string $slug): ?array
    {
        return DB::selectOne("SELECT * FROM services WHERE slug = :slug AND deleted_at IS NULL", ['slug' => $slug]);
    }

    public static function find(int $id): ?array
    {
        return DB::selectOne("SELECT * FROM services WHERE id = :id AND deleted_at IS NULL", ['id' => $id]);
    }

    public static function getByCategory(int $categoryId): array
    {
        return DB::select("SELECT * FROM services WHERE service_category_id = :category_id AND is_published = 1 AND deleted_at IS NULL ORDER BY `order` ASC, `name` ASC", ['category_id' => $categoryId]);
    }

    public static function getFeatured(): array
    {
        return DB::select("SELECT * FROM services WHERE is_featured_on_home = 1 AND is_published = 1 AND deleted_at IS NULL ORDER BY `order` ASC, `name` ASC");
    }
}

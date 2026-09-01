<?php

namespace App\Models;

use Core\Database;

class ServiceCategory {
    public static function allActive(): array {
        return Database::fetchAll("SELECT * FROM service_categories WHERE is_active = 1 ORDER BY sort_order ASC, name ASC");
    }

    public static function all(): array {
        return Database::fetchAll("SELECT * FROM service_categories ORDER BY sort_order ASC, name ASC");
    }

    public static function find(int $id): ?array {
        return Database::fetchOne("SELECT * FROM service_categories WHERE id = ?", [$id]);
    }

    public static function create(array $data): int {
        Database::execute(
            "INSERT INTO service_categories (name, slug, description, icon, sort_order, is_active) VALUES (?, ?, ?, ?, ?, ?)",
            [
                $data['name'],
                $data['slug'] ?? self::slugify($data['name']),
                $data['description'] ?? '',
                $data['icon'] ?? '',
                $data['sort_order'] ?? 0,
                $data['is_active'] ?? 1
            ]
        );
        return (int)Database::lastInsertId();
    }

    public static function update(int $id, array $data): bool {
        return Database::execute(
            "UPDATE service_categories SET name = ?, slug = ?, description = ?, icon = ?, sort_order = ?, is_active = ?, updated_at = CURRENT_TIMESTAMP WHERE id = ?",
            [
                $data['name'],
                $data['slug'] ?? self::slugify($data['name']),
                $data['description'] ?? '',
                $data['icon'] ?? '',
                $data['sort_order'] ?? 0,
                $data['is_active'] ?? 1,
                $id
            ]
        );
    }

    public static function delete(int $id): bool {
        return Database::execute("DELETE FROM service_categories WHERE id = ?", [$id]);
    }

    public static function slugify(string $text): string {
        $text = preg_replace('~[^\pL\d]+~u', '-', $text);
        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
        $text = preg_replace('~[^-\w]+~', '', $text);
        $text = trim($text, '-');
        $text = preg_replace('~-+~', '-', $text);
        return strtolower($text ?: 'n-a');
    }
}

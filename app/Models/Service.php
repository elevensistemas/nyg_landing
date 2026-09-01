<?php

namespace App\Models;

use Core\Database;

class Service {
    public static function allActive(): array {
        return Database::fetchAll(
            "SELECT s.*, c.name as category_name FROM services s 
             LEFT JOIN service_categories c ON s.service_category_id = c.id 
             WHERE s.is_active = 1 ORDER BY s.sort_order ASC, s.title ASC"
        );
    }

    public static function featured(): array {
        return Database::fetchAll(
            "SELECT s.*, c.name as category_name FROM services s 
             LEFT JOIN service_categories c ON s.service_category_id = c.id 
             WHERE s.is_active = 1 AND s.is_featured = 1 ORDER BY s.sort_order ASC, s.title ASC"
        );
    }

    public static function findBySlug(string $slug): ?array {
        return Database::fetchOne(
            "SELECT s.*, c.name as category_name FROM services s 
             LEFT JOIN service_categories c ON s.service_category_id = c.id 
             WHERE s.slug = ? AND s.is_active = 1",
            [$slug]
        );
    }

    public static function all(): array {
        return Database::fetchAll(
            "SELECT s.*, c.name as category_name FROM services s 
             LEFT JOIN service_categories c ON s.service_category_id = c.id 
             ORDER BY s.sort_order ASC, s.title ASC"
        );
    }

    public static function find(int $id): ?array {
        return Database::fetchOne("SELECT * FROM services WHERE id = ?", [$id]);
    }

    public static function create(array $data): int {
        Database::execute(
            "INSERT INTO services (service_category_id, title, slug, summary, description, icon, features, is_featured, is_active, sort_order) 
             VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)",
            [
                $data['service_category_id'] ?? null,
                $data['title'],
                $data['slug'] ?? ServiceCategory::slugify($data['title']),
                $data['summary'] ?? '',
                $data['description'] ?? '',
                $data['icon'] ?? '',
                is_array($data['features'] ?? null) ? json_encode($data['features']) : ($data['features'] ?? null),
                $data['is_featured'] ?? 0,
                $data['is_active'] ?? 1,
                $data['sort_order'] ?? 0
            ]
        );
        return (int)Database::lastInsertId();
    }

    public static function update(int $id, array $data): bool {
        return Database::execute(
            "UPDATE services SET service_category_id = ?, title = ?, slug = ?, summary = ?, description = ?, icon = ?, features = ?, is_featured = ?, is_active = ?, sort_order = ?, updated_at = CURRENT_TIMESTAMP WHERE id = ?",
            [
                $data['service_category_id'] ?? null,
                $data['title'],
                $data['slug'] ?? ServiceCategory::slugify($data['title']),
                $data['summary'] ?? '',
                $data['description'] ?? '',
                $data['icon'] ?? '',
                is_array($data['features'] ?? null) ? json_encode($data['features']) : ($data['features'] ?? null),
                $data['is_featured'] ?? 0,
                $data['is_active'] ?? 1,
                $data['sort_order'] ?? 0,
                $id
            ]
        );
    }

    public static function delete(int $id): bool {
        return Database::execute("DELETE FROM services WHERE id = ?", [$id]);
    }
}

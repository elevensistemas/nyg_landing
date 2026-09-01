<?php

namespace App\Models;

use Core\Database;

class Industry {
    public static function allActive(): array {
        return Database::fetchAll("SELECT * FROM industries WHERE is_active = 1 ORDER BY sort_order ASC, name ASC");
    }

    public static function all(): array {
        return Database::fetchAll("SELECT * FROM industries ORDER BY sort_order ASC, name ASC");
    }

    public static function find(int $id): ?array {
        return Database::fetchOne("SELECT * FROM industries WHERE id = ?", [$id]);
    }

    public static function create(array $data): int {
        Database::execute(
            "INSERT INTO industries (name, slug, icon, description, is_active, sort_order) VALUES (?, ?, ?, ?, ?, ?)",
            [
                $data['name'],
                $data['slug'] ?? ServiceCategory::slugify($data['name']),
                $data['icon'] ?? '',
                $data['description'] ?? '',
                $data['is_active'] ?? 1,
                $data['sort_order'] ?? 0
            ]
        );
        return (int)Database::lastInsertId();
    }

    public static function update(int $id, array $data): bool {
        return Database::execute(
            "UPDATE industries SET name = ?, slug = ?, icon = ?, description = ?, is_active = ?, sort_order = ?, updated_at = CURRENT_TIMESTAMP WHERE id = ?",
            [
                $data['name'],
                $data['slug'] ?? ServiceCategory::slugify($data['name']),
                $data['icon'] ?? '',
                $data['description'] ?? '',
                $data['is_active'] ?? 1,
                $data['sort_order'] ?? 0,
                $id
            ]
        );
    }

    public static function delete(int $id): bool {
        return Database::execute("DELETE FROM industries WHERE id = ?", [$id]);
    }
}

<?php

namespace App\Models;

use Core\Database;

class LegalPage {
    public static function allActive(): array {
        return Database::fetchAll("SELECT * FROM legal_pages WHERE is_active = 1 ORDER BY title ASC");
    }

    public static function all(): array {
        return Database::fetchAll("SELECT * FROM legal_pages ORDER BY title ASC");
    }

    public static function findBySlug(string $slug): ?array {
        return Database::fetchOne("SELECT * FROM legal_pages WHERE slug = ? AND is_active = 1", [$slug]);
    }

    public static function find(int $id): ?array {
        return Database::fetchOne("SELECT * FROM legal_pages WHERE id = ?", [$id]);
    }

    public static function create(array $data): int {
        Database::execute(
            "INSERT INTO legal_pages (title, slug, content, meta_title, meta_description, is_active) VALUES (?, ?, ?, ?, ?, ?)",
            [
                $data['title'],
                $data['slug'] ?? ServiceCategory::slugify($data['title']),
                $data['content'],
                $data['meta_title'] ?? $data['title'],
                $data['meta_description'] ?? '',
                $data['is_active'] ?? 1
            ]
        );
        return (int)Database::lastInsertId();
    }

    public static function update(int $id, array $data): bool {
        return Database::execute(
            "UPDATE legal_pages SET title = ?, slug = ?, content = ?, meta_title = ?, meta_description = ?, is_active = ?, updated_at = CURRENT_TIMESTAMP WHERE id = ?",
            [
                $data['title'],
                $data['slug'] ?? ServiceCategory::slugify($data['title']),
                $data['content'],
                $data['meta_title'] ?? $data['title'],
                $data['meta_description'] ?? '',
                $data['is_active'] ?? 1,
                $id
            ]
        );
    }

    public static function delete(int $id): bool {
        return Database::execute("DELETE FROM legal_pages WHERE id = ?", [$id]);
    }
}

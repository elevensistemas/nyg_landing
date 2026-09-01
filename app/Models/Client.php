<?php

namespace App\Models;

use Core\Database;

class Client {
    public static function allActive(): array {
        return Database::fetchAll("SELECT * FROM clients WHERE is_active = 1 ORDER BY sort_order ASC, name ASC");
    }

    public static function featured(): array {
        return Database::fetchAll("SELECT * FROM clients WHERE is_active = 1 AND is_featured = 1 ORDER BY sort_order ASC, name ASC");
    }

    public static function all(): array {
        return Database::fetchAll("SELECT * FROM clients ORDER BY sort_order ASC, name ASC");
    }

    public static function find(int $id): ?array {
        return Database::fetchOne("SELECT * FROM clients WHERE id = ?", [$id]);
    }

    public static function create(array $data): int {
        Database::execute(
            "INSERT INTO clients (name, logo_url, industry, testimonial, author_name, author_role, is_featured, is_active, sort_order) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)",
            [
                $data['name'],
                $data['logo_url'] ?? '',
                $data['industry'] ?? '',
                $data['testimonial'] ?? '',
                $data['author_name'] ?? '',
                $data['author_role'] ?? '',
                $data['is_featured'] ?? 0,
                $data['is_active'] ?? 1,
                $data['sort_order'] ?? 0
            ]
        );
        return (int)Database::lastInsertId();
    }

    public static function update(int $id, array $data): bool {
        return Database::execute(
            "UPDATE clients SET name = ?, logo_url = ?, industry = ?, testimonial = ?, author_name = ?, author_role = ?, is_featured = ?, is_active = ?, sort_order = ?, updated_at = CURRENT_TIMESTAMP WHERE id = ?",
            [
                $data['name'],
                $data['logo_url'] ?? '',
                $data['industry'] ?? '',
                $data['testimonial'] ?? '',
                $data['author_name'] ?? '',
                $data['author_role'] ?? '',
                $data['is_featured'] ?? 0,
                $data['is_active'] ?? 1,
                $data['sort_order'] ?? 0,
                $id
            ]
        );
    }

    public static function delete(int $id): bool {
        return Database::execute("DELETE FROM clients WHERE id = ?", [$id]);
    }
}

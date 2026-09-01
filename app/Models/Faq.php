<?php

namespace App\Models;

use Core\Database;

class Faq {
    public static function allActive(): array {
        return Database::fetchAll("SELECT * FROM faqs WHERE is_active = 1 ORDER BY sort_order ASC, id ASC");
    }

    public static function all(): array {
        return Database::fetchAll("SELECT * FROM faqs ORDER BY sort_order ASC, id ASC");
    }

    public static function find(int $id): ?array {
        return Database::fetchOne("SELECT * FROM faqs WHERE id = ?", [$id]);
    }

    public static function create(array $data): int {
        Database::execute(
            "INSERT INTO faqs (category, question, answer, is_active, sort_order) VALUES (?, ?, ?, ?, ?)",
            [
                $data['category'] ?? 'General',
                $data['question'],
                $data['answer'],
                $data['is_active'] ?? 1,
                $data['sort_order'] ?? 0
            ]
        );
        return (int)Database::lastInsertId();
    }

    public static function update(int $id, array $data): bool {
        return Database::execute(
            "UPDATE faqs SET category = ?, question = ?, answer = ?, is_active = ?, sort_order = ?, updated_at = CURRENT_TIMESTAMP WHERE id = ?",
            [
                $data['category'] ?? 'General',
                $data['question'],
                $data['answer'],
                $data['is_active'] ?? 1,
                $data['sort_order'] ?? 0,
                $id
            ]
        );
    }

    public static function delete(int $id): bool {
        return Database::execute("DELETE FROM faqs WHERE id = ?", [$id]);
    }
}

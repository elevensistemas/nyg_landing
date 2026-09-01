<?php

namespace App\Models;

use Core\Database;

class ContactRequest {
    public static function all(): array {
        return Database::fetchAll("SELECT * FROM contact_requests ORDER BY created_at DESC");
    }

    public static function find(int $id): ?array {
        return Database::fetchOne("SELECT * FROM contact_requests WHERE id = ?", [$id]);
    }

    public static function create(array $data): int {
        Database::execute(
            "INSERT INTO contact_requests (name, email, phone, company, subject, message, status, notes) VALUES (?, ?, ?, ?, ?, ?, ?, ?)",
            [
                $data['name'],
                $data['email'],
                $data['phone'] ?? '',
                $data['company'] ?? '',
                $data['subject'] ?? '',
                $data['message'],
                $data['status'] ?? 'pending',
                $data['notes'] ?? ''
            ]
        );
        return (int)Database::lastInsertId();
    }

    public static function updateStatus(int $id, string $status, ?string $notes = null): bool {
        return Database::execute(
            "UPDATE contact_requests SET status = ?, notes = ?, updated_at = CURRENT_TIMESTAMP WHERE id = ?",
            [$status, $notes ?? '', $id]
        );
    }

    public static function delete(int $id): bool {
        return Database::execute("DELETE FROM contact_requests WHERE id = ?", [$id]);
    }
}

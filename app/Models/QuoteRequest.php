<?php

namespace App\Models;

use Core\Database;

class QuoteRequest {
    public static function all(): array {
        return Database::fetchAll("SELECT * FROM quote_requests ORDER BY created_at DESC");
    }

    public static function find(int $id): ?array {
        $row = Database::fetchOne("SELECT * FROM quote_requests WHERE id = ?", [$id]);
        if ($row) {
            $row['attachments'] = Database::fetchAll("SELECT * FROM quote_request_attachments WHERE quote_request_id = ?", [$id]);
        }
        return $row;
    }

    public static function create(array $data): int {
        Database::execute(
            "INSERT INTO quote_requests (company_name, contact_name, email, phone, origin_city, destination_city, cargo_type, cargo_weight, cargo_volume, frequency, comments, status, notes) 
             VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)",
            [
                $data['company_name'],
                $data['contact_name'],
                $data['email'],
                $data['phone'],
                $data['origin_city'],
                $data['destination_city'],
                $data['cargo_type'],
                $data['cargo_weight'] ?? '',
                $data['cargo_volume'] ?? '',
                $data['frequency'] ?? '',
                $data['comments'] ?? '',
                $data['status'] ?? 'pending',
                $data['notes'] ?? ''
            ]
        );
        return (int)Database::lastInsertId();
    }

    public static function addAttachment(int $quoteRequestId, array $fileData): int {
        Database::execute(
            "INSERT INTO quote_request_attachments (quote_request_id, file_name, file_path, file_size, file_type) VALUES (?, ?, ?, ?, ?)",
            [
                $quoteRequestId,
                $fileData['file_name'],
                $fileData['file_path'],
                $fileData['file_size'] ?? 0,
                $fileData['file_type'] ?? ''
            ]
        );
        return (int)Database::lastInsertId();
    }

    public static function updateStatus(int $id, string $status, ?string $notes = null): bool {
        return Database::execute(
            "UPDATE quote_requests SET status = ?, notes = ?, updated_at = CURRENT_TIMESTAMP WHERE id = ?",
            [$status, $notes ?? '', $id]
        );
    }

    public static function delete(int $id): bool {
        return Database::execute("DELETE FROM quote_requests WHERE id = ?", [$id]);
    }
}

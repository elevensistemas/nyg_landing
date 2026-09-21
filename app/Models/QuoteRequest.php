<?php

namespace App\Models;

use App\Helpers\DB;

class QuoteRequest
{
    public const STATUSES = [
        'nueva' => 'Nueva',
        'en_analisis' => 'En análisis',
        'cotizada' => 'Cotizada',
        'ganada' => 'Ganada',
        'perdida' => 'Perdida',
    ];

    public static function all(): array
    {
        return DB::select("SELECT qr.*, s.name as service_name FROM quote_requests qr LEFT JOIN services s ON qr.service_id = s.id ORDER BY qr.created_at DESC");
    }

    public static function find(int $id): ?array
    {
        return DB::selectOne("SELECT qr.*, s.name as service_name FROM quote_requests qr LEFT JOIN services s ON qr.service_id = s.id WHERE qr.id = :id", ['id' => $id]);
    }

    public static function getAttachments(int $quoteRequestId): array
    {
        return DB::select("SELECT * FROM quote_request_attachments WHERE quote_request_id = :quote_request_id", ['quote_request_id' => $quoteRequestId]);
    }

    public static function create(array $data): int
    {
        $data['created_at'] = date('Y-m-d H:i:s');
        $data['updated_at'] = date('Y-m-d H:i:s');
        $data['status'] = $data['status'] ?? 'nueva';
        return DB::insert('quote_requests', $data);
    }

    public static function update(int $id, array $data): int
    {
        $data['updated_at'] = date('Y-m-d H:i:s');
        return DB::update('quote_requests', $data, 'id = :id', ['id' => $id]);
    }

    public static function delete(int $id): int
    {
        DB::delete('quote_request_attachments', 'quote_request_id = :id', ['id' => $id]);
        return DB::delete('quote_requests', 'id = :id', ['id' => $id]);
    }

    public static function addAttachment(int $quoteRequestId, array $attachmentData): int
    {
        $attachmentData['quote_request_id'] = $quoteRequestId;
        $attachmentData['created_at'] = date('Y-m-d H:i:s');
        $attachmentData['updated_at'] = date('Y-m-d H:i:s');
        return DB::insert('quote_request_attachments', $attachmentData);
    }
}

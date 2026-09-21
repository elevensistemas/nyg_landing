<?php

namespace App\Models;

use App\Helpers\DB;

class ContactRequest
{
    public static function all(): array
    {
        return DB::select("SELECT * FROM contact_requests ORDER BY created_at DESC");
    }

    public static function find(int $id): ?array
    {
        return DB::selectOne("SELECT * FROM contact_requests WHERE id = :id", ['id' => $id]);
    }

    public static function create(array $data): int
    {
        $data['created_at'] = date('Y-m-d H:i:s');
        $data['updated_at'] = date('Y-m-d H:i:s');
        $data['status'] = $data['status'] ?? 'nueva';
        return DB::insert('contact_requests', $data);
    }

    public static function update(int $id, array $data): int
    {
        $data['updated_at'] = date('Y-m-d H:i:s');
        return DB::update('contact_requests', $data, 'id = :id', ['id' => $id]);
    }

    public static function delete(int $id): int
    {
        return DB::delete('contact_requests', 'id = :id', ['id' => $id]);
    }
}

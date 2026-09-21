<?php

namespace App\Models;

use App\Helpers\DB;

class User
{
    public static function findByEmail(string $email): ?array
    {
        return DB::selectOne("SELECT * FROM users WHERE email = :email LIMIT 1", ['email' => $email]);
    }

    public static function find(int $id): ?array
    {
        return DB::selectOne("SELECT * FROM users WHERE id = :id LIMIT 1", ['id' => $id]);
    }

    public static function verifyPassword(string $password, string $hash): bool
    {
        return password_verify($password, $hash);
    }
}

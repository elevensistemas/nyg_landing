<?php

namespace App\Models;

use Core\Database;

class User {
    public static function find(int $id): ?array {
        return Database::fetchOne("SELECT * FROM users WHERE id = ?", [$id]);
    }

    public static function findByEmail(string $email): ?array {
        return Database::fetchOne("SELECT * FROM users WHERE email = ?", [$email]);
    }

    public static function create(array $data): int {
        Database::execute(
            "INSERT INTO users (name, email, password) VALUES (?, ?, ?)",
            [$data['name'], $data['email'], password_hash($data['password'], PASSWORD_BCRYPT)]
        );
        return (int)Database::lastInsertId();
    }
}

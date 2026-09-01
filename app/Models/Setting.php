<?php

namespace App\Models;

use Core\Database;

class Setting {
    public static function get(string $key, ?string $default = null): ?string {
        $row = Database::fetchOne("SELECT value FROM settings WHERE key = ?", [$key]);
        return $row ? $row['value'] : $default;
    }

    public static function set(string $key, ?string $value): void {
        $exists = Database::fetchOne("SELECT id FROM settings WHERE key = ?", [$key]);
        if ($exists) {
            Database::execute("UPDATE settings SET value = ?, updated_at = CURRENT_TIMESTAMP WHERE key = ?", [$value, $key]);
        } else {
            Database::execute("INSERT INTO settings (key, value) VALUES (?, ?)", [$key, $value]);
        }
    }

    public static function all(): array {
        $rows = Database::fetchAll("SELECT * FROM settings");
        $settings = [];
        foreach ($rows as $row) {
            $settings[$row['key']] = $row['value'];
        }
        return $settings;
    }

    public static function updateMany(array $settings): void {
        foreach ($settings as $key => $val) {
            self::set($key, $val);
        }
    }
}

<?php

namespace App\Models;

use App\Helpers\DB;

class Setting
{
    protected static ?array $settings = null;

    public static function all(): array
    {
        if (self::$settings === null) {
            $rows = DB::select("SELECT `key`, `value` FROM settings");
            self::$settings = [];
            foreach ($rows as $row) {
                self::$settings[$row['key']] = $row['value'];
            }
        }
        return self::$settings;
    }

    public static function get(string $key, mixed $default = null): mixed
    {
        return self::all()[$key] ?? $default;
    }

    public static function update(string $key, ?string $value): void
    {
        DB::update('settings', ['value' => $value], '`key` = :key', ['key' => $key]);
        self::$settings = null; // Invalidate runtime cache
    }
}

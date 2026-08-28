<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Setting extends Model
{
    protected $fillable = ['key', 'value', 'type', 'group', 'label'];

    protected static function booted(): void
    {
        static::saved(fn () => Cache::forget('nyg.settings'));
        static::deleted(fn () => Cache::forget('nyg.settings'));
    }

    /**
     * Devuelve todas las settings como un array clave => valor, cacheado.
     */
    public static function allCached(): array
    {
        return Cache::rememberForever('nyg.settings', function () {
            return static::query()->pluck('value', 'key')->all();
        });
    }

    public static function get(string $key, mixed $default = null): mixed
    {
        return static::allCached()[$key] ?? $default;
    }
}

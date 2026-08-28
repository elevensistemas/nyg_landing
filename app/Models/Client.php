<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'logo_path', 'website_url', 'order', 'is_published',
    ];

    protected function casts(): array
    {
        return ['is_published' => 'boolean'];
    }

    public function scopePublished($query)
    {
        return $query->where('is_published', true)->orderBy('order');
    }

    public function getLogoUrlAttribute(): string
    {
        if (str_starts_with($this->logo_path, 'http://') || str_starts_with($this->logo_path, 'https://')) {
            return $this->logo_path;
        }
        if (str_starts_with($this->logo_path, 'images/')) {
            return asset($this->logo_path);
        }
        return asset('storage/'.$this->logo_path);
    }
}

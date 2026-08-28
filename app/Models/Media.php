<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    protected $table = 'media';

    protected $fillable = [
        'disk', 'path', 'original_name', 'alt_text', 'collection', 'size_bytes',
    ];

    public function getUrlAttribute(): string
    {
        return asset('storage/'.$this->path);
    }
}

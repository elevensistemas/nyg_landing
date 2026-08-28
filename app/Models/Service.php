<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Service extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'service_category_id',
        'name',
        'slug',
        'problem',
        'short_description',
        'description',
        'benefits',
        'icon',
        'cover_image',
        'order',
        'is_featured_on_home',
        'is_published',
    ];

    protected function casts(): array
    {
        return [
            'is_featured_on_home' => 'boolean',
            'is_published' => 'boolean',
        ];
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(ServiceCategory::class, 'service_category_id');
    }

    public function seo(): MorphOne
    {
        return $this->morphOne(SeoMetadata::class, 'seo_metadatable');
    }

    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('order')->orderBy('name');
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Page extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'slug', 'template', 'is_published'];

    protected function casts(): array
    {
        return ['is_published' => 'boolean'];
    }

    public function sections(): HasMany
    {
        return $this->hasMany(PageSection::class)->orderBy('order');
    }

    public function seo(): MorphOne
    {
        return $this->morphOne(SeoMetadata::class, 'seo_metadatable');
    }

    public function section(string $key): ?PageSection
    {
        return $this->sections->firstWhere('key', $key);
    }
}

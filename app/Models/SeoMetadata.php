<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class SeoMetadata extends Model
{
    protected $table = 'seo_metadata';

    protected $fillable = [
        'meta_title', 'meta_description', 'og_image', 'canonical_url', 'no_index',
    ];

    protected function casts(): array
    {
        return ['no_index' => 'boolean'];
    }

    public function seoMetadatable(): MorphTo
    {
        return $this->morphTo();
    }
}

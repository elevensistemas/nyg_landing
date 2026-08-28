<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class QuoteRequestAttachment extends Model
{
    protected $fillable = [
        'quote_request_id', 'original_name', 'path', 'mime_type', 'size_bytes',
    ];

    public function quoteRequest(): BelongsTo
    {
        return $this->belongsTo(QuoteRequest::class);
    }
}

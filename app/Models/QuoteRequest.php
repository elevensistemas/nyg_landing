<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class QuoteRequest extends Model
{
    use HasFactory;

    public const STATUSES = [
        'nueva' => 'Nueva',
        'en_analisis' => 'En análisis',
        'cotizada' => 'Cotizada',
        'ganada' => 'Ganada',
        'perdida' => 'Perdida',
    ];

    protected $fillable = [
        'full_name', 'company', 'email', 'phone',
        'service_id', 'service_type_other', 'origin', 'destination', 'cargo_type',
        'requires_temperature_control', 'temperature_requirement',
        'approx_weight_kg', 'approx_volume_m3', 'pallets_or_packages',
        'frequency', 'estimated_date', 'comments',
        'status', 'internal_notes', 'ip_address', 'user_agent', 'read_at',
    ];

    protected function casts(): array
    {
        return [
            'requires_temperature_control' => 'boolean',
            'estimated_date' => 'date',
            'read_at' => 'datetime',
            'approx_weight_kg' => 'decimal:2',
            'approx_volume_m3' => 'decimal:2',
        ];
    }

    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }

    public function attachments(): HasMany
    {
        return $this->hasMany(QuoteRequestAttachment::class);
    }
}

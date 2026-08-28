<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'email', 'phone', 'message', 'status', 'ip_address', 'user_agent', 'read_at',
    ];

    protected function casts(): array
    {
        return ['read_at' => 'datetime'];
    }
}

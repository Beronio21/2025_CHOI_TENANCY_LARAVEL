<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tenant extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'domain',
        'database',
        'is_active',
        'email',
        'subscription_plan',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function getDatabaseName(): string
    {
        return $this->database;
    }

    public function isActive(): bool
    {
        return $this->is_active;
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends TenantModel
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'content',
    ];
}

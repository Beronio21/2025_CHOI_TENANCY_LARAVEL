<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LaundryLog extends Model
{
    protected $fillable = [
        'date',
        'time_started',
        'person_responsible',
        'items_washed',
        'quantity_items',
        'how_many_kilo',
        'machine_used',
        'detergent_used',
        'how_many_detergent_used',
        'drying_method',
    ];
}

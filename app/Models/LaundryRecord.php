<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LaundryRecord extends Model
{
    protected $fillable = [
        'wash_id',
        'customer_name',
        'item_name',
        'qty',
        'kilos',
        'detergent_type',
        'detergent_used_g',
        'date_washed',
        'status'
    ];
}

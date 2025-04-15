<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentRecord extends Model
{
    protected $fillable = [
        'payment_id',
        'customer',
        'wash_id',
        'kilos',
        'rate_per_kg',
        'detergent_fee',
        'total_amount',
        'payment_status'
    ];
}

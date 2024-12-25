<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DepositInfo extends Model
{
    protected $fillable = [
        'amount',
        'userId',
        'transactionId',
        'paymentMethod',
        'paymentNumber',
    ];
}
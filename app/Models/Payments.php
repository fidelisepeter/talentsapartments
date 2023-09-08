<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payments extends Model
{
    use HasFactory;

    protected $table = 'referrals_payments';

    protected $fillable = [
        'referrer',
        'referral_code',
        // 'referent',
        'amount',
        
    ];
}

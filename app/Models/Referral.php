<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Referral extends Model
{
    use HasFactory;

    protected $table = 'referrals_earnings';

    protected $fillable = [
        'referrer',
        'referral_code',
        'referent',
        'amount',
        
    ];
}

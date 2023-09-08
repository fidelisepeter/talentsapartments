<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promo extends Model
{
    use HasFactory;

    protected $fillable = [
        'promo_code',
        'promo_type',
        'thumbnail',
        'description',
        'promo_data',
        'start_date',
        'end_date',
        'active',
        'show',
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guest extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
            'last_name',
            'phone_number',
            'email',
            'type',
            'date',
            'year',
            'visit_start',
            'visit_end',
            'code',
            'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function resident()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}

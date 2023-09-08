<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    use HasFactory;

    protected $fillable = [
        'supervisor_id',
        'department',
        'position',
        'salary',
        'year',
        'start_date',
    ];

    public function get()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function supervisor()
    {
        return $this->hasOne(User::class, 'id', 'supervisor_id');
    }

    public function department()
    {
        return $this->hasOne(Department::class);
    }
}

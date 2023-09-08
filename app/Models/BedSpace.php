<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BedSpace extends Model
{
    use HasFactory;

    protected $fillable = [
        'room_number',
        'name',
        'room_id',
        'user_id',
        'allocated',
        'room_label',
        'building_name',
        'year'
    ];

    
    public function rent(){
        return $this->hasOne(Rent::class, 'bed_space');
    }

    public function room(){
        return $this->belongsTo(Room::class, 'room_id');
    }

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
}

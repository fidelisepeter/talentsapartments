<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Room extends Model
{
    use HasFactory;

    protected $table = 'rooms';

    // public function getRentCountAttribute()
    // {
    //     $rent_count = DB::table('rents')->where('room_id', $this->id)->count();
    //     return $rent_count;
    // }

    // public function getCapacityAttribute()
    // {
    //     $capacity = $this->capacity * $this->no_of_rooms;
    //     return $capacity;
    //     // DB::table('bed_spaces')->where('room_id', $room->id)->whereNull('user_id')->where('allocated', false)->get()->count()
    // }
    public function getTotalRoomsAttribute()
    {
        return DB::table('bed_spaces')->where('room_id', $this->id)->where('year', DB::table('settings')->value('viewing_year'))->get()->unique('room_number')->count();
    }

    public function getAvailableAttribute()
    {
        
        return DB::table('bed_spaces')->where('room_id', $this->id)->whereNull('user_id')->where('allocated', false)->get()->count();
    }

    public function getBedspaceAttribute()
    {
        return DB::table('bed_spaces')->where('room_id', $this->id)->where('year', DB::table('settings')->value('viewing_year'))->get()->count();
    }
}

<?php

namespace App\Models;

use App\Models\Inventory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class InventoryCategory extends Model
{
    use HasFactory;
    protected $fillable = [
        "title",
        "description",
    ];

    public function inventories()
    {
        return $this->hasMany(Inventory::class, 'category_id');
    }
}

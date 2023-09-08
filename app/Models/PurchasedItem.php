<?php

namespace App\Models;

use App\Models\Inventory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PurchasedItem extends Model
{
    use HasFactory;
    public $table = 'purchased_items';

    protected $fillable = [
        'inventory_id',
        'quantity',
        'cost',
        'used_by',
        'description',
        'data',
        'task_id',
        'labour'
    ];

    public function inventory()
    {
        return $this->belongsTo(Inventory::class, 'inventory_id');
    }
}

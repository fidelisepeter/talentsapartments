<?php

namespace App\Models;

use App\Models\PurchasedItem;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Inventory extends Model
{
    use HasFactory;

    protected $fillable = [
        'item',
        'thumbnail',
        'category_id',
        'description',
        'cost',
        'quantity',
        'created_by',
        'updated',
    ];

    public function category()
    {
        return $this->belongsTo(InventoryCategory::class);
    }

    public function purchased()
    {
        return $this->hasMany(PurchasedItem::class, 'inventory_id', 'id');
    }

    public function getCategoryNameAttribute()
    {
        return $this->category->title;
    }

    public function getStatusAttribute()
    {
        if ($this->quantity-$this->purchased->sum('quantity') == 0) {
            return 'Out of Stock';
        } elseif (($this->quantity-$this->purchased->sum('quantity') - $this->purchased->sum('quantity')) <= 3) {
            return 'Low Stock';
        } elseif (($this->quantity-$this->purchased->sum('quantity') - $this->purchased->sum('quantity')) > 3) {
            return 'Available';
        }
    }

    // Custom accessor to get the available quantity for each inventory item
    public function getAvailableQuantityAttribute()
    {
        // Get the sum of purchased quantity for the current inventory item
        $sumOfPurchasedQuantity = $this->purchased()->sum('quantity');

        // Calculate the available quantity by subtracting the sum of purchased quantity from the total quantity
        return $this->quantity - $sumOfPurchasedQuantity;
    }
}

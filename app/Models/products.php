<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class products extends Model
{
    use HasFactory;

    // One Product belongs to one Category
    public function category()
    {
        return $this->belongsTo(categories::class, 'category_id');
    }

    // One Product can be present in many Order Items
    public function orderItems()
    {
        return $this->hasMany(order_items::class, 'product_id', 'id');
    }
}

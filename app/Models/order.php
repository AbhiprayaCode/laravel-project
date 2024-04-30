<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class order extends Model
{
    use HasFactory;

    protected $fillable = [
        "user_id",
        "status"
    ] ;

    // One Order belongs to one User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // One Order can have many Order Items
    public function orderItems()
    {
        return $this->hasMany(order_items::class);
    }
}

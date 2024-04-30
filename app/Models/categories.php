<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class categories extends Model
{
    use HasFactory;

    protected $table = "categories_tables";

    // One Category can have many Products
    public function products()
    {
        return $this->hasMany(products::class);
    }
}

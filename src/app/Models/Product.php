<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name', 'stock', 'price', 'category_id','imagen_path'];

    public function cartItem(){
        return $this->hasMany(CartItem::class);
    }

    public function orderItem(){
        return $this->hasMany(OrderItem::class);
    }

    public function discount(){
        return $this->hasMany(Discount::class);
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }
}

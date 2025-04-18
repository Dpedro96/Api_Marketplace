<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['orderDate', 'status', 'totalAmount', 'address_id', 'coupon_id', 'user_id'];

    public function orderItem(){
        return $this->hasMany(OrderItem::class);
    }

    public function products(){
        return $this->hasManyThrough(Product::class,OrderItem::class,'order_id','product_id','id','id');
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function address(){
        return $this->belongsTo(Address::class);
    }

    public function coupon(){
        return $this->belongsTo(Coupon::class);
    }
}

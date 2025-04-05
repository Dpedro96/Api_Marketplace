<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    protected $fillable = ['code', 'startDate', 'endDate', 'discountPercentage','user_id','address_id','coupon_id'];

    public function order(){
        return $this->hasMany(Order::class);
    }
}

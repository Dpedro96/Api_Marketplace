<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    protected $fillable = ['code', 'startDate', 'endDate', 'discountPercentage'];

    public function order(){
        return $this->hasMany(Order::class);
    }
}

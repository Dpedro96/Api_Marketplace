<?php
namespace App\Repositories;

use App\Models\Cart;

class CartRepositorie{
    public function __construct(protected Cart $cartModel){}
}
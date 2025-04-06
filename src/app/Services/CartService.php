<?php 
namespace App\Service;

use App\Repositories\CartRepositorie;

class CartService{
    public function __construct(protected CartRepositorie $cartRepositorie){}

    
}
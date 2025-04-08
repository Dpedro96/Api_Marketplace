<?php
namespace App\Repositories;

use App\Models\Cart;

class CartRepository{
    public function __construct(protected Cart $cartModel){}

    public function createCart($id){
        $this->cartModel->create([
            'user_id'=>$id
        ]);
    }
}
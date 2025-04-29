<?php
namespace App\Repositories;

use App\Models\CartItem;

class CartItemRepository{
    public function __construct(protected CartItem $cartItemModel){}

    public function createCartItem($data){
        return $this->cartItemModel->create($data);
    }

    public function getAllCartItems($cart_id){
        return $this->cartItemModel->with('product') ->where('cart_id', $cart_id)->get();
    }

    public function updateCartItem($data,$id,$cart_id){
        return $this->cartItemModel->where('cart_id',$cart_id)->findOrFail($id)->update($data);
    }

    public function removeCartItem($id,$cart_id){
        return $this->cartItemModel->where('cart_id',$cart_id)->findOrFail($id)->delete();
    }

    public function clearCartItems($cart_id){
        return $this->cartItemModel->where('cart_id',$cart_id)->delete();
    }
}
<?php
namespace App\Services;

use App\Repositories\CartItemRepository;
use App\Repositories\ProductRepository;
use Illuminate\Support\Facades\Auth;

class CartItemService{
    public function __construct(protected CartItemRepository $cartItemRepository, protected ProductRepository $productRepository){}

    public function create($data){
        $product=$this->productRepository->getByIdProduct($data['product_id']);
        $data+=array('unitPrice'=>$product->price,'cart_id'=>Auth::authenticate()->cart->id);
        return $this->cartItemRepository->createCartItem($data);
    }

    public function getAll(){
        return $this->cartItemRepository->getAllCartItems(Auth::authenticate()->cart->id);
    }

    public function updateCart($data,$id){
        return $this->cartItemRepository->updateCartItem($data,$id,Auth::authenticate()->cart->id);
    }

    public function remove($id){
        return $this->cartItemRepository->removeCartItem($id,Auth::authenticate()->cart->id);
    }

    public function clearCart(){
        return $this->cartItemRepository->clearCartItems(Auth::authenticate()->cart->id);
    }
}
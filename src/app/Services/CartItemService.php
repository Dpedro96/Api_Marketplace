<?php
namespace App\Services;

use App\Models\Discount;
use App\Repositories\CartItemRepository;
use App\Repositories\DiscountRepository;
use App\Repositories\ProductRepository;
use Illuminate\Support\Facades\Auth;

class CartItemService{
    public function __construct(
        protected CartItemRepository $cartItemRepository, 
        protected ProductRepository $productRepository, 
        protected DiscountRepository $discountRepository
    ){}

    public function create($data){
        $totalDiscount=0;
        
        $product=$this->productRepository->getByIdProduct($data['product_id']);

        if($data['quantity']>$product->stock){return "A quantidade solicitada excede o estoque disponível";}

        $disconts=$this->discountRepository->getByIdProductDiscount($product['id']);
        foreach($disconts as $discount){
            $totalDiscount+=$discount->discountPercentage;
        }

        $product->price-=$product->price*($totalDiscount/100);
        $data += [
            'unitPrice' => $product->price,
            'cart_id' => Auth::authenticate()->cart->id,
        ];
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
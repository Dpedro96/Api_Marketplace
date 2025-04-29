<?php
namespace App\Services;

use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
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

        if ($data['quantity'] > $product->stock) {
            throw new UnprocessableEntityHttpException('A quantidade solicitada excede o estoque disponível.');
        }

        $disconts=$this->discountRepository->getByIdProductDiscount($product['id']);
        foreach($disconts as $discount){
            $totalDiscount+=$discount->discountPercentage;
        }

        if($totalDiscount >= 100){
            $product->price = 0;
        }else{
            $product->price -= $product->price * ($totalDiscount / 100);
        }
        $data += [
            'unitPrice' => $product->price,
            'cart_id' => Auth::user()->cart->id,
        ];
        return $this->cartItemRepository->createCartItem($data);
    }

    public function getAll(){
        return $this->cartItemRepository->getAllCartItems(Auth::user()->cart->id);
    }

    public function updateCart($data, $id){
        try {
            return $this->cartItemRepository->updateCartItem($data, $id, Auth::user()->cart->id);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Item do carrinho não encontrado.'], 404);
        }
    }
    
    public function remove($id){
        try {
            return $this->cartItemRepository->removeCartItem($id, Auth::user()->cart->id);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Item do carrinho não encontrado.'], 404);
        }
    }

    public function clearCart(){
        return $this->cartItemRepository->clearCartItems(Auth::user()->cart->id);
    }
}
<?php 
namespace App\Services;

use App\Repositories\CartRepository;

class CartService{
    public function __construct(protected CartRepository $cartRepository){}

    public function create($id){
        $this->cartRepository->createCart($id);
    }
}
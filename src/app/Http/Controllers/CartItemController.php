<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCartItemRequest;
use App\Http\Requests\UpdateCartItemRequest;
use App\Services\CartItemService;
use Illuminate\Http\Request;

class CartItemController extends Controller
{
    public function __construct(protected CartItemService $cartItemService){}

    public function store(StoreCartItemRequest $request){
        return response()->json($this->cartItemService->create($request->validated()), 201);
    }

    public function index(){
        return response()->json($this->cartItemService->getAll(), 200);
    }

    public function update(UpdateCartItemRequest $request,$id){
        return response()->json($this->cartItemService->updateCart($request->validated(),$id), 200);
    }

    public function destroy($id){
        $this->cartItemService->remove($id);
        return response()->noContent(); 
    }
    
    public function clear(){
        $this->cartItemService->clearCart();
        return response()->noContent(); 
    }
}

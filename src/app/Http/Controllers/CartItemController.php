<?php

namespace App\Http\Controllers;

use App\Services\CartItemService;
use Illuminate\Http\Request;

class CartItemController extends Controller
{
    public function __construct(protected CartItemService $cartItemService){}

    public function store(Request $request){
        $data=$request->validate([
            'product_id'=>'required',
            'quantity'=>'required'
        ]);
        return response()->json($this->cartItemService->create($data), 201);
    }

    public function index(){
        return response()->json($this->cartItemService->getAll(), 201);
    }

    public function update(Request $request,$id){
        $data=$request->validate([
            'quantity'=>'required'
        ]);
        return response()->json($this->cartItemService->updateCart($data,$id), 201);
    }

    public function destroy($id){
        return response()->json($this->cartItemService->remove($id), 204);
    }

    public function clear(){
        return response()->json($this->cartItemService->clearCart(), 204);
    }
}

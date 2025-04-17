<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Services\OrderService;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function __construct(protected OrderService $orderService){}

    public function store(StoreOrderRequest $request){
        return response()->json($this->orderService->create($request->validated()), 201);
    }

    public function index(){
        return response()->json($this->orderService->getAll(), 201);
    }

    public function show($id){
        $order=$this->orderService->getById($id);
        return response()->json($order, 201);
    }

    public function update(UpdateOrderRequest $request, $id){
        return response()->json($this->orderService->update($request->validated(),$id), 201);
    }

    public function destroy($id){
        $order=$this->orderService->delete($id);
        if($order){
            return response()->json($order, 201);
        }
        return response()->json(['mensage'=>'Item não excluido'], 201);
    }
}

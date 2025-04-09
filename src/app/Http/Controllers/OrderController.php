<?php

namespace App\Http\Controllers;

use App\Services\OrderService;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function __construct(protected OrderService $orderService){}

    public function store(Request $request){
        $data = $request->validate([
            'address_id'=>'required',
            'coupon_id'=>'sometimes'
        ]);
        return response()->json($this->orderService->create($data), 201);
    }

    public function index(){
        return response()->json($this->orderService->getAll(), 201);
    }

    public function show($id){
        $order=$this->orderService->getById($id);
        return response()->json($order, 201);
    }

    public function update(Request $request, $id){
        $data = $request->validate([
            'status'=>'sometimes'
        ]);
        return response()->json($this->orderService->update($data,$id), 201);
    }

    public function destroy($id){
        $order=$this->orderService->delete($id);
        if($order){
            return response()->json($order, 201);
        }
        return response()->json(['mensage'=>'Item não excluido'], 201);
    }
}

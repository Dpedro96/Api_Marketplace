<?php

namespace App\Http\Controllers;

use App\Services\OrderService;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function __construct(protected OrderService $orderService){}

    public function store(Request $request){
        $data = $request->validate([
            'orderDate'=>'required',
            'status'=>'required',
            'totalAmount'=>'required',
            'address_id'=>'required',
            'coupon_id'=>'required'
        ]);
        $order=$this->orderService->create($data);
        return response()->json($order, 201);
    }

    public function index(){
        $orders=$this->orderService->getAll();
        return response()->json($orders, 201);
    }

    public function show($id){
        $order=$this->orderService->getById($id);
        return response()->json($order, 201);
    }

    public function update(Request $request, $id){
        $data = $request->validate([
            'status'=>'somentimes'
        ]);
        $order=$this->orderService->update($data,$id);
    }

    public function destroy($id){
        $order=$this->orderService->delete($id);
        if($order){
            return response()->json($order, 201);
        }
        return response()->json(['mensage'=>'Item não excluido'], 201);
    }
}

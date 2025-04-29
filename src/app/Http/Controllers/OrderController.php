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
        return response()->json($this->orderService->getAll(), 200);
    }

    public function show($id){
        $order=$this->orderService->getById($id);
        return response()->json($order, 200);
    }

    public function update(UpdateOrderRequest $request, $id){
        return response()->json($this->orderService->update($request->validated(),$id), 200);
    }

    public function destroy($id){
        $deleted = $this->orderService->delete($id);
        if ($deleted) {
            return response()->json(['message' => 'Pedido cancelado com sucesso.'], 200);
        }
        return response()->json(['message' => 'Pedido não encontrado ou não pôde ser cancelado.'], 404);
    }
    
}

<?php
namespace App\Repositories;

use App\Models\Order;

class OrderRepository{
    public function __construct(protected Order $orderModel){}

    public function createOrder($request){
        return $this->orderModel->create($request);
    }

    public function getAllOrders($user_id){
        return $this->orderModel->where('user_id',$user_id)->with('orderItem')->get();
    }

    public function getByIdOrder($id,$user_id){
        return $this->orderModel->where('user_id', $user_id)->where('id', $id)->with('orderItem')->first();
    }

    public function updateOrder($data, $id, $user_id){
        $order = $this->orderModel
            ->where('user_id', $user_id)
            ->where('id', $id)
            ->first();
    
        if (!$order) {
            throw new \Illuminate\Database\Eloquent\ModelNotFoundException("Pedido não encontrado.");
        }
    
        return $order->update($data);
    }

    public function deleteOrder($id, $user_id){
        $order = $this->orderModel
            ->where('user_id', $user_id)
            ->where('id', $id)
            ->first();
    
        if (!$order) {
            throw new \Illuminate\Database\Eloquent\ModelNotFoundException("Pedido não encontrado.");
        }
    
        return $order->update(['status' => 'CANCELED']);
    }
    
}

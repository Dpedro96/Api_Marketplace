<?php
namespace App\Repositories;

use App\Models\Order;

class OrderRepository{
    public function __construct(protected Order $orderModel){}

    public function createOrder($request){
        return $this->orderModel->create($request);
    }

    public function getAllOrders($user_id){
        return $this->orderModel->where('user_id',$user_id)->get();
    }

    public function getByIdOrder($id,$user_id){
        return $this->orderModel->where('user_id',$user_id)->find($id);
    }

    public function updateOrder($data,$id,$user_id){
        return $this->orderModel->where('user_id',$user_id)->find($id)->update($data);
    }

    public function deleteOrder($id,$user_id){
        return $this->orderModel->where('user_id',$user_id)->find($id)->update(['status'=>'CANCELED']);
    }
}

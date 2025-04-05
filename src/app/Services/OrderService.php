<?php
namespace App\Services;

use App\Repositories\OrderRepository;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Auth;

class OrderService{
    public function __construct(protected OrderRepository $orderRepository){}

    public function create($request){
        $user_id=Auth::id();
        $request+=array('user_id'=>$user_id);
        return $this->orderRepository->createOrder($request);
    }

    public function getAll(){
        $user_id=Auth::id();
        return $this->orderRepository->getAllOrders($user_id);
    }

    public function getById($id){
        $user_id=Auth::id();
        return $this->orderRepository->getByIdOrder($id,$user_id);
    }

    public function update($request, $id){
        $user_id=Auth::id();
        return $this->orderRepository->updateOrder($request,$id,$user_id);
    }

    public function delete($id){
        $user_id=Auth::id();
        return $this->orderRepository->deleteOrder($id,$user_id);
    }
}

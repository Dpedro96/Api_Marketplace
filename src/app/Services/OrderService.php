<?php
namespace App\Services;

use App\Repositories\CartItemRepository;
use App\Repositories\OrderRepository;
use App\Repositories\ProductRepository;
use App\Services\OrderItemService;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class OrderService{
    public function __construct(
    protected OrderRepository $orderRepository, 
    protected CartItemRepository $cartItemRepository,
    protected OrderItemService $orderItemService,
    protected ProductRepository $productRepository
    ){}

    public function create($request){
        $totalAmount=0;
        $cart_id=Auth::authenticate()->cart->id;
        $items=$this->cartItemRepository->getAllCartItems($cart_id);
        foreach($items as $item){
            $totalAmount+=$item->unitPrice*$item->quantity;
        }
        $request+=array(
            'status'=>'PENDING',
            'orderDate'=>Carbon::today(),
            'user_id'=>Auth::id(),
            'totalAmount'=>$totalAmount
        );
        $order=$this->orderRepository->createOrder($request);
        foreach($items as $item){
            $cartItems=array(
                'quantity'=>$item['quantity'],
                'unitPrice'=>$item['unitPrice'],
                'order_id'=>$order['id'],
                'product_id'=>$item['product_id'],
            );
            $product=$this->productRepository->getByIdProduct($item['product_id']);
            $data=['stock'=>($product->stock-$item['quantity'])];
            $this->productRepository->updateProduct($data,$item['product_id']);
            $this->orderItemService->addItemOrder($cartItems);
        }
        $this->cartItemRepository->clearCartItems($cart_id);
        return $order;
    }

    public function getAll(){
        return $this->orderRepository->getAllOrders(Auth::id());
    }

    public function getById($id){
        $user_id=Auth::id();
        return $this->orderRepository->getByIdOrder($id,$user_id);
    }

    public function update($request, $id){
        return $this->orderRepository->updateOrder($request,$id,Auth::id());
    }

    public function delete($id){
        $user_id=Auth::id();
        $check=$this->orderRepository->deleteOrder($id,$user_id);
        if(!$check){
            return false;
        }
        $item=$this->orderRepository->getByIdOrder($id,$user_id);
        foreach($item->orderItem as $item){
            $product=$this->productRepository->getByIdProduct($item->product_id);
            $data=['stock'=>$product->stock+$item->quantity];
            $this->productRepository->updateProduct($data,$item['product_id']);
        }
        return $check;
    }
}

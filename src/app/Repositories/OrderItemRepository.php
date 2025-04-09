<?php
namespace App\Repositories;

use App\Models\Order;
use App\Models\OrderItem;

class OrderItemRepository{
    public function __construct(protected OrderItem $orderItemModel){}

    public function createItemOrder($item){
        $this->orderItemModel->create($item);
    }
}
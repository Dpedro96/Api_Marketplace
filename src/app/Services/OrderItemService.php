<?php
namespace App\Services;

use App\Repositories\OrderItemRepository;

class OrderItemService{
    public function __construct(protected OrderItemRepository $orderItemRepository){}

    public function addItemOrder($item){
        $this->orderItemRepository->createItemOrder($item);
    }
}
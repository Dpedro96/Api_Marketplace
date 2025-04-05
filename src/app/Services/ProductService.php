<?php
namespace App\Services;

use App\Repositories\ProductRepository;

class ProductService{
    public function __construct(protected ProductRepository $productRepository){}

    public function create($data){
        return $this->productRepository->createProduct($data);
    }

    public function getAll(){
        return $this->productRepository->getAllProduct();
    }

    public function getById($id){
        return $this->productRepository->getByIdProduct($id);
    }

    public function update($data,$id){
        return $this->productRepository->updateProduct($data,$id);
    }

    public function delete($id){
        return $this->productRepository->deleteProduct($id);
    }
}
<?php
namespace App\Repositories;

use App\Models\Product;

class ProductRepository{
    public function __construct(protected Product $productModel){}

    public function createProduct($data){
        return $this->productModel->create($data);
    }

    public function getAllProduct(){
        return $this->productModel->get();
    }

    public function getByIdProduct($id){
        return $this->productModel->findOrFail($id);
    }
    
    public function updateProduct($data,$id){
        return $this->productModel->findOrFail($id)->update($data);
    }

    public function deleteProduct($id){
        return $this->productModel->findOrFail($id)->delete();
    }
}
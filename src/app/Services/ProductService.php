<?php
namespace App\Services;

use App\Repositories\ProductRepository;
use Illuminate\Support\Facades\URL;

class ProductService{
    public function __construct(protected ProductRepository $productRepository){}

    public function create($data){
        return $this->productRepository->createProduct($data);
    }

    public function getAll()
    {
        $products = $this->productRepository->getAllProduct();
        foreach ($products as $product) {
            $product->image_url = URL::to($product->imagen_path);
        }
        return $products;
    }

    public function getById($id)
    {
        $product = $this->productRepository->getByIdProduct($id);
        if ($product) {
            $product->image_url = URL::to($product->imagen_path);
        }
        return $product;
    }

    public function update($data,$id){
        return $this->productRepository->updateProduct($data,$id);
    }

    public function delete($id){
        return $this->productRepository->deleteProduct($id);
    }
}
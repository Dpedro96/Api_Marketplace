<?php
namespace App\Repositories;

use App\Models\Product;
use Carbon\Carbon;

class ProductRepository{
    public function __construct(protected Product $productModel){}

    public function createProduct($data){
        return $this->productModel->create($data);
    }

    public function getAllProduct(){
        return $this->productModel
        ->with(['discount' => function ($query) {
            $query->where('startDate', '<=', Carbon::now())
                  ->where('endDate', '>=', Carbon::now());
        }])
        ->get()
        ->map(function ($product) {
            $discount = $product->discount->sum('discountPercentage');
            $product->final_price = round($product->price * (1 - $discount / 100), 2);
            return $product;
        });
    }

    public function getByIdProduct($id){
        $product = $this->productModel
        ->with(['discount' => function ($query) {
            $query->where('startDate', '<=', Carbon::now())
                  ->where('endDate', '>=', Carbon::now());
        }])
        ->findOrFail($id);

        $discount = $product->discount->sum('discountPercentage');
        $product->final_price = round($product->price * (1 - $discount / 100), 2);
        return $product;
    }
    
    public function updateProduct($data,$id){
        return $this->productModel->findOrFail($id)->update($data);
    }

    public function deleteProduct($id){
        $product = Product::find($id);
        $product->delete();
    }
}
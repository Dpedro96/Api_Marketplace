<?php
namespace App\Services;

use App\Repositories\ImagenRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Ramsey\Uuid\Uuid;

class ImageService{

    public function __construct(protected ImagenRepository $imagenRepository){}

    public function store(Request $request){
        if($request->hasFile('image')){
            $image = $request->file('image');
            $ext=$image->getClientOriginalExtension();
            $imageName='media_'.Uuid::uuid4().'.'.$ext;
            return $imageName;
        }
    }

    public function storeUser(Request $request){
        $imageName=$this->store($request);
        $request->file('image')->storeAs('user', $imageName);
        $this->imagenRepository->createUser($imageName,Auth::id());
        return $imageName;
    }

    public function storeCategory(Request $request,$id){
        $imageName=$this->store($request);
        $request->file('image')->storeAs('category', $imageName);
        $this->imagenRepository->createCategory($imageName,$id);
        return $imageName;
    }

    public function storeProduct(Request $request,$id){
        $imageName=$this->store($request);
        $request->file('image')->storeAs('product', $imageName);
        $this->imagenRepository->createProduct($imageName,$id);
        return $imageName;
    }
}
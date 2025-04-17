<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAddressRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Services\AddressService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AddressController extends Controller
{
    public function __construct(protected AddressService $addressService){}

    public function store(StoreAddressRequest $request){
        $user = $this->addressService->create($request->validated());
        return response()->json($user, 201);
    }

    public function index(){
        $address = $this->addressService->getAll();
        return response()->json($address, 201);
    }

    public function show($address){}

    public function update(UpdateUserRequest $request, $id){
        $address = $this->addressService->update($request, $id);
        return response()->json($address, 201);
    }

    public function destroy($id){
        $this->addressService->delete($id);
        return response()->json(["mensage"=>"Endereço deletado"], 201);
    }
}

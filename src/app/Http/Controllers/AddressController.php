<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAddressRequest;
use App\Http\Requests\UpdateAddressRequest;
use App\Services\AddressService;

class AddressController extends Controller
{
    public function __construct(protected AddressService $addressService){}

    public function store(StoreAddressRequest $request){
        return response()->json($this->addressService->create($request->validated()), 201);
    }

    public function index(){
        return response()->json($this->addressService->getAll(), 200);
    }

    public function show($id){
        return response()->json($this->addressService->getById($id), 200);
    }

    public function update(UpdateAddressRequest $request, $id){
        return response()->json($this->addressService->update($request->validated(), $id), 200);
    }

    public function destroy($id){
        $this->addressService->delete($id);
        return response()->noContent();
    }
}

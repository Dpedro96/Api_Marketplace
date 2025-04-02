<?php

namespace App\Http\Controllers;

use App\Services\AddressService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AddressController extends Controller
{
    public function __construct(protected AddressService $addressService){}

    public function store(Request $request){
        $data = $request->validate([
            'street'=>'required',
            'number'=>'required',
            'zip'=>'required',
            'city'=>'required',
            'state'=>'required',
            'country'=>'required',
        ]);
        $user = $this->addressService->create($data);
        return response()->json($user, 201);
    }

    public function index(){
        $address = $this->addressService->getAll();
        return response()->json($address, 201);
    }

    public function show($address){}

    public function update(Request $request, $id){
        $data = $request->validate([
            'street'=>'sometimes',
            'number'=>'sometimes',
            'zip'=>'sometimes',
            'city'=>'sometimes',
            'state'=>'sometimes',
            'country'=>'sometimes'
        ]);
        $address = $this->addressService->update($data, $id);
        return response()->json($address, 201);
    }

    public function destroy($id){
        $this->addressService->delete($id);
        return response()->json(["mensage"=>"Endereço deletado"], 201);
    }
}

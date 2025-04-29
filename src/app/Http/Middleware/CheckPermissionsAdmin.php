<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class CheckPermissionsAdmin{
    public function handle(Request $request,\Closure $next){
        $isAdmin=Auth::authenticate()->role;
        if($isAdmin=='ADMIN'){
            return $next($request);
        }
        return response()->json(["Mensage"=>"Não Autorizado"], 401);
    }
}
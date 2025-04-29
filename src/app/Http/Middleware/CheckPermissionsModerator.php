<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckPermissionsModerator
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $isAdmin=Auth::authenticate()->role;
        if($isAdmin=='MODERATOR'||$isAdmin=='ADMIN'){
            return $next($request);
        }
        return response()->json(["Mensage"=>"Não Autorizado"], 401);
    }
}

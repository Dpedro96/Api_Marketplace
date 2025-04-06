<?php

namespace App\Http\Controllers;

use App\Service\CartService;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function __construct(protected CartService $cartService){}

}

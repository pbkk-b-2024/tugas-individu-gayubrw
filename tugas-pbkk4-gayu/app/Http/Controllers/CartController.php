<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class CartController extends Controller
{
    public function addToCart(Request $request, Product $product)
    {
        try {
            $cart = session()->get('cart', []);
            $cart[$product->id] = [
                "name" => $product->name,
                "quantity" => $request->quantity,
                "price" => $product->price,
                "size" => $request->size
            ];
            session()->put('cart', $cart);
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false], 500);
        }
    }

}
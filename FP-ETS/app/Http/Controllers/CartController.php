<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cart = Cart::firstOrCreate(['user_id' => auth()->id()]);
        return view('cart.index', compact('cart'));
    }

    public function add(Request $request, Product $product)
    {
        \Log::info('Add to cart request', $request->all());

        $request->validate([
            'quantity' => 'required|integer|min:1',
            'size' => 'required|string',
        ]);

        $cart = Cart::firstOrCreate(['user_id' => auth()->id()]);

        $cartItem = $cart->items()->where('product_id', $product->id)
            ->where('size', $request->size)
            ->first();

        if ($cartItem) {
            $cartItem->update([
                'quantity' => $cartItem->quantity + $request->quantity,
            ]);
        } else {
            $cart->items()->create([
                'product_id' => $product->id,
                'quantity' => $request->quantity,
                'size' => $request->size,
            ]);
        }

        \Log::info('Cart after adding item', ['cart_id' => $cart->id, 'items_count' => $cart->items->count()]);

        return redirect()->back()->with('success', 'Product added to cart successfully.');
    }

    public function remove(CartItem $cartItem)
    {
        $cartItem->delete();
        return redirect()->route('cart.index')->with('success', 'Product removed from cart.');
    }

    public function update(Request $request, CartItem $cartItem)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $cartItem->update([
            'quantity' => $request->quantity,
        ]);

        return redirect()->route('cart.index')->with('success', 'Cart updated successfully.');
    }

    public function checkout()
    {
        // Ambil cart dari session
        $cart = session()->get('cart');

        if (!$cart || !isset($cart['items'])) {
            // Jika cart kosong atau tidak ada data item, redirect ke halaman keranjang
            return redirect()->route('cart.index')->with('error', 'Your cart is empty');
        }

        // Menghitung total
        $total = collect($cart['items'])->sum(function($item) {
            return $item['product']->price * $item['quantity'];
        });

        // Kirim data ke view checkout
        return view('checkout', [
            'cart' => $cart,
            'total' => $total
        ]);
    }

    public function addToCart(Request $request, $productId)
    {
        $product = Product::findOrFail($productId);

        // Ambil cart dari session, jika tidak ada buat array baru
        $cart = session()->get('cart', ['items' => []]);

        // Tambah item ke cart
        $cart['items'][$productId] = [
            'product' => $product,
            'quantity' => $request->quantity,
            'size' => $request->size,
        ];

        // Simpan cart kembali ke session
        session()->put('cart', $cart);

        return redirect()->route('cart.index')->with('success', 'Product added to cart!');
    }
}
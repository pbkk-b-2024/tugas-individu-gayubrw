<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = Cart::where('user_id', auth()->id())->with('items.product')->first();
        
        $total = $cart && $cart->items ? $cart->items->sum(function ($item) {
            return $item->product->price * $item->quantity;
        }) : 0;

        return view('checkout', compact('cart', 'total'));
    }

    // Menampilkan halaman checkout
    public function show()
    {
        // Menampilkan form checkout
        return view('checkout');
    }

    // Method untuk memproses form checkout
    public function process(Request $request)
    {
        // Validasi data checkout dari form
        $validated = $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'address' => 'required',
            'city' => 'required',
            'province' => 'required',
            'postal_code' => 'required',
            // Validasi lainnya
        ]);

        // Proses order
        // Simpan data order ke dalam database atau logika bisnis lainnya

        // Redirect kembali ke halaman checkout atau halaman sukses dengan pesan sukses
        return redirect()->route('checkout')->with('success', 'Order completed successfully!');
    }

    public function processOrder(Request $request)
    {
        try {
            DB::beginTransaction();

            $validatedData = $request->validate([
                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'address' => 'required|string|max:255',
                'city' => 'required|string|max:255',
                'province' => 'required|string|max:255',
                'postal_code' => 'required|string|max:20',
            ]);

            $cart = Cart::where('user_id', auth()->id())->with('items.product')->firstOrFail();
            
            if ($cart->items->isEmpty()) {
                throw new \Exception('Your cart is empty.');
            }

            $total = $cart->items->sum(function ($item) {
                return $item->product->price * $item->quantity;
            });
            
            $shippingAddress = $validatedData['address'] . ', ' .
                               $validatedData['city'] . ', ' .
                               $validatedData['province'] . ' ' .
                               $validatedData['postal_code'];

            $order = Order::create([
                'user_id' => auth()->id(),
                'total' => $total,
                'status' => 'pending',
                'shipping_address' => $shippingAddress,
            ]);

            foreach ($cart->items as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'quantity' => $item->quantity,
                    'price' => $item->product->price,
                    'size' => $item->size,
                ]);
            }

            $cart->items()->delete();
            $cart->delete();

            DB::commit();

            return redirect()->route('orders.confirmation', ['order' => $order->id])
                 ->with('success', 'Your order has been placed successfully!');
        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Order processing error: ' . $e->getMessage());
            return redirect()->route('checkout')
                             ->with('error', 'There was an error processing your order: ' . $e->getMessage());
        }
    }
}

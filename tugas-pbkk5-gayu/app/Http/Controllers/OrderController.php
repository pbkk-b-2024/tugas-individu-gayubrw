<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        // Jika user adalah admin, ambil semua pesanan
        if (Auth::user()->isAdmin()) {
            $orders = Order::all(); // Admin melihat semua order
        } else {
            // Jika user biasa, hanya ambil pesanan milik user tersebut
            $orders = Order::where('user_id', Auth::id())->get(); // Guest melihat pesanan sendiri
        }

        // Tampilkan view dengan data pesanan
        return view('orders.index', compact('orders'));
    }

    public function confirmation(Order $order)
    {
        // Ensure the user can only view their own orders
        if ($order->user_id !== auth()->id()) {
            abort(403);
        }

        return view('orders.confirmation', compact('order'));
    }

    public function show($id)
    {
        $order = Order::findOrFail($id);

        // Pastikan user hanya bisa melihat order mereka sendiri kecuali mereka admin
        if (Auth::user()->isAdmin() || $order->user_id == Auth::id()) {
            return view('orders.show', compact('order'));
        } else {
            abort(403, 'Unauthorized action.');
        }

        return view('orders.show', compact('order')); // Arahkan ke view orders.show
    }
}

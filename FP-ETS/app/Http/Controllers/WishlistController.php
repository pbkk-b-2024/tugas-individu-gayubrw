<?php

namespace App\Http\Controllers;

use App\Models\Wishlist;
use App\Models\Product;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    public function index()
    {
        // Ambil wishlist berdasarkan user yang login
        $wishlistItems = Wishlist::where('user_id', auth()->id())->with('product')->get();

        return view('wishlist.index', compact('wishlistItems'));
    }

    public function add(Request $request, Product $product)
    {
        // Validasi jika produk sudah ada di wishlist user
        $wishlistItem = Wishlist::where('user_id', auth()->id())
                                ->where('product_id', $product->id)
                                ->first();

        if ($wishlistItem) {
            return response()->json([
                'success' => false,
                'message' => 'Product is already in your wishlist.'
            ]);
        }

        // Jika belum ada, tambahkan ke wishlist
        Wishlist::create([
            'user_id' => auth()->id(),
            'product_id' => $product->id
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Product added to wishlist successfully.'
        ]);
    }

    public function remove(Wishlist $wishlistItem)
    {
        // Pastikan item wishlist milik user yang login
        if ($wishlistItem->user_id !== auth()->id()) {
            return redirect()->back()->with('error', 'Unauthorized action.');
        }

        // Hapus item wishlist
        $wishlistItem->delete();

        return redirect()->route('wishlist.index')->with('success', 'Product removed from wishlist.');
    }
}

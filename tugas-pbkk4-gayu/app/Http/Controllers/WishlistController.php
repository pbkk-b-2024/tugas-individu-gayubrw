<?php

namespace App\Http\Controllers;

use App\Models\Wishlist;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class WishlistController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();
        $wishlistItems = Wishlist::where('user_id', $user->id)->with('product')->get();
        return view('wishlist.index', compact('wishlistItems'));
    }

    public function add(Request $request, Product $product)
    {
        $user = Auth::user();
        
        // Check if the product is already in the wishlist
        $existingWishlistItem = Wishlist::where('user_id', $user->id)
                                        ->where('product_id', $product->id)
                                        ->first();

        if (!$existingWishlistItem) {
            Wishlist::create([
                'user_id' => $user->id,
                'product_id' => $product->id
            ]);
            return response()->json(['success' => true, 'message' => 'Product added to wishlist successfully']);
        }

        return response()->json(['success' => false, 'message' => 'Product already in wishlist']);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Log::info('Attempting to delete wishlist item', ['wishlist_id' => $id, 'user_id' => Auth::id()]);

        try {
            $wishlist = Wishlist::where('id', $id)
                                ->where('user_id', Auth::id())
                                ->firstOrFail();

            Log::info('Wishlist item found', ['wishlist' => $wishlist]);

            $result = $wishlist->delete();

            Log::info('Delete result', ['result' => $result]);

            if ($result) {
                return response()->json([
                    'success' => true,
                    'message' => 'Item removed from wishlist successfully'
                ]);
            } else {
                Log::error('Failed to delete wishlist item', ['wishlist_id' => $id]);
                return response()->json([
                    'success' => false,
                    'message' => 'Failed to remove item from wishlist'
                ], 500);
            }
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            Log::warning('Wishlist item not found or not owned by user', ['wishlist_id' => $id, 'user_id' => Auth::id()]);
            return response()->json([
                'success' => false,
                'message' => 'Wishlist item not found'
            ], 404);
        } catch (\Exception $e) {
            Log::error('Error in destroy method', ['error' => $e->getMessage(), 'wishlist_id' => $id]);
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while removing the item from wishlist'
            ], 500);
        }
    }
}

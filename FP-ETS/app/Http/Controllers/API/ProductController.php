<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $sort = $request->input('sort');

        $query = Product::query();

        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('status', 'like', "%{$search}%");
            });
        }

        if ($sort) {
            switch ($sort) {
                case 'price_asc':
                    $query->orderBy('price', 'asc');
                    break;
                case 'price_desc':
                    $query->orderBy('price', 'desc');
                    break;
            }
        }

        $products = $query->paginate(8);

        return response()->json([
            'data' => $products->items(),
            'current_page' => $products->currentPage(),
            'last_page' => $products->lastPage(),
            'per_page' => $products->perPage(),
            'total' => $products->total(),
        ]);
    }

    public function store(Request $request)
    {
        if (Gate::denies('admin-access')) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $validatedData = $request->validate([
            'name' => 'required',
            'price' => 'required|integer',
            'stock' => 'required|integer',
            'status' => 'required',
            'image_url' => 'nullable|url',
            'category_id' => 'required|exists:categories,id',
            'detail' => 'nullable',
        ]);

        if (isset($validatedData['detail'])) {
            $validatedData['detail'] = str_replace("\r\n", "\n", $validatedData['detail']);
        }

        $product = Product::create($validatedData);

        return response()->json($product, 201);
    }

    public function show(Product $product)
    {
        return response()->json($product);
    }

    public function update(Request $request, Product $product)
    {
        if (Gate::denies('admin-access')) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $validatedData = $request->validate([
            'name' => 'sometimes|required',
            'price' => 'sometimes|required|integer',
            'stock' => 'sometimes|required|integer',
            'status' => 'sometimes|required',
            'image_url' => 'nullable|url',
            'category_id' => 'sometimes|required|exists:categories,id',
            'detail' => 'nullable',
        ]);

        if (isset($validatedData['detail'])) {
            $validatedData['detail'] = str_replace("\r\n", "\n", $validatedData['detail']);
        }

        $product->update($validatedData);

        return response()->json($product);
    }

    public function destroy(Product $product)
    {
        if (Gate::denies('admin-access')) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $product->delete();

        return response()->json(null, 204);
    }
}
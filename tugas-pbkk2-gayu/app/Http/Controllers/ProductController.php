<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        // Ambil kata kunci pencarian dari query string
        $search = $request->input('search');

        // Query produk berdasarkan kata kunci pencarian dan dengan pagination
        $products = Product::where('name', 'like', "%{$search}%")
                            ->orWhere('status', 'like', "%{$search}%")
                            ->paginate(8);

        // Tambahkan query string ke pagination link agar tetap terhubung saat paging
        $products->appends(['search' => $search]);
        
        return view('products.index', compact('products', 'search'));
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|integer',
            'stock' => 'required|integer',
            'status' => 'required',
            'image_url' => 'nullable|url',
        ]);

        Product::create($request->all());

        return redirect()->route('products.index')->with('success', 'Produk berhasil ditambahkan.');
    }

    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|integer',
            'stock' => 'required|integer',
            'status' => 'required',
            'image_url' => 'nullable|url',
        ]);

        $product->update($request->all());

        return redirect()->route('products.index')->with('success', 'Produk berhasil diperbarui.');
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('products.index')->with('success', 'Produk berhasil dihapus.');
    }

        public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }
    
}


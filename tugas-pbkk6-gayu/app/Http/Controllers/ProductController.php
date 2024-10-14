<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate; // Import Gate

class ProductController extends Controller
{
    public function index(Request $request)
    {
        // Ambil kata kunci pencarian dan pengurutan dari query string
        $search = $request->input('search');
        $sort = $request->input('sort');

        // Mulai query
        $query = Product::query();

        // Terapkan pencarian jika ada
        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                ->orWhere('status', 'like', "%{$search}%");
            });
        }

        // Terapkan pengurutan jika ada
        if ($sort) {
            switch ($sort) {
                case 'price_asc':
                    $query->orderBy('price', 'asc');
                    break;
                case 'price_desc':
                    $query->orderBy('price', 'desc');
                    break;
                // Anda bisa menambahkan opsi pengurutan lain di sini
            }
        }

        // Eksekusi query dengan pagination
        $products = $query->paginate(8);

        // Tambahkan query string ke pagination link
        $products->appends(['search' => $search, 'sort' => $sort]);

        // Jika request adalah AJAX, kembalikan partial view
        if ($request->ajax()) {
            return response()->json([
                'products' => view('products._product_list', compact('products'))->render(),
                'pagination' => view('pagination.custom', ['paginator' => $products])->render(),
            ]);
        }
        
        // Jika bukan AJAX, kembalikan view lengkap
        return view('products.index', compact('products', 'search', 'sort'));
    }

    public function create()
    {
        // Cek apakah user memiliki akses admin
        if (Gate::denies('admin-access')) {
            abort(403, 'Unauthorized'); // Jika bukan admin, munculkan error 403
        }

        $categories = Category::all();
        return view('products.create', compact('categories'));    }

    public function store(Request $request)
    {
        // Cek apakah user memiliki akses admin
        if (Gate::denies('admin-access')) {
            abort(403, 'Unauthorized');
        }

        $request->validate([
            'name' => 'required',
            'price' => 'required|integer',
            'stock' => 'required|integer',
            'status' => 'required',
            'image_url' => 'nullable|url',
            'category_id' => 'required|exists:categories,id',
        ]);

        // Ensure line breaks are preserved in detail
        if (isset($validatedData['detail'])) {
            $validatedData['detail'] = str_replace("\r\n", "\n", $validatedData['detail']);
        }

        Product::create($request->all());

        return redirect()->route('products.index')->with('success', 'Produk berhasil ditambahkan.');
    }

    public function edit(Product $product)
    {
        // Cek apakah user memiliki akses admin
        if (Gate::denies('admin-access')) {
            abort(403, 'Unauthorized');
        }

        $categories = Category::all();
        return view('products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        // Cek apakah user memiliki akses admin
        if (Gate::denies('admin-access')) {
            abort(403, 'Unauthorized');
        }
  
        // Ensure line breaks are preserved
        if (isset($request['detail'])) {
            $request['detail'] = str_replace("\r\n", "\n", $request['detail']);
        }

        $product->update($request->all());

        return redirect()->route('products.index')->with('success', 'Produk berhasil diperbarui.');
    }

    public function destroy(Product $product)
    {
        // Cek apakah user memiliki akses admin
        if (Gate::denies('admin-access')) {
            abort(403, 'Unauthorized');
        }

        $product->delete();

        return redirect()->route('products.index')->with('success', 'Produk berhasil dihapus.');
    }

    public function show($id)
    {
        $product = Product::find($id);
        $sizes = [
            'XS', 'S', 'M', 'L', 'XL', '2XL'
            // ukuran lain jika ada
        ];

        return view('products.show', compact('product', 'sizes'));
    }

    public function addToCart(Request $request, $id)
    {
        $product = Product::find($id);
        $cart = session()->get('cart', []);

        $cart[$id] = [
            "name" => $product->name,
            "quantity" => $request->quantity,
            "price" => $product->price,
            "size" => $request->size,
            "image" => $product->image_url
        ];

        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }

}

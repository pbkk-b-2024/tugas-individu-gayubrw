<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate; // Import Gate

class ReviewController extends Controller
{
    // Method to store the review
    public function store(Request $request, $productId) {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string',
        ]);
    
        // Simpan review dengan product_id
        Review::create([
            'product_id' => $productId,
            'user_id' => auth()->id(), // Misalnya jika user sudah login
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);
    
        return redirect()->back()->with('success', 'Review submitted successfully!');
    }

    public function index() {

        // Cek apakah user memiliki akses admin
        if (Gate::denies('admin-access')) {
            abort(403, 'Unauthorized'); // Jika bukan admin, munculkan error 403
        }

        $reviews = Review::all(); // Mengambil semua review dari database
        return view('reviews.index', compact('reviews')); // Kirim data ke view
    }
}
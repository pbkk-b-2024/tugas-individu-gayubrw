<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function index()
    {
        // Logika untuk menampilkan daftar categories
        // Untuk saat ini, kita hanya akan me-render view
        return view('categories.index');
    }
}
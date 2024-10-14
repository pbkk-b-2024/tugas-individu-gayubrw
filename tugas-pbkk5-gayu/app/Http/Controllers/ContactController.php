<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        return view('contact'); // Pastikan ada file contact.blade.php di folder views
    }
}


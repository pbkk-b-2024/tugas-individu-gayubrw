<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function index()
    {
        // Dummy data untuk 5 review
        $reviews = [
            [
                'name' => 'Via',
                'rating' => 5,
                'comment' => 'Produk paling keren, yg susah dimiliki karena kalah WAR. wkwkwk. buat catharsis ttep keren dengan designya..ditunggu koleksi yg lainnya. Chill nextime Peaceout Men.',
                'product' => 'Catharsis EMPIRE - Izanagiryū & Izanamiryū (Bomber Jacket)',
                'time' => '2 hari lalu'
            ],
            [
                'name' => 'Obel',
                'rating' => 5,
                'comment' => 'menyala abangku',
                'product' => 'Catharsis REBORN - Ruin (Coach Jacket)',
                'time' => '2 hari lalu'
            ],
            [
                'name' => 'Gian',
                'rating' => 5,
                'comment' => 'Keren banget sih ini, sayang kehabisan',
                'product' => 'Catharsis EMPIRE - Izanagiryū & Izanamiryū (Bomber Jacket)',
                'time' => '3 hari lalu'
            ],
            [
                'name' => 'Fadhil',
                'rating' => 3,
                'comment' => 'Bagus, tapi harganya agak mahal',
                'product' => 'Catharsis REBORN - Ruin (Coach Jacket)',
                'time' => '4 hari lalu'
            ],
            [
                'name' => 'Panjul',
                'rating' => 3,
                'comment' => 'Kualitas oke, tapi ukurannya agak kecil',
                'product' => 'Catharsis EMPIRE - Izanagiryū & Izanamiryū (Bomber Jacket)',
                'time' => '5 hari lalu'
            ]
        ];

        $averageRating = 4.2; // (5+5+5+3+3) / 5
        $totalReviews = 2936; // Sesuai dengan gambar

        return view('reviews.index', compact('reviews', 'averageRating', 'totalReviews'));
    }
}
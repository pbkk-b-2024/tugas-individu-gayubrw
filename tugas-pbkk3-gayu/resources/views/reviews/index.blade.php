@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 sm:px-8 bg-black text-white">
    <div class="py-8">
        <h2 class="text-2xl font-semibold mb-4">ULASAN PILIHAN</h2>
        <p class="mb-4">Menampilkan 5 dari {{ $totalReviews }} ulasan</p>
        <div class="bg-gray-900 rounded-lg p-6">
            <div class="flex items-center mb-4">
                <div class="text-5xl font-bold text-yellow-400 mr-4">{{ number_format($averageRating, 1) }}</div>
                <div>
                    <div class="flex text-yellow-400">
                        @for ($i = 1; $i <= 5; $i++)
                            <svg class="w-5 h-5 fill-current {{ $i <= round($averageRating) ? 'text-yellow-400' : 'text-gray-400' }}" viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>
                        @endfor
                    </div>
                    <p class="text-sm">{{ $totalReviews }} ulasan</p>
                </div>
            </div>
            
            @foreach ($reviews as $review)
                <div class="mb-6 pb-6 border-b border-gray-700">
                    <div class="flex items-center mb-2">
                        <div class="flex text-yellow-400">
                            @for ($i = 1; $i <= 5; $i++)
                                <svg class="w-4 h-4 fill-current {{ $i <= $review['rating'] ? 'text-yellow-400' : 'text-gray-400' }}" viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>
                            @endfor
                        </div>
                        <span class="ml-2 text-sm">{{ $review['time'] }}</span>
                    </div>
                    <p class="font-bold mb-1">{{ $review['name'] }}</p>
                    <p class="text-sm mb-2">{{ $review['comment'] }}</p>
                    <p class="text-xs text-gray-400">{{ $review['product'] }}</p>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
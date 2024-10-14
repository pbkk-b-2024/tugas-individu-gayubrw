@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <h1 class="text-4xl font-bold mb-8 text-white">All Reviews</h1>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($reviews as $review)
            <div class="bg-gray-800 shadow-lg rounded-lg p-6">
                <div class="flex items-center mb-4">
                    <div class="flex-shrink-0">
                        <img class="w-10 h-10 rounded-full" src="{{ $review->user->profile_photo_url ?? 'https://via.placeholder.com/150' }}" alt="{{ $review->user->name }}">
                    </div>
                    <div class="ml-4">
                        <div class="text-xl font-bold text-white">{{ $review->user->name }}</div>
                        <div class="text-sm text-gray-400">{{ $review->created_at->diffForHumans() }}</div>
                    </div>
                </div>

                <!-- Display product name -->
                <div class="mb-2">
                    <span class="block text-lg text-blue-400 font-semibold">
                        {{ $review->product->name }}
                    </span>
                </div>

                <div class="flex items-center mb-2">
                    <div class="flex text-yellow-400">
                        @for ($i = 1; $i <= 5; $i++)
                            <svg class="w-5 h-5 fill-current {{ $i <= $review->rating ? 'text-yellow-400' : 'text-gray-600' }}" viewBox="0 0 24 24">
                                <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/>
                            </svg>
                        @endfor
                    </div>
                    <span class="ml-2 text-sm text-gray-400">Rated {{ $review->rating }} stars</span>
                </div>

                <p class="text-gray-300 mb-4">{{ $review->comment }}</p>

                <div class="text-right">
                    <a href="{{ route('products.show', $review->product->id) }}" class="text-sm text-blue-500 hover:underline">View Product</a>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection

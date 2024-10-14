@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4">
    <h2 class="text-2xl font-semibold text-white mb-4">Category: {{ $category->name }}</h2>
    
    <div class="mb-8">
        <h3 class="text-xl font-semibold text-white mb-2">Products in this category:</h3>
        @if($category->products->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach($category->products as $product)
                    <div class="bg-gray-800 p-4 rounded-lg shadow">
                        <h4 class="text-lg font-semibold text-white mb-2">{{ $product->name }}</h4>
                        <p class="text-gray-300 mb-2">Price: Rp{{ number_format($product->price, 2) }}</p>
                        <p class="text-gray-300 mb-2">Stock: {{ $product->stock }}</p>
                        @if($product->image_url)
                            <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-auto h-auto object-cover rounded mb-2">
                        @endif
                        <a href="{{ route('products.show', $product) }}" class="inline-block bg-red-700 text-white px-4 py-2 rounded hover:bg-red-600">View Details</a>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-gray-300">No products in this category yet.</p>
        @endif
    </div>

    <a href="{{ route('categories.index') }}" class="inline-block bg-gray-700 text-white px-4 py-2 rounded hover:bg-gray-600">Back to Categories</a>
</div>
@endsection
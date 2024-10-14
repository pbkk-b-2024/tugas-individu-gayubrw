@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="flex flex-col md:flex-row -mx-4">
        <div class="md:flex-1 px-4">
            <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-full">
        </div>
        <div class="md:flex-1 px-4">
            <h2 class="text-2xl font-bold mb-2">{{ $product->name }}</h2>
            <p class="text-gray-600 text-sm mb-4">{{ $product->description }}</p>
            <div class="flex mb-4">
                <div class="mr-4">
                    <span class="font-bold text-gray-700">Harga:</span>
                    <span class="text-gray-600">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                </div>
                <div>
                    <span class="font-bold text-gray-700">Status:</span>
                    <span class="text-gray-600">{{ $product->status }}</span>
                </div>
            </div>
            <div class="mb-4">
                <span class="font-bold text-gray-700">Ukuran:</span>
                <div class="flex items-center mt-2">
                    @foreach(['S', 'M', 'L', 'XL', 'XXL'] as $size)
                    <button class="bg-gray-300 text-gray-700 py-2 px-4 rounded-full mr-2">{{ $size }}</button>
                    @endforeach
                </div>
            </div>
            <div>
                <span class="font-bold text-gray-700">Stok:</span>
                <span class="text-gray-600">{{ $product->stock > 0 ? $product->stock : 'Habis' }}</span>
            </div>
        </div>
    </div>
</div>
@endsection
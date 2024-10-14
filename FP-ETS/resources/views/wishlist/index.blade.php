@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h2 class="text-3xl font-bold text-white mb-8">My Wishlist</h2>
    
    @if($wishlistItems->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($wishlistItems as $item)
                <div class="relative group">
                    @if($item->product->image_url)
                        <img src="{{ $item->product->image_url }}" alt="{{ $item->product->name }}" class="w-full h-[500px] object-cover">
                    @else
                        <div class="w-full h-[500px] bg-gray-800"></div>
                    @endif
                    <div class="absolute bottom-0 left-0 right-0 bg-black bg-opacity-70 p-4 transform translate-y-full group-hover:translate-y-0 transition-transform duration-300">
                        <h4 class="text-xl font-bold text-white mb-2">{{ $item->product->name }}</h4>
                        <p class="text-gray-300 mb-2">Rp{{ number_format($item->product->price, 0, ',', '.') }}</p>
                        <div class="flex justify-between">
                            <a href="{{ route('products.show', $item->product) }}" class="inline-block bg-white text-black px-4 py-2 rounded-full hover:bg-gray-200 transition">View Details</a>
                            <form action="{{ route('wishlist.remove', $item) }}" method="POST" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-full hover:bg-red-600 transition">Remove</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <p class="text-gray-300">Your wishlist is empty.</p>
    @endif
</div>
@endsection

@push('styles')
<style>
    body {
        background-color: #000;
        color: #fff;
    }
</style>
@endpush

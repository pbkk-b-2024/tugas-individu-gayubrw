@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4">
    <h2 class="text-2xl font-semibold text-white mb-4">Categories</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        @foreach($categories as $category)
            <div class="bg-gray-800 p-4 rounded-lg shadow">
                <h3 class="text-xl font-semibold text-white mb-2">{{ $category->name }}</h3>
                <p class="text-gray-300">Products: {{ $category->products->count() }}</p>
                <a href="{{ route('categories.show', $category) }}" class="mt-2 inline-block bg-red-700 text-white px-4 py-2 rounded hover:bg-red-600">View Products</a>
            </div>
        @endforeach
    </div>
</div>
@endsection
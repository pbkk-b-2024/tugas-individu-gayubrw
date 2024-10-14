@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4">
    <h2 class="text-white text-2xl font-semibold">Edit Produk</h2>
    <form action="{{ route('products.update', $product->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label for="name" class="block text-white">Nama Produk:</label>
            <input type="text" name="name" value="{{ $product->name }}" class="w-full px-3 py-2 bg-black" required>
        </div>
        <div class="mb-4">
            <label for="price" class="block text-white">Harga:</label>
            <input type="number" name="price" value="{{ $product->price }}" class="w-full px-3 py-2 bg-black" required>
        </div>
        <div class="mb-4">
            <label for="stock" class="block text-white">Stok:</label>
            <input type="number" name="stock" value="{{ $product->stock }}" class="w-full px-3 py-2 bg-black" required>
        </div>
        <div class="mb-4">
            <label for="status" class="block text-white">Status:</label>
            <select name="status" class="w-full px-3 py-2 bg-black" required>
                <option value="Aktif" {{ $product->status == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                <option value="Tidak Aktif" {{ $product->status == 'Tidak Aktif' ? 'selected' : '' }}>Tidak Aktif</option>
            </select>
        </div>
        <div class="mb-4">
            <label for="image_url" class="block text-white">URL Gambar:</label>
            <input type="url" name="image_url" value="{{ $product->image_url }}" class="w-full px-3 py-2 bg-black">
        </div>
        <button type="submit" class="bg-red-900 text-white px-4 py-2">Update</button>
    </form>
</div>
@endsection

@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4">
    <h2 class="text-white text-2xl font-semibold mb-6">Edit Produk</h2>
    <form action="{{ route('products.update', $product->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label for="name" class="block text-white mb-2">Nama Produk:</label>
            <input type="text" name="name" value="{{ $product->name }}" class="w-full px-3 py-2 bg-black text-white rounded" required>
        </div>
        <div class="mb-4">
            <label for="price" class="block text-white mb-2">Harga:</label>
            <input type="number" name="price" value="{{ $product->price }}" class="w-full px-3 py-2 bg-black text-white rounded" required>
        </div>
        <div class="mb-4">
            <label for="stock" class="block text-white mb-2">Stok:</label>
            <input type="number" name="stock" value="{{ $product->stock }}" class="w-full px-3 py-2 bg-black text-white rounded" required>
        </div>
        <div class="mb-4">
            <label for="status" class="block text-white mb-2">Status:</label>
            <select name="status" class="w-full px-3 py-2 bg-black text-white rounded" required>
                <option value="Aktif" {{ $product->status == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                <option value="Tidak Aktif" {{ $product->status == 'Tidak Aktif' ? 'selected' : '' }}>Tidak Aktif</option>
            </select>
        </div>
        <div class="mb-4">
            <label for="category_id" class="block text-white mb-2">Kategori:</label>
            <select name="category_id" class="w-full px-3 py-2 bg-black text-white rounded" required>
                <option value="">Pilih Kategori</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="mb-4">
            <label for="image_url" class="block text-white mb-2">URL Gambar Produk:</label>
            <input type="url" name="image_url" value="{{ $product->image_url }}" class="w-full px-3 py-2 bg-black text-white rounded">
        </div>
        <div class="mb-4">
            <label for="size_guide_url" class="block text-white mb-2">URL Gambar Size Guide:</label>
            <input type="url" name="size_guide_url" value="{{ $product->size_guide_url }}" class="w-full px-3 py-2 bg-black text-white rounded">
        </div>
        <div class="mb-4">
            <label for="detail" class="block text-white mb-2">Detail Produk:</label>
            <textarea name="detail" rows="10" class="w-full px-3 py-2 bg-black text-white rounded font-mono" style="white-space: pre-wrap;">{{ $product->detail }}</textarea>
        </div>
        <button type="submit" class="bg-red-900 text-white px-4 py-2 rounded hover:bg-red-700">Update</button>
    </form>
</div>
@endsection
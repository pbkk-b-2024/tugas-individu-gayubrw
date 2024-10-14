@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4">
    <h2 class="text-white text-2xl font-semibold">Tambah Produk</h2>
    <form action="{{ route('products.store') }}" method="POST">
        @csrf
        <div class="mb-4">
            <label for="name" class="block text-white">Nama Produk:</label>
            <input type="text" name="name" class="w-full px-3 py-2 bg-black" required>
        </div>
        <div class="mb-4">
            <label for="price" class="block text-white">Harga:</label>
            <input type="number" name="price" class="w-full px-3 py-2 bg-black" required>
        </div>
        <div class="mb-4">
            <label for="stock" class="block text-white">Stok:</label>
            <input type="number" name="stock" class="w-full px-3 py-2 bg-black" required>
        </div>
        <div class="mb-4">
            <label for="status" class="block text-white">Status:</label>
            <select name="status" class="w-full px-3 py-2 bg-black" required>
                <option value="Aktif">Aktif</option>
                <option value="Tidak Aktif">Tidak Aktif</option>
            </select>
        </div>
        <div class="mb-4">
            <label for="image_url" class="block text-white">URL Gambar:</label>
            <input type="url" name="image_url" class="w-full px-3 py-2 bg-black">
        </div>
        <button type="submit" class="bg-red-900 text-white px-4 py-2">Simpan</button>
    </form>
</div>
@endsection

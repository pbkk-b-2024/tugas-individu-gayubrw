@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 sm:px-8 bg-black text-white">
    <div class="py-8">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-semibold text-white">Semua Produk</h2>
            @can('create', App\Models\Product::class)
            <a href="{{ route('products.create') }}" class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                Tambah Produk
            </a>
            @endcan
        </div>

        <!-- Form Pencarian -->
        <form action="{{ route('products.index') }}" method="GET" class="mb-4">
            <div class="flex items-center">
                <input type="text" name="search" id="search" value="{{ $search ?? '' }}" placeholder="Cari Produk" 
                    class="w-full px-3 py-2 bg-white text-white border border-gray-700 rounded-l placeholder-gray-500 focus:text-black focus:bg-white focus:outline-none transition duration-150 ease-in-out">
                <button type="submit" id="searchButton" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-r">
                    Cari
                </button>
            </div>
        </form>

        <!-- Grid Produk -->
        <div id="products-container" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach($products as $product)
            <div class="relative group">
                <a href="{{ route('products.show', $product) }}" class="block">
                    <div class="aspect-w-1 aspect-h-1 w-full overflow-hidden rounded-lg bg-red-600">
                        <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="h-full w-full object-cover object-center">
                    </div>
                    <div class="mt-2">
                        <h3 class="text-sm font-medium text-white">{{ $product->name }}</h3>
                        <p class="text-lg font-bold text-white">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                        @if($product->status === 'Aktif')
                            @if($product->stock > 0)
                                <p class="text-sm text-green-500">Stok: {{ $product->stock }}</p>
                            @else
                                <p class="text-sm text-red-500">Stok Habis</p>
                            @endif
                        @else
                            <p class="text-sm text-red-500">Stok Habis</p>
                        @endif
                    </div>
                </a>
                @can('update', $product)
                <div class="absolute top-2 right-2 space-x-2">
                    <a href="{{ route('products.edit', $product->id) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-1 px-3 rounded text-xs">
                        Edit
                    </a>
                    @can('delete', $product)
                    <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-500 hover:bg-red-600 text-white font-bold py-1 px-3 rounded text-xs" onclick="return confirm('Apakah Anda yakin ingin menghapus produk ini?')">
                            Hapus
                        </button>
                    </form>
                    @endcan
                </div>
                @endcan
            </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-6" id="pagination-container">
            {{ $products->links() }}
        </div>
    </div>
</div>

<style>
    body {
        background-color: black;
    }
    .aspect-w-1 {
        position: relative;
        padding-bottom: 100%;
    }
    .aspect-w-1 > img {
        position: absolute;
        height: 100%;
        width: 100%;
        top: 0;
        left: 0;
        object-fit: cover;
    }

    #search:focus {
        background-color: white;
        color: black;
    }

    #search::placeholder {
        color: #a0aec0; /* warna placeholder saat tidak focus */
    }

    #search:focus::placeholder {
        color: #718096; /* warna placeholder saat focus */
    }
</style>
@endsection

@section('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        function performSearch() {
            var query = $('#search').val();
            $.ajax({
                url: '{{ route('products.index') }}',
                method: 'GET',
                data: { search: query },
                success: function(data) {
                    $('#products-container').html(data.products);
                    $('#pagination-container').html(data.pagination);
                }
            });
        }

        var debounceTimer;
        $('#search').on('keyup', function() {
            clearTimeout(debounceTimer);
            debounceTimer = setTimeout(performSearch, 300);
        });

        $('#searchButton').on('click', function() {
            performSearch();
        });
    });
</script>
@endsection
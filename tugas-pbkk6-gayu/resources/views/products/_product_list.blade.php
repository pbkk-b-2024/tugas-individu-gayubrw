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
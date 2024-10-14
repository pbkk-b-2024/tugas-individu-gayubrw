@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="order-2 md:order-1">
            <h1 class="text-4xl font-bold mb-4">{{ $product->name }}</h1>
            <p class="text-lg font-bold text-white my-4">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
            
            <div class="mb-6">
                <label class="font-bold text-white mb-2 block">SIZE</label>
                <div class="grid grid-cols-6 gap-2">
                    @foreach(['XS', 'S', 'M', 'L', 'XL', '2XL'] as $size)
                    <button class="bg-black text-white py-2 px-4 border border-white hover:bg-white hover:text-black transition-colors duration-300 size-button" data-size="{{ $size }}">{{ $size }}</button>
                    @endforeach
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4 mb-4">
                <button id="addToCartBtn" class="bg-white text-black py-3 px-6 hover:bg-gray-200 transition-colors duration-300">ADD TO CART</button>
                <button class="bg-white text-black py-3 px-6 hover:bg-gray-200 transition-colors duration-300">
                    Buy with <span class="font-bold">ShopPay</span>
                </button>
            </div>

            <button class="w-full bg-black text-white py-3 px-6 mb-4 hover:bg-gray-800 transition-colors duration-300">
                MORE PAYMENT OPTIONS
            </button>

            <div class="grid grid-cols-2 gap-4">
                <button onclick="toggleSizeGuide()" class="bg-black text-white py-3 px-6 border border-white hover:bg-white hover:text-black transition-colors duration-300">
                    <span class="mr-2">&#128207;</span> SIZE GUIDE
                </button>
                <button id="addToWishlistBtn" class="bg-black text-white py-3 px-6 border border-white hover:bg-white hover:text-black transition-colors duration-300">
                    <span class="mr-2">&#9825;</span> ADD TO WISHLIST
                </button>
            </div>
            
            <!-- Detail Produk -->
            <div class="mt-8">
                <h2 class="text-2xl font-bold mb-4 text-white">Detail Produk</h2>
                <pre class="text-white font-mono whitespace-pre-wrap">{{ $product->detail }}</pre>
            </div>
        </div>
        <div class="order-1 md:order-2 overflow-auto" style="max-height: 90vh;">
            <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-full">
        </div>
    </div>
</div>

<!-- Size Guide Modal -->
<div id="sizeGuideModal" class="hidden fixed inset-0 bg-black bg-opacity-50 overflow-auto z-50">
    <div class="flex justify-center items-center min-h-screen">
        <div class="bg-white p-4 rounded-lg text-center">
            <h2 class="font-bold mb-2">Size Guide</h2>
            @if($product->size_guide_url)
                <img src="{{ $product->size_guide_url }}" alt="Size Guide Image" class="max-w-full h-auto">
            @else
                <p>No size guide available for this product.</p>
            @endif
            <button onclick="toggleSizeGuide()" class="mt-4 py-2 px-4 bg-gray-800 text-white rounded">Close</button>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
function toggleSizeGuide() {
    var modal = document.getElementById('sizeGuideModal');
    modal.style.display = modal.style.display === 'none' ? 'block' : 'none';
}

$(document).ready(function() {
    let selectedSize = null;

    $('.size-button').click(function() {
        $('.size-button').removeClass('bg-white text-black').addClass('bg-black text-white');
        $(this).removeClass('bg-black text-white').addClass('bg-white text-black');
        selectedSize = $(this).data('size');
    });

    $('#addToCartBtn').click(function() {
        if (!selectedSize) {
            alert('Please select a size before adding to cart.');
            return;
        }

        $.ajax({
            url: '{{ route('cart.add', $product->id) }}',
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                product_id: {{ $product->id }},
                size: selectedSize,
                quantity: 1
            },
            success: function(response) {
                if (response.success) {
                    alert('Product added to cart successfully!');
                } else {
                    alert('Failed to add product to cart. Please try again.');
                }
            },
            error: function() {
                alert('An error occurred. Please try again.');
            }
        });
    });

    $('#addToWishlistBtn').click(function() {
        $.ajax({
            url: '{{ route('wishlist.add', $product->id) }}',
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                product_id: {{ $product->id }}
            },
            success: function(response) {
                if (response.success) {
                    alert('Product added to wishlist successfully!');
                    $(this).text('ADDED TO WISHLIST').addClass('bg-gray-500').removeClass('bg-black');
                } else {
                    alert('Failed to add product to wishlist. Please try again.');
                }
            },
            error: function() {
                alert('An error occurred. Please try again.');
            }
        });
    });
});
</script>
@endsection
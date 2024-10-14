@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="order-2 md:order-1">
            <h1 class="text-4xl font-bold mb-4">{{ $product->name }}</h1>
            <p class="text-lg font-bold text-white my-4">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
            <div>
                <label class="font-bold">SIZE</label>
                <div class="flex space-x-2 mt-2">
                    @foreach(['XS', 'S', 'M', 'L', 'XL', '2XL'] as $size)
                    <button class="bg-black text-white py-2 px-4 rounded-full size-button" data-size="{{ $size }}">{{ $size }}</button>
                    @endforeach
                </div>
            </div>
            <button id="addToCartBtn" class="bg-black text-white py-3 px-8 rounded mt-4 mr-2">ADD TO CART</button>
            <button class="bg-black text-whitex py-3 px-8 rounded mt-4">Buy with ShopPay</button>
            <button class="bg-black text-white py-3 px-8 rounded mt-4 mr-2" onclick="toggleSizeGuide()">SIZE GUIDE</button>
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
            <img src="/path/to/size-guide-image.jpg" alt="Size Guide Image" class="max-w-full h-auto">
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
        $('.size-button').removeClass('bg-gray-500').addClass('bg-black');
        $(this).removeClass('bg-black').addClass('bg-gray-500');
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
                    // Optionally update cart icon or count here
                } else {
                    alert('Failed to add product to cart. Please try again.');
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
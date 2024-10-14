@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">
    @if (session('success'))
        <div class="bg-green-500 text-white p-4 rounded-lg mb-6">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="bg-red-500 text-white p-4 rounded-lg mb-6">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="order-1 md:order-2 overflow-auto" style="max-height: 90vh;">
            <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-full rounded-lg shadow-lg">
        </div>
        <div class="order-2 md:order-1">
            <h1 class="text-4xl font-bold mb-4 text-white">{{ $product->name }}</h1>

            <p class="text-lg text-gray-300 mb-2">Category: <span class="font-bold">{{ $product->category->name }}</span></p>

            <p class="text-2xl font-bold text-white my-4">Rp{{ number_format($product->price, 0, ',', '.') }}</p>
            
            @if(!auth()->user()->isAdmin())
            <form id="addToCartForm" action="{{ route('cart.add', $product->id) }}" method="POST">
                @csrf
                <div class="mb-6">
                    <label class="font-bold text-white mb-2 block">SIZE</label>
                    <div class="grid grid-cols-6 gap-2" id="sizeButtons">
                        @foreach(['XS', 'S', 'M', 'L', 'XL', '2XL'] as $size)
                        <button type="button" class="size-button bg-black text-white py-2 px-4 border border-white hover:bg-white hover:text-black transition-colors duration-300" data-size="{{ $size }}">{{ $size }}</button>
                        @endforeach
                    </div>
                    <input type="hidden" name="size" id="selectedSize" required>
                </div>
            
                <div class="mb-6">
                    <label class="font-bold text-white mb-2 block">QUANTITY</label>
                    <input type="number" name="quantity" value="1" min="1" max="10" class="w-20 bg-gray-700 text-white rounded px-3 py-2">
                </div>
            
                <div class="grid grid-cols-2 gap-4 mb-4">
                    <button type="submit" class="bg-white text-black py-3 px-6 rounded-lg hover:bg-gray-200 transition-colors duration-300 flex items-center justify-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                        ADD TO CART
                    </button>
                    <button type="button" id="buyNowBtn" class="w-full bg-white text-black py-3 px-6 rounded-lg hover:bg-gray-200 transition-colors duration-300">
                        Buy with <span class="font-bold">BNI Mobile Banking</span>
                    </button>
                </div>
            </form>
            @endif

            <div class="grid grid-cols-2 gap-4">
                <button onclick="toggleSizeGuide()" class="bg-black text-white py-3 px-6 border border-white rounded-lg hover:bg-white hover:text-black transition-colors duration-300">
                    <span class="mr-2">&#128207;</span> SIZE GUIDE
                </button>
                @if(!auth()->user()->isAdmin())
                <button id="addToWishlistBtn" data-product-id="{{ $product->id }}" class="bg-black text-white py-3 px-6 border border-white rounded-lg hover:bg-white hover:text-black transition-colors duration-300">
                    <span class="mr-2">&#9825;</span> ADD TO WISHLIST
                </button>
                @endif
            </div>
            
            <!-- Detail Produk -->
            <div class="mt-8">
                <h2 class="text-2xl font-bold mb-4 text-white">Details</h2>
                <pre class="text-white font-mono whitespace-pre-wrap bg-gray-800 p-4 rounded-lg">{{ $product->detail }}</pre>
            </div>
        </div>
    </div>
    
    <!-- Review Section -->
    <div class="mt-12">
        <h2 class="text-2xl font-bold mb-6 text-white">Customer Reviews</h2>
        
        <!-- Display existing comments -->
        @foreach($product->reviews as $review)
        <div class="bg-gray-800 rounded-lg p-4 mb-4">
            <div class="flex items-center mb-2">
                <div class="flex text-yellow-400">
                    @for ($i = 1; $i <= 5; $i++)
                        <svg class="w-4 h-4 fill-current {{ $i <= $review->rating ? 'text-yellow-400' : 'text-gray-400' }}" viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>
                    @endfor
                </div>
                <span class="ml-2 text-sm text-gray-400">{{ $review->created_at->diffForHumans() }}</span>
            </div>
            <p class="font-bold mb-1 text-white">{{ $review->user->name }}</p>
            <p class="text-gray-300">{{ $review->comment }}</p>
        </div>
        @endforeach

        <!-- Add new comment form with star rating -->
        @if(!auth()->user()->isAdmin())
        <form action="{{ route('reviews.store', $product->id) }}" method="POST" class="mt-6 bg-gray-800 p-6 rounded-lg">
            @csrf
            <div class="mb-4">
                <label class="block text-white mb-2">Your Rating</label>
                <div class="flex items-center">
                    <input type="hidden" name="rating" id="selected-rating" value="0">
                    @for ($i = 1; $i <= 5; $i++)
                        <svg class="w-8 h-8 fill-current text-gray-400 cursor-pointer hover:text-yellow-400 transition-colors duration-150 star-rating"
                             data-rating="{{ $i }}"
                             viewBox="0 0 24 24">
                            <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/>
                        </svg>
                    @endfor
                </div>
            </div>
            <div class="mb-4">
                <label for="comment" class="block text-white mb-2">Your Review</label>
                <textarea name="comment" id="comment" rows="4" class="w-full bg-gray-700 text-white rounded px-3 py-2" required></textarea>
            </div>
            <button type="submit" class="bg-white text-black py-2 px-4 rounded hover:bg-gray-200 transition-colors duration-300">Submit Review</button>
        </form>
        @endif
    </div>
</div>

<!-- Size Guide Modal -->
<div id="sizeGuideModal" class="hidden fixed inset-0 bg-black bg-opacity-50 overflow-auto z-50">
    <div class="flex justify-center items-center min-h-screen p-4">
        <div class="bg-white p-4 rounded-lg text-black w-full max-w-4xl">
            <h3 class="text-lg font-bold mb-4">Size Guide</h3>
            @if($product->size_guide_url)
                <img src="{{ $product->size_guide_url }}" alt="Size Guide" class="w-full h-auto">
            @else
                <p>No size guide available for this product.</p>
            @endif
            <button onclick="toggleSizeGuide()" class="mt-4 px-4 py-2 bg-black text-white rounded">Close</button>
        </div>
    </div>
</div>

<script>
    function toggleSizeGuide() {
        const modal = document.getElementById('sizeGuideModal');
        modal.classList.toggle('hidden');
    }

    @if(!auth()->user()->isAdmin())
    document.addEventListener('DOMContentLoaded', function() {
        // Size selection functionality
        const sizeButtons = document.querySelectorAll('.size-button');
        const selectedSizeInput = document.getElementById('selectedSize');

        sizeButtons.forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                sizeButtons.forEach(btn => btn.classList.remove('bg-white', 'text-black'));
                this.classList.add('bg-white', 'text-black');
                selectedSizeInput.value = this.getAttribute('data-size');
                console.log('Selected size:', selectedSizeInput.value);
            });
        });

        // Form submission validation
        const addToCartForm = document.getElementById('addToCartForm');
        addToCartForm.addEventListener('submit', function(e) {
            if (!selectedSizeInput.value) {
                e.preventDefault();
                alert('Please select a size before adding to cart.');
            }
        });

        // Buy Now button functionality
        const buyNowBtn = document.getElementById('buyNowBtn');
        buyNowBtn.addEventListener('click', function(e) {
            e.preventDefault();
            if (!selectedSizeInput.value) {
                alert('Please select a size before proceeding to checkout.');
                return;
            }
            const form = document.createElement('form');
            form.method = 'GET';
            form.action = '{{ route('checkout') }}';
            const fields = {
                product_id: '{{ $product->id }}',
                quantity: document.querySelector('input[name="quantity"]').value,
                size: selectedSizeInput.value
            };
            for (const key in fields) {
                const input = document.createElement('input');
                input.type = 'hidden';
                input.name = key;
                input.value = fields[key];
                form.appendChild(input);
            }
            document.body.appendChild(form);
            form.submit();
        });

        // Add to Wishlist functionality
        const addToWishlistBtn = document.getElementById('addToWishlistBtn');
        addToWishlistBtn.addEventListener('click', function(e) {
            e.preventDefault();
            const productId = this.getAttribute('data-product-id');
            fetch('/wishlist/add/' + productId, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    alert('Product added to wishlist successfully!');
                } else {
                    throw new Error(data.message || 'Failed to add product to wishlist.');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert(error.message || 'An error occurred. Please try again.');
            });
        });

        // Star rating functionality
        const stars = document.querySelectorAll('.star-rating');
        const selectedRatingInput = document.getElementById('selected-rating');

        stars.forEach(star => {
            star.addEventListener('click', function() {
                const rating = this.getAttribute('data-rating');
                selectedRatingInput.value = rating;

                stars.forEach((s, index) => {
                    if (index < rating) {
                        s.classList.add('text-yellow-400');
                        s.classList.remove('text-gray-400');
                    } else {
                        s.classList.remove('text-yellow-400');
                        s.classList.add('text-gray-400');
                    }
                });
            });
        });
    });
    @endif
</script>

@endsection
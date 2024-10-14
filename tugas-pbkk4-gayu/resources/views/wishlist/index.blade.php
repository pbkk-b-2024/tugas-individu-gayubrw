@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4">
    <h1 class="text-2xl font-bold mb-4 text-white">My Wishlist</h1>

    @if($wishlistItems->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($wishlistItems as $item)
                <div class="bg-gray-800 rounded-lg shadow-lg overflow-hidden wishlist-item" data-id="{{ $item->id }}">
                    <img src="{{ $item->product->image_url }}" alt="{{ $item->product->name }}" class="w-full h-48 object-cover">
                    <div class="p-4">
                        <h2 class="text-xl font-semibold text-white mb-2">{{ $item->product->name }}</h2>
                        <p class="text-gray-300 mb-4">Rp {{ number_format($item->product->price, 0, ',', '.') }}</p>
                        <div class="flex justify-between items-center">
                            <a href="{{ route('products.show', $item->product) }}" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">View Product</a>
                            <button class="remove-from-wishlist text-red-500 hover:text-red-700">Remove</button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <p class="text-white">Your wishlist is empty.</p>
    @endif
</div>
@endsection

@section('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    $('.remove-from-wishlist').click(function() {
    var wishlistItem = $(this).closest('.wishlist-item');
    var wishlistId = wishlistItem.data('id');
    console.log('Attempting to remove wishlist item:', wishlistId);

    $.ajax({
        url: '/wishlist/' + wishlistId,
        method: 'DELETE',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(response) {
            console.log('Server response:', response);
            if (response.success) {
                wishlistItem.fadeOut(300, function() {
                    $(this).remove();
                    if ($('.wishlist-item').length === 0) {
                        $('.container').html('<p class="text-white">Your wishlist is empty.</p>');
                    }
                });
            } else {
                console.error('Failed to remove item:', response.message);
                alert(response.message || 'Failed to remove item from wishlist. Please try again.');
            }
        },
        error: function(xhr, status, error) {
            console.error('Ajax error:', status, error);
            console.log('Response:', xhr.responseText);
            alert('An error occurred. Please try again.');
        }
    });
});
</script>
@endsection
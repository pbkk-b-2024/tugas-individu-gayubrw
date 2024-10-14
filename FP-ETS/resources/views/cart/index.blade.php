@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 sm:px-8">
    <h1 class="text-2xl font-bold mb-4">Your Cart</h1>

    @if($cart->items->count() > 0)
        <div class="bg-white shadow-md rounded my-6">
            <table class="min-w-max w-full table-auto">
                <thead>
                    <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                        <th class="py-3 px-6 text-left">Product</th>
                        <th class="py-3 px-6 text-left">Size</th>
                        <th class="py-3 px-6 text-center">Quantity</th>
                        <th class="py-3 px-6 text-center">Price</th>
                        <th class="py-3 px-6 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 text-sm font-light">
                    @foreach($cart->items as $item)
                    <tr class="border-b border-gray-200 hover:bg-gray-100">
                        <td class="py-3 px-6 text-left whitespace-nowrap">
                            {{ $item->product->name }}
                        </td>
                        <td class="py-3 px-6 text-left">
                            {{ $item->size }}
                        </td>
                        <td class="py-3 px-6 text-center">
                            <form action="{{ route('cart.update', $item) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <input type="number" name="quantity" value="{{ $item->quantity }}" min="1" class="w-16 text-center">
                                <button type="submit" class="bg-blue-500 text-white px-2 py-1 rounded">Update</button>
                            </form>
                        </td>
                        <td class="py-3 px-6 text-center">
                            Rp{{ number_format($item->product->price * $item->quantity, 0, ',', '.') }}
                        </td>
                        <td class="py-3 px-6 text-center">
                            <form action="{{ route('cart.remove', $item) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 text-white px-2 py-1 rounded">Remove</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="text-right">
            <p class="text-xl font-bold">Total: Rp{{ number_format($cart->items->sum(function($item) { return $item->product->price * $item->quantity; }), 0, ',', '.') }}</p>
            <a href="{{ route('checkout') }}" class="bg-green-500 text-white px-4 py-2 rounded mt-4 inline-block">Proceed to Checkout</a>
        </div>
    @else
        <p>Your cart is empty.</p>
    @endif
</div>
@endsection
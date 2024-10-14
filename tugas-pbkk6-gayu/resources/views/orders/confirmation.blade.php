@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8 text-white">
    <h1 class="text-3xl font-bold mb-6">Order Confirmation</h1>
    <div class="bg-gray-800 rounded-lg p-6 mb-8">
        <p class="text-lg mb-4">Thank you for your order! Your order number is: <span class="font-bold">#{{ $order->id }}</span></p>
        <p class="text-sm text-gray-400">A confirmation email has been sent to your email address.</p>
    </div>
    
    <div class="bg-gray-800 rounded-lg p-6 mb-8">
        <h2 class="text-2xl font-bold mb-4">Order Details</h2>
        <div class="space-y-4">
            @foreach($order->items as $item)
                <div class="flex justify-between items-center border-b border-gray-700 pb-4">
                    <div>
                        <h3 class="font-bold">{{ $item->product->name }}</h3>
                        <p class="text-sm text-gray-400">Size: {{ $item->size }} | Quantity: {{ $item->quantity }}</p>
                    </div>
                    <p class="font-bold">Rp{{ number_format($item->price * $item->quantity, 0, ',', '.') }}</p>
                </div>
            @endforeach
        </div>
        <div class="mt-6 flex justify-between items-center">
            <p class="text-xl font-bold">Total</p>
            <p class="text-xl font-bold">Rp{{ number_format($order->total, 0, ',', '.') }}</p>
        </div>
    </div>

    <div class="bg-gray-800 rounded-lg p-6">
        <h2 class="text-2xl font-bold mb-4">Shipping Information</h2>
        <p class="mb-2"><strong>Address:</strong> {{ $order->shipping_address }}</p>
        <p class="mb-2"><strong>Shipping Method:</strong> Standard Shipping</p>
        <p class="text-sm text-gray-400 mt-4">Please allow 3-5 business days for your order to be processed and shipped.</p>
    </div>
</div>

    <div class="mt-8 text-center">
        <a href="{{ route('dashboard') }}" class="bg-white text-black px-6 py-2 rounded-full inline-block hover:bg-gray-200 transition">Back to Dashboard</a>
    </div>
@endsection

@push('styles')
<style>
    body {
        background-color: #111;
        color: #fff;
    }
</style>
@endpush
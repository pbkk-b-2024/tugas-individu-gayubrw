@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-6 text-white">Order #{{ $order->id }}</h1>
    
    <!-- Order Summary -->
    <div class="bg-gray-800 rounded-lg shadow-md p-6 mb-6">
        <h2 class="text-xl font-bold text-white mb-4">Order Summary</h2>
        <div class="grid grid-cols-2 gap-4">
            <div class="text-gray-300">
                <p><strong>Date:</strong> {{ $order->created_at->format('F j, Y') }}</p>
                <p><strong>Status:</strong> 
                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                        @if($order->status == 'completed') bg-green-100 text-green-800 
                        @elseif($order->status == 'processing') bg-yellow-100 text-yellow-800
                        @else bg-red-100 text-red-800 @endif">
                        {{ ucfirst($order->status) }}
                    </span>
                </p>
            </div>
            <div class="text-gray-300">
                <p><strong>Total:</strong> Rp{{ number_format($order->total, 0, ',', '.') }}</p>
                <p><strong>Payment Method:</strong> {{ $order->payment_method }}</p>
            </div>
        </div>
    </div>

    <!-- Order Items -->
    <div class="bg-gray-800 rounded-lg shadow-md p-6">
        <h2 class="text-xl font-bold text-white mb-4">Order Items</h2>
        <table class="min-w-full divide-y divide-gray-700">
            <thead class="bg-gray-700">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Product</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Quantity</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Price</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Total</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-700">
                @foreach($order->Items as $item)
                <tr class="hover:bg-gray-700">
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            <div class="ml-4">
                                <div class="text-sm font-medium text-white">
                                    {{ $item->product->name }}
                                </div>
                                <div class="text-sm text-gray-300">
                                    {{ $item->product->description }}
                                </div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">
                        {{ $item->quantity }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">
                        Rp{{ number_format($item->price, 0, ',', '.') }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">
                        Rp{{ number_format($item->quantity * $item->price, 0, ',', '.') }}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Shipping Information -->
    <div class="bg-gray-800 rounded-lg shadow-md p-6 mt-6">
        <h2 class="text-xl font-bold text-white mb-4">Shipping Information</h2>
        <p class="text-gray-300"><strong>Recipient:</strong> {{ $order->shipping_name }}</p>
        <p class="text-gray-300"><strong>Address:</strong> {{ $order->shipping_address }}</p>
        <p class="text-gray-300"><strong>City:</strong> {{ $order->shipping_city }}</p>
        <p class="text-gray-300"><strong>Postal Code:</strong> {{ $order->shipping_postal_code }}</p>
        <p class="text-gray-300"><strong>Phone:</strong> {{ $order->shipping_phone }}</p>
    </div>

    <!-- Actions -->
    <div class="mt-6">
        <a href="{{ route('orders.index') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-md">
            Back to Orders
        </a>
    </div>
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

@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-6 text-white">Orders</h1>
    @if($orders->count() > 0)
        <div class="bg-gray-800 rounded-lg overflow-hidden">
            <table class="w-full">
                <thead class="bg-gray-700">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Order</th>
                        @if(Auth::user()->isAdmin()) <!-- Tampilkan kolom User hanya jika admin -->
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">User</th>
                        @endif
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Date</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Total</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-700">
                    @foreach($orders as $order)
                    <tr class="hover:bg-gray-700">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <a href="{{ route('orders.show', $order->id) }}" class="text-blue-400 hover:underline">#{{ $order->id }}</a>
                        </td>
                        
                        @if(Auth::user()->isAdmin()) <!-- Admin melihat User terkait -->
                            <td class="px-6 py-4 whitespace-nowrap text-gray-300">
                                {{ $order->user->name }}
                            </td>
                        @endif

                        <td class="px-6 py-4 whitespace-nowrap text-gray-300">
                            {{ $order->created_at->format('F j, Y') }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                @if($order->status == 'completed') bg-green-100 text-green-800 
                                @elseif($order->status == 'processing') bg-yellow-100 text-yellow-800
                                @else bg-red-100 text-red-800 @endif">
                                {{ ucfirst($order->status) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-300">
                            Rp{{ number_format($order->total, 0, ',', '.') }}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <p class="text-gray-300">You don't have any orders yet.</p>
    @endif
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

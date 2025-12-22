@extends('layouts.app')

@section('title', 'Order Details')

@section('content')
<div class="max-w-5xl mx-auto sm:px-6 lg:px-8">

    {{-- Page Header --}}
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900">
            Order #{{ $order->id }}
        </h1>
        <p class="text-sm text-gray-600">
            View order details and items.
        </p>
    </div>

    {{-- Order Summary --}}
    <div class="rounded-2xl bg-white p-6 shadow border mb-6">
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">

            {{-- Date --}}
            <div>
                <p class="text-sm text-gray-500">Order Date</p>
                <p class="font-semibold text-gray-900">
                    {{ $order->created_at->format('d M Y') }}
                </p>
            </div>

            {{-- Status --}}
            <div>
                <p class="text-sm text-gray-500">Status</p>

                @php
                    $statusClasses = [
                        'pending'    => 'bg-yellow-100 text-yellow-800',
                        'processing' => 'bg-blue-100 text-blue-800',
                        'completed'  => 'bg-green-100 text-green-800',
                        'cancelled'  => 'bg-gray-200 text-gray-700',
                    ];
                @endphp

                <span class="inline-flex px-3 py-1 rounded-full text-xs font-semibold
                    {{ $statusClasses[$order->status] ?? 'bg-gray-100 text-gray-700' }}">
                    {{ ucfirst($order->status) }}
                </span>
            </div>

            {{-- Total --}}
            <div>
                <p class="text-sm text-gray-500">Total</p>
                <p class="text-lg font-bold text-gray-900">
                    ${{ number_format($order->total, 2) }}
                </p>
            </div>

        </div>
    </div>

    {{-- Order Items --}}
    <div class="rounded-2xl bg-white shadow border overflow-hidden mb-6">
        <div class="p-4 border-b">
            <h2 class="font-semibold text-gray-900">
                Order Items
            </h2>
        </div>

        @if($order->orderItems->isEmpty())
            <div class="p-6 text-center text-gray-500">
                No items found for this order.
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="min-w-full text-sm">
                    <thead class="bg-gray-50 border-b">
                        <tr class="text-left text-gray-600">
                            <th class="px-6 py-3 font-semibold">Item</th>
                             <th class="px-6 py-3 font-semibold">Image</th>
                            <th class="px-6 py-3 font-semibold">Price</th>
                            <th class="px-6 py-3 font-semibold">Quantity</th>
                            <th class="px-6 py-3 font-semibold text-right">Subtotal</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y">
                        @foreach($order->orderItems as $orderItem)
                            <tr>
                                <td class="px-6 py-4 font-semibold text-gray-900">
                                    {{ $orderItem->item->name ?? 'Item removed' }}
                                </td>
                                <td class="px-6 py-4">
                                    @if($orderItem->item && $orderItem->item->image)
                                        <img src="{{ asset('images/items/' . $orderItem->item->image) }}"
                                             class="h-12 w-16 rounded-lg object-cover border">
                                    @else
                                        <span class="text-gray-400 text-xs">No image</span>
                                    @endif
                                </td>

                                <td class="px-6 py-4">
                                    ${{ number_format($orderItem->price, 2) }}
                                </td>

                                <td class="px-6 py-4">
                                    {{ $orderItem->quantity }}
                                </td>

                                <td class="px-6 py-4 text-right font-semibold">
                                    ${{ number_format($orderItem->price * $orderItem->quantity, 2) }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>

    {{-- Actions --}}
    <div class="flex flex-wrap gap-3">

        {{-- Back --}}
        <a href="{{ route('orders.my-order') }}"
           class="rounded-xl border border-gray-200 bg-white px-4 py-2 text-sm font-semibold text-gray-700 hover:bg-gray-50 transition">
            ← Back to My Orders
        </a>

        {{-- Reorder (optional UX improvement) --}}
        @if(in_array($order->status, ['completed', 'cancelled']))
            <form method="POST" action="{{ route('orders.reorder', $order) }}">
                @csrf
                <button
                    class="rounded-xl bg-primary px-4 py-2 text-sm font-semibold text-white hover:bg-primary-600 transition">
                    Reorder Items
                </button>
            </form>
        @endif

    </div>

</div>
@endsection

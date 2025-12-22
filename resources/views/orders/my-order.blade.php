@extends('layouts.app')

@section('title', 'My Orders')

@section('content')
<div class="max-w-6xl mx-auto sm:px-6 lg:px-8">

    <h1 class="text-2xl font-bold text-gray-900 mb-6">
        My Orders
    </h1>

    {{-- Messages --}}
    @if(session('success'))
        <div class="mb-4 rounded-xl bg-green-50 border border-green-200 px-4 py-3 text-green-800">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="mb-4 rounded-xl bg-red-50 border border-red-200 px-4 py-3 text-red-800">
            {{ session('error') }}
        </div>
    @endif

    @if($orders->isEmpty())
        <div class="rounded-2xl bg-white p-8 text-center shadow">
            You have no orders yet.
        </div>
    @else
        <div class="space-y-6">
            @foreach($orders as $order)
                <div class="rounded-2xl bg-white p-6 shadow border">

                    {{-- Header --}}
                    <div class="flex justify-between items-center mb-3">
                        <div>
                            <h2 class="font-bold text-gray-900">
                                Order #{{ $order->id }}
                            </h2>
                            <p class="text-sm text-gray-500">
                                {{ $order->created_at->format('d M Y') }}
                            </p>
                        </div>

                        {{-- Status Badge --}}
                        @if($order->status === 'completed')
                            <span class="px-3 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                Completed
                            </span>
                        @elseif($order->status === 'processing')
                            <span class="px-3 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">
                                Processing
                            </span>
                        @elseif($order->status === 'pending')
                            <span class="px-3 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                Pending
                            </span>
                        @elseif($order->status === 'cancelled')
                            <span class="px-3 py-1 text-xs font-semibold rounded-full bg-gray-200 text-gray-700">
                                Cancelled
                            </span>
                        @endif
                    </div>

                    {{-- Total --}}
                    <div class="flex justify-between items-center mb-4">
                        <span class="text-sm font-semibold text-gray-700">Total</span>
                        <span class="text-lg font-bold">${{ number_format($order->total, 2) }}</span>
                    </div>

                    {{-- Actions --}}
                    <div class="flex gap-3">
                        <a href="{{ route('orders.show', $order) }}"
                           class="rounded-xl border border-gray-200 px-4 py-2 text-sm font-semibold text-gray-700 hover:bg-gray-50 transition">
                            View Details
                        </a>

                        @if(in_array($order->status, ['pending', 'processing']))
                            <form method="POST"
                                  action="{{ route('orders.cancel', $order) }}"
                                  onsubmit="return confirm('Are you sure you want to cancel this order?');">
                                @csrf
                                @method('PATCH')

                                <button
                                    class="rounded-xl bg-red-50 px-4 py-2 text-sm font-semibold text-red-700 hover:bg-red-100 transition">
                                    Cancel Order
                                </button>
                            </form>
                        @endif
                    </div>

                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection

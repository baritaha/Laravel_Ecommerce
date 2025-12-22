@extends('layouts.app')
@section('title', 'Dashboard')

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

    {{-- Welcome --}}
    <div class="lg:col-span-2 card p-6">
        <h1 class="text-2xl font-bold">
            Welcome back,
            <span class="text-primary">{{ auth()->user()->name }}</span>
        </h1>

        <p class="mt-2 text-gray-600">
            Track your orders and spending.
        </p>

        <div class="mt-4 flex gap-3">
            <a href="{{ route('shop.index') }}" class="btn-primary">Shop</a>
            <a href="{{ route('orders.my-order') }}" class="btn-outline">My Orders</a>
        </div>
    </div>

    {{-- Account --}}
    <div class="card p-6">
        <p class="text-sm text-gray-500">Email</p>
        <p class="font-semibold">{{ auth()->user()->email }}</p>
    </div>

    {{-- Stats --}}
    <div class="lg:col-span-3 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">

        <div class="card p-5">
            <p class="text-sm text-gray-500">Total Orders</p>
            <h3 class="text-2xl font-bold">{{ $totalOrders }}</h3>
        </div>

        <div class="card p-5">
            <p class="text-sm text-gray-500">Pending</p>
            <h3 class="text-2xl font-bold text-yellow-600">{{ $pendingOrders }}</h3>
        </div>

        <div class="card p-5 {{ $completedOrders == 0 ? 'opacity-70' : '' }}">
            <p class="text-sm text-gray-500">Completed</p>
            <h3 class="text-2xl font-bold text-green-600">{{ $completedOrders }}</h3>
        </div>

        <div class="card p-5 {{ $totalSpent == 0 ? 'opacity-70' : '' }}">
            <p class="text-sm text-gray-500">Total Spent</p>
            <h3 class="text-2xl font-bold text-primary">
                ${{ number_format($totalSpent, 2) }}
            </h3>
        </div>
    </div>

    {{-- Recent Orders --}}
    <div class="lg:col-span-3 card p-6">
        <h2 class="text-lg font-bold mb-4">Recent Orders</h2>

        @if($recentOrders->count())
            <table class="w-full">
                @foreach($recentOrders as $order)
                    <tr class="border-b">
                        <td>#{{ $order->id }}</td>
                        <td>{{ ucfirst($order->status) }}</td>
                        <td>${{ number_format($order->total, 2) }}</td>
                        <td class="text-right">
                            <a href="{{ route('orders.show', $order) }}" class="text-primary">View</a>
                        </td>
                    </tr>
                @endforeach
            </table>
        @else
            <p class="text-gray-500">No orders yet.</p>
        @endif
    </div>

</div>
@endsection

@extends('layouts.app')
@section('title', 'Admin Dashboard')

@section('content')
<div class="space-y-6">

    <div class="card p-6">
        <h1 class="text-2xl font-bold">Admin Dashboard</h1>
        <p class="text-gray-600">System overview</p>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-6 gap-4">

        <div class="card p-4">
            <p class="text-sm">Users</p>
            <h2 class="text-2xl font-bold">{{ $totalUsers }}</h2>
        </div>

        <div class="card p-4">
            <p class="text-sm">Orders</p>
            <h2 class="text-2xl font-bold">{{ $totalOrders }}</h2>
        </div>

        <div class="card p-4">
            <p class="text-sm">Pending</p>
            <h2 class="text-2xl font-bold text-yellow-600">{{ $pendingOrders }}</h2>
        </div>

        <div class="card p-4">
            <p class="text-sm">Completed</p>
            <h2 class="text-2xl font-bold text-green-600">{{ $completedOrders }}</h2>
        </div>

        <div class="card p-4">
            <p class="text-sm">Revenue</p>
            <h2 class="text-2xl font-bold text-primary">
                ${{ number_format($totalRevenue, 2) }}
            </h2>
        </div>

        <div class="card p-4">
            <p class="text-sm">Items</p>
            <h2 class="text-2xl font-bold">{{ $totalItems }}</h2>
        </div>
    </div>

    <div class="card p-6">
        <h2 class="font-bold mb-4">Recent Orders</h2>

        @if($recentOrders->count())
            <table class="w-full">
                @foreach($recentOrders as $order)
                    <tr class="border-b">
                        <td>#{{ $order->id }}</td>
                        <td>{{ $order->user->name }}</td>
                        <td>{{ ucfirst($order->status) }}</td>
                        <td>${{ number_format($order->total, 2) }}</td>
                        <td class="text-right">
                            <a href="{{ route('orders.show', $order) }}" class="text-primary">View</a>
                        </td>
                    </tr>
                @endforeach
            </table>
        @else
            <p>No orders yet.</p>
        @endif
    </div>

</div>
@endsection

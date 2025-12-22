@extends('layouts.app')

@section('title', 'All Orders')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold mb-6">All Orders</h1>

    @if($orders->isEmpty())
        <div class="p-6 bg-white rounded-xl shadow">
            <p class="text-gray-600">No orders found.</p>
        </div>
    @else
        <div class="overflow-x-auto bg-white rounded-xl shadow">
            <table class="min-w-full border-collapse">
                <thead>
                    <tr class="bg-gray-100 text-left text-sm font-semibold text-gray-700">
                        <th class="p-3">Order #</th>
                        <th class="p-3">Customer</th>
                        <th class="p-3">Total</th>
                        <th class="p-3">Status</th>
                        <th class="p-3">Created</th>
                        <th class="p-3">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $order)
                        <tr class="border-t text-sm">
                            <td class="p-3 font-semibold">
                                #{{ $order->id }}
                            </td>

                            <td class="p-3">
                                {{ $order->user->name }}
                                <div class="text-xs text-gray-500">
                                    {{ $order->user->email }}
                                </div>
                            </td>

                            <td class="p-3">
                                ${{ number_format($order->total, 2) }}
                            </td>

                            <td class="p-3">
                                <span class="px-2 py-1 rounded-full text-xs font-semibold
                                    @if($order->status === 'pending') bg-yellow-100 text-yellow-800
                                    @elseif($order->status === 'processing') bg-blue-100 text-blue-800
                                    @elseif($order->status === 'completed') bg-green-100 text-green-800
                                    @else bg-red-100 text-red-800
                                    @endif">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </td>

                            <td class="p-3">
                                {{ $order->created_at->format('d M Y') }}
                            </td>

                            <td class="p-3">
                                <form method="POST" action="{{ route('orders.update', $order) }}"
                                      class="flex items-center gap-2">
                                    @csrf
                                    @method('PATCH')

                                    <select name="status"
                                            class="border rounded px-2 py-1 text-sm">
                                        @foreach(['pending','processing','completed','cancelled'] as $status)
                                            <option value="{{ $status }}"
                                                @selected($order->status === $status)>
                                                {{ ucfirst($status) }}
                                            </option>
                                        @endforeach
                                    </select>

                                    <button
                                        class="px-3 py-1 rounded bg-primary text-white text-sm hover:bg-primary/90">
                                        Update
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-6">
            {{ $orders->links() }}
        </div>
    @endif
</div>
@endsection

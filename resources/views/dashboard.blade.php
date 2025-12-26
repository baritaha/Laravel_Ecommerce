@extends('layouts.app')
@section('title', 'Dashboard')

@section('content')
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        {{-- LEFT: Welcome + Category Carousel --}}
        <div class="lg:col-span-2 card p-6" x-data="{ active: 0, total: {{ $categories->count() }} }" x-init="setInterval(() => active = (active + 1) % total, 5000)">

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

            {{-- CATEGORY SLIDER --}}
            <div class="mt-6 relative overflow-hidden rounded-lg h-60">
                @foreach ($categories as $i => $category)
                    <div x-show="active === {{ $i }}" x-transition.opacity
                        class="absolute inset-0 bg-cover bg-center"
                        style="background-image:url('{{ asset('images/categories/' . $category->image) }}')">

                        <div class="absolute inset-0 bg-black/60 flex items-center">
                            <div class="p-6 text-white max-w-md">
                                <h2 class="text-2xl font-bold">{{ $category->name }}</h2>
                                <p class="mt-2 text-sm">{{ $category->description }}</p>

                                <a href="{{ route('shop.index', ['category' => $category->id]) }}"
                                    class="inline-block mt-4 bg-primary px-4 py-2 rounded">
                                    View Products
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach

                <button @click="active = active === 0 ? total-1 : active-1"
                    class="absolute left-3 top-1/2 -translate-y-1/2 bg-white/80 w-9 h-9 rounded-full text-xl">‹</button>

                <button @click="active = active === total-1 ? 0 : active+1"
                    class="absolute right-3 top-1/2 -translate-y-1/2 bg-white/80 w-9 h-9 rounded-full text-xl">›</button>
            </div>
        </div>

        {{-- RIGHT: ITEM CAROUSEL (BLUE BOX AREA) --}}
        {{-- RIGHT: FEATURED ITEMS SLIDER (DESIGN IMPROVED) --}}
        <div class="card p-6" x-data="{ active: 0, total: {{ $items->count() }} }" x-init="setInterval(() => active = (active + 1) % total, 4500)">

            <h2 class="text-lg font-semibold mb-4">Featured Items</h2>

            <div class="relative overflow-hidden rounded-xl h-64">

                @foreach ($items as $i => $item)
                    <div x-show="active === {{ $i }}" x-transition.opacity
                        class="absolute inset-0 bg-contain bg-center bg-no-repeat"
                        style="background-image:url('{{ asset('images/items/' . $item->image) }}')">

                        {{-- Gradient overlay --}}
                        <div
                            class="absolute inset-0 bg-gradient-to-b from-black/80 via-black/40 to-black/80 flex flex-col justify-between">

                            {{-- TOP CONTENT --}}
                            <div class="p-4 text-white">

                                {{-- Category badge --}}
                                <span class="inline-block text-xs bg-white/20 px-2 py-0.5 rounded mb-2">
                                    {{ $item->category->name ?? 'Item' }}
                                </span>

                                {{-- Item name --}}
                                <h3 class="text-lg font-bold leading-tight">
                                    {{ $item->name }}
                                </h3>

                                {{-- Description --}}
                                <p class="text-sm text-gray-200 mt-2 line-clamp-3">
                                    {{ $item->description }}
                                </p>
                            </div>

                            {{-- BOTTOM CONTENT --}}
                            <div class="p-4 text-white flex justify-between items-center">
                                <span class="text-lg font-semibold text-primary">
                                    ${{ number_format($item->price, 2) }}
                                </span>

                                <a href="{{ route('items.show', $item) }}"
                                    class="bg-primary hover:bg-primary/90 transition px-4 py-1.5 rounded-full text-sm font-medium">
                                    View
                                </a>
                            </div>

                        </div>

                    </div>
                @endforeach

                {{-- LEFT ARROW --}}
                <button @click="active = active === 0 ? total - 1 : active - 1"
                    class="absolute left-3 top-1/2 -translate-y-1/2 bg-white/80 hover:bg-white text-black w-9 h-9 rounded-full shadow">
                    ‹
                </button>

                {{-- RIGHT ARROW --}}
                <button @click="active = active === total - 1 ? 0 : active + 1"
                    class="absolute right-3 top-1/2 -translate-y-1/2 bg-white/80 hover:bg-white text-black w-9 h-9 rounded-full shadow">
                    ›
                </button>

            </div>
        </div>


        {{-- STATS --}}
        <div class="lg:col-span-3 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            <div class="card p-5">
                <p>Total Orders</p>
                <h3>{{ $totalOrders }}</h3>
            </div>
            <div class="card p-5">
                <p>Pending</p>
                <h3>{{ $pendingOrders }}</h3>
            </div>
            <div class="card p-5">
                <p>Completed</p>
                <h3>{{ $completedOrders }}</h3>
            </div>
            <div class="card p-5">
                <p>Total Spent</p>
                <h3>${{ number_format($totalSpent, 2) }}</h3>
            </div>
        </div>

        {{-- RECENT ORDERS --}}
        <div class="lg:col-span-3 card p-6">
            <h2 class="text-lg font-bold mb-4">Recent Orders</h2>

            @if ($recentOrders->count())
                <table class="w-full">
                    @foreach ($recentOrders as $order)
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
                <p>No orders yet.</p>
            @endif
        </div>

    </div>
@endsection

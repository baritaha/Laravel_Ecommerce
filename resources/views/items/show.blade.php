@extends('layouts.app')

@section('title', 'Item Details')

@section('content')
<div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
    <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Item Details</h1>
            <p class="text-sm text-gray-600">View full information about this item.</p>
        </div>

        <div class="flex gap-2">
            <a href="{{ route('items.edit', $item->id) }}"
               class="inline-flex items-center justify-center rounded-xl border border-primary-200 bg-primary-50 px-4 py-2 text-sm font-semibold text-primary-800 hover:bg-primary-100 transition">
                Edit
            </a>

            <a href="{{ route('items.index') }}"
               class="inline-flex items-center justify-center rounded-xl border border-gray-200 bg-white px-4 py-2 text-sm font-semibold text-gray-700 hover:bg-gray-50 transition">
                Back
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-5 gap-6">
        {{-- Image Card --}}
        <div class="lg:col-span-2">
            <div class="rounded-2xl overflow-hidden bg-white/85 backdrop-blur-xl shadow-xl border border-white">
                <div class="relative">
                    @if ($item->image)
                        <img src="{{ asset('/images/' . $item->image) }}"
                             alt="{{ $item->name }}"
                             class="h-72 w-full object-cover">
                    @else
                        <div class="h-72 w-full bg-gray-100 flex items-center justify-center text-gray-500">
                            No Image Available
                        </div>
                    @endif

                    <div class="absolute top-4 right-4">
                        <span class="rounded-full bg-primary-100 px-4 py-1.5 text-sm font-bold text-primary-800 shadow">
                            ${{ number_format($item->price, 2) }}
                        </span>
                    </div>
                </div>

                <div class="p-5">
                    <h2 class="text-xl font-bold text-gray-900">{{ $item->name }}</h2>
                    <p class="mt-1 text-sm text-gray-600">
                        Category: <span class="font-semibold text-gray-800">{{ $item->category->name }}</span>
                    </p>
                </div>
            </div>
        </div>

        {{-- Details Card --}}
        <div class="lg:col-span-3">
            <div class="rounded-2xl bg-white/85 backdrop-blur-xl shadow-xl border border-white p-6">
                <div class="flex items-start justify-between gap-4">
                    <div>
                        <h3 class="text-lg font-bold text-gray-900">Overview</h3>
                        <p class="text-sm text-gray-600">Item specifications and description.</p>
                    </div>

                    <div class="rounded-xl border border-gray-200 bg-gray-50 px-4 py-2 text-sm">
                        <div class="text-gray-500">Quantity</div>
                        <div class="font-bold text-gray-900">{{ $item->quantity }}</div>
                    </div>
                </div>

                <div class="mt-6">
                    <h4 class="text-sm font-semibold text-gray-700 mb-2">Description</h4>
                    <div class="rounded-xl border border-gray-200 bg-white/60 px-4 py-3 text-sm text-gray-700 leading-relaxed">
                        {{ $item->description }}
                    </div>
                </div>

                <div class="mt-6 grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="rounded-xl border border-gray-200 bg-white/60 p-4">
                        <div class="text-xs text-gray-500">Price</div>
                        <div class="mt-1 text-lg font-bold text-gray-900">
                            ${{ number_format($item->price, 2) }}
                        </div>
                    </div>

                    <div class="rounded-xl border border-gray-200 bg-white/60 p-4">
                        <div class="text-xs text-gray-500">Color</div>

                        @php
                            $c = $item->color;
                            $isHex = is_string($c) && preg_match('/^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/', $c);
                        @endphp

                        <div class="mt-2 flex items-center gap-3">
                            <span class="inline-block h-6 w-6 rounded-full border border-gray-300"
                                  style="background-color: {{ $isHex ? $c : '#F3F4F6' }};"></span>

                            <div class="text-sm font-semibold text-gray-900">
                                {{ $item->color ?? '—' }}
                            </div>
                        </div>

                        @if(!$isHex && !empty($c))
                            <p class="mt-2 text-xs text-gray-500">
                                Tip: If you want the circle to match, store color as HEX (example: #111827).
                            </p>
                        @endif
                    </div>
                </div>

                <div class="mt-6 flex flex-wrap gap-3">
                    <a href="{{ route('items.index') }}"
                       class="rounded-xl border border-gray-200 bg-white px-4 py-2 text-sm font-semibold text-gray-700 hover:bg-gray-50 transition">
                        Back to Items
                    </a>

                    <a href="{{ route('items.edit', $item->id) }}"
                       class="rounded-xl bg-primary px-5 py-2 text-sm font-semibold text-white shadow-sm hover:bg-primary-600 focus:outline-none focus:ring-4 focus:ring-primary/25 transition">
                        Edit Item
                    </a>

                    <form action="{{ route('items.destroy', $item->id) }}" method="POST"
                          onsubmit="return confirm('Are you sure you want to delete this item?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                class="rounded-xl border border-red-200 bg-red-50 px-4 py-2 text-sm font-semibold text-red-700 hover:bg-red-100 transition">
                            Delete
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

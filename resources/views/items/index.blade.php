@extends('layouts.app')

@section('title', 'Items')

@section('content')
<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

    {{-- Header --}}
    <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Items</h1>
            <p class="text-sm text-gray-600">
                Manage store items.
            </p>
        </div>

        <a href="{{ route('items.create') }}"
           class="inline-flex items-center justify-center rounded-xl bg-primary px-4 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-primary-600 transition">
            + Create Item
        </a>
    </div>

    {{-- Success message --}}
    @if (session('success'))
        <div class="mb-4 rounded-xl border border-green-200 bg-green-50 px-4 py-3 text-green-800">
            {{ session('success') }}
        </div>
    @endif

    {{-- Category Filter --}}
    <div class="mb-4">
        <form method="GET" action="{{ route('items.index') }}"
              class="flex flex-wrap items-center gap-3">

            <label class="text-sm font-medium text-gray-700">
                Filter by category:
            </label>

            <select name="category"
                    onchange="this.form.submit()"
                    class="rounded-xl border-gray-300 text-sm focus:border-primary focus:ring-primary">
                <option value="">All Categories</option>

                @foreach($categories as $category)
                    <option value="{{ $category->id }}"
                        {{ request('category') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>

            @if(request()->has('category'))
                <a href="{{ route('items.index') }}"
                   class="text-sm text-primary hover:underline">
                    Clear filter
                </a>
            @endif
        </form>
    </div>

    {{-- Items Table --}}
    <div class="rounded-2xl bg-white/85 backdrop-blur-xl shadow-xl border border-white overflow-hidden">

        @if($items->isEmpty())
            <div class="p-8 text-center text-gray-500">
                No items found.
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="min-w-full text-sm">

                    <thead class="bg-gray-50 border-y border-gray-200">
                        <tr class="text-left text-gray-600">
                            <th class="px-6 py-3 font-semibold">Image</th>
                            <th class="px-6 py-3 font-semibold">Name</th>
                            <th class="px-6 py-3 font-semibold">Category</th>
                            <th class="px-6 py-3 font-semibold">Price</th>
                            <th class="px-6 py-3 font-semibold">Qty</th>
                            <th class="px-6 py-3 font-semibold text-right">Actions</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-100">
                        @foreach ($items as $item)
                            <tr class="hover:bg-primary-50/60 transition">

                                {{-- Image --}}
                                <td class="px-6 py-4">
                                    @if($item->image)
                                        <img src="{{ asset('images/items/' . $item->image) }}"
                                             class="h-12 w-16 rounded-lg object-cover border">
                                    @else
                                        <span class="text-gray-400 text-xs">No image</span>
                                    @endif
                                </td>

                                {{-- Name --}}
                                <td class="px-6 py-4 font-semibold text-gray-900">
                                    {{ $item->name }}
                                </td>

                                {{-- Category --}}
                                <td class="px-6 py-4 text-gray-700">
                                    {{ $item->category->name ?? '—' }}
                                </td>

                                {{-- Price --}}
                                <td class="px-6 py-4 text-gray-700">
                                    ${{ number_format($item->price, 2) }}
                                </td>

                                {{-- Quantity --}}
                                <td class="px-6 py-4 text-gray-700">
                                    {{ $item->quantity }}
                                </td>

                                {{-- Actions --}}
                                <td class="px-6 py-4">
                                    <div class="flex justify-end gap-2">

                                        <a href="{{ route('items.edit', $item) }}"
                                           class="rounded-lg border border-primary-200 bg-primary-50 px-3 py-1.5 text-primary-800 hover:bg-primary-100 transition">
                                            Edit
                                        </a>

                                        <form method="POST"
                                              action="{{ route('items.destroy', $item) }}"
                                              onsubmit="return confirm('Delete this item?');">
                                            @csrf
                                            @method('DELETE')
                                            <button
                                                class="rounded-lg border border-red-200 bg-red-50 px-3 py-1.5 text-red-700 hover:bg-red-100 transition">
                                                Delete
                                            </button>
                                        </form>

                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>
        @endif
    </div>
</div>
@endsection

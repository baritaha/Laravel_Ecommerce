@extends('layouts.app')

@section('title', 'Categories')

@section('content')
<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

    {{-- Header --}}
    <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Categories</h1>
            <p class="text-sm text-gray-600">
                Create and manage your store categories.
            </p>
        </div>

        <a href="{{ route('categories.create') }}"
           class="inline-flex items-center justify-center rounded-xl bg-primary px-4 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-primary-600 focus:outline-none focus:ring-4 focus:ring-primary/25 transition">
            + Create Category
        </a>
    </div>

    {{-- Success message --}}
    @if (session('success'))
        <div class="mb-4 rounded-xl border border-green-200 bg-green-50 px-4 py-3 text-green-800">
            {{ session('success') }}
        </div>
    @endif

    <div class="rounded-2xl bg-white/85 backdrop-blur-xl shadow-xl border border-white overflow-hidden">

        {{-- Table header --}}
        <div class="p-4 sm:p-6 flex items-center justify-between">
            <h2 class="text-lg font-semibold text-gray-900">All Categories</h2>
            <div class="text-sm text-gray-500">
                Total:
                <span class="font-semibold text-gray-700">
                    {{ $categories->count() }}
                </span>
            </div>
        </div>

        {{-- Empty state --}}
        @if($categories->isEmpty())
            <div class="p-8 text-center text-gray-500">
                No categories found.
                <br>
                <a href="{{ route('categories.create') }}"
                   class="mt-3 inline-block text-primary font-semibold hover:underline">
                    Create your first category
                </a>
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="min-w-full text-sm">

                    <thead class="bg-gray-50 border-y border-gray-200">
                        <tr class="text-left text-gray-600">
                            <th class="px-6 py-3 font-semibold">Name</th>
                            <th class="px-6 py-3 font-semibold">Image</th>
                            <th class="px-6 py-3 font-semibold">Items</th>
                            <th class="px-6 py-3 font-semibold text-right">Actions</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-100">
                        @foreach ($categories as $category)
                            <tr class="hover:bg-primary-50/60 transition">

                                {{-- Name --}}
                                <td class="px-6 py-4 font-semibold text-gray-900">
                                    {{ $category->name }}
                                </td>

                                {{-- Image --}}
                                <td class="px-6 py-4">
                                    <img
                                        src="{{ asset('images/categories/' . $category->image) }}"
                                        alt="{{ $category->name }}"
                                        class="h-14 w-20 rounded-xl object-cover border border-gray-200"
                                    />
                                </td>

                                {{-- Items count --}}
                                <td class="px-6 py-4 text-gray-700">
                                    <span class="font-semibold">
                                        {{ $category->items_count }}
                                    </span>
                                    item{{ $category->items_count !== 1 ? 's' : '' }}
                                </td>

                                {{-- Actions --}}
                                <td class="px-6 py-4">
                                    <div class="flex justify-end gap-2">

                                        {{-- Show items in this category --}}
                                      <a href="{{ route('items.index', ['category' => $category->id]) }}"
   class="rounded-lg border border-gray-200 bg-white px-3 py-1.5 text-gray-700 hover:border-primary-200 hover:bg-primary-50 transition">
    View Items
</a>


                                        {{-- Edit --}}
                                        <a href="{{ route('categories.edit', $category->id) }}"
                                           class="rounded-lg border border-primary-200 bg-primary-50 px-3 py-1.5 text-primary-800 hover:bg-primary-100 transition">
                                            Edit
                                        </a>

                                        {{-- Delete --}}
                                        <form action="{{ route('categories.destroy', $category->id) }}"
                                              method="POST"
                                              onsubmit="return confirm('Are you sure you want to delete this category? This action cannot be undone.');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
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

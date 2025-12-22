@extends('layouts.app')

@section('title', 'Category Details')

@section('content')
<div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
    <div class="mb-6 flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Category Details</h1>
            <p class="text-sm text-gray-600">View category information.</p>
        </div>

        <a href="{{ route('categories.index') }}"
           class="rounded-xl border border-gray-200 bg-white px-4 py-2 text-sm font-semibold text-gray-700 hover:bg-gray-50 transition">
            Back
        </a>
    </div>

    <div class="rounded-2xl bg-white/85 backdrop-blur-xl shadow-xl border border-white overflow-hidden">
        @if($category->image)
            <div class="relative">
                <img src="{{ asset('images/categories/' . $category->image) }}"
                     alt="{{ $category->name }}"
                     class="h-56 w-full object-cover">
                <div class="absolute inset-0 bg-gradient-to-t from-black/35 to-transparent"></div>
                <div class="absolute bottom-3 left-4">
                    <h2 class="text-xl font-bold text-white drop-shadow">{{ $category->name }}</h2>
                </div>
            </div>
        @endif

        <div class="p-6">
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div class="rounded-xl border border-gray-200 bg-gray-50 p-4">
                    <div class="text-xs font-semibold text-gray-500 uppercase">ID</div>
                    <div class="mt-1 font-semibold text-gray-900">{{ $category->id }}</div>
                </div>

                <div class="rounded-xl border border-gray-200 bg-gray-50 p-4">
                    <div class="text-xs font-semibold text-gray-500 uppercase">Items</div>
                    <div class="mt-1 font-semibold text-gray-900">{{ $category->items->count() }}</div>
                </div>

                <div class="rounded-xl border border-gray-200 bg-gray-50 p-4">
                    <div class="text-xs font-semibold text-gray-500 uppercase">Created At</div>
                    <div class="mt-1 font-semibold text-gray-900">{{ $category->created_at }}</div>
                </div>

                <div class="rounded-xl border border-gray-200 bg-gray-50 p-4">
                    <div class="text-xs font-semibold text-gray-500 uppercase">Updated At</div>
                    <div class="mt-1 font-semibold text-gray-900">{{ $category->updated_at }}</div>
                </div>
            </div>

            @if(!empty($category->description))
                <div class="mt-4 rounded-xl border border-primary-100 bg-primary-50 p-4">
                    <div class="text-xs font-semibold text-primary-800 uppercase">Description</div>
                    <div class="mt-1 text-sm text-gray-700">{{ $category->description }}</div>
                </div>
            @endif

            <div class="mt-6 flex justify-end gap-2">
                <a href="{{ route('categories.edit', $category->id) }}"
                   class="rounded-xl border border-primary-200 bg-primary-50 px-4 py-2 text-sm font-semibold text-primary-800 hover:bg-primary-100 transition">
                    Edit
                </a>

                <form action="{{ route('categories.destroy', $category->id) }}" method="POST"
                      onsubmit="return confirm('Are you sure you want to delete this category?');">
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
@endsection

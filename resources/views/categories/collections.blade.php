@extends('layouts.app')

@section('title', 'Collections')

@section('content')
<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900">Collections</h1>
        <p class="text-sm text-gray-600">Browse your collections and view items inside each category.</p>
    </div>

    @if ($categories->isEmpty())
        <div class="rounded-2xl border border-gray-200 bg-white/85 backdrop-blur-xl p-8 text-center shadow-xl">
            <div class="mx-auto mb-3 h-12 w-12 rounded-full bg-primary-100 flex items-center justify-center text-primary font-bold">
                !
            </div>
            <h3 class="text-lg font-semibold text-gray-900">No collections found</h3>
            <p class="mt-1 text-sm text-gray-600">You haven't added any collections yet.</p>
        </div>
    @else
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($categories as $category)
                <div class="rounded-2xl bg-white/85 backdrop-blur-xl shadow-xl border border-white overflow-hidden hover:shadow-2xl transition">
                    <div class="relative">
                        <img
                            src="{{ asset('images/categories/' . $category->image) }}"
                            alt="{{ $category->name }}"
                            class="h-44 w-full object-cover"
                        />
                        <div class="absolute inset-0 bg-gradient-to-t from-black/35 to-transparent"></div>
                        <div class="absolute bottom-3 left-3 right-3">
                            <h3 class="text-lg font-bold text-white drop-shadow">{{ $category->name }}</h3>
                        </div>
                    </div>

                    <div class="p-5">
                        <p class="text-sm text-gray-700 line-clamp-3">
                            {{ $category->description }}
                        </p>

                        <div class="mt-4 flex items-center justify-between">
                            <span class="inline-flex items-center rounded-full bg-primary-100 px-3 py-1 text-xs font-semibold text-primary-800">
                                Items: {{ $category->items->count() }}
                            </span>

                            <a href="{{ route('categories.show', $category->id) }}"
                               class="rounded-xl bg-primary px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-primary-600 focus:outline-none focus:ring-4 focus:ring-primary/25 transition">
                                View Items
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection

@extends('layouts.app')

@section('title', 'Create Item')

@section('content')
<div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

    {{-- Page header --}}
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900">Create New Item</h1>
        <p class="text-sm text-gray-600">
            Add a new item with price, quantity, category, and image.
        </p>
    </div>

    {{-- Validation errors --}}
    @if ($errors->any())
        <div class="mb-4 rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-red-800">
            <div class="font-semibold mb-2">Please fix the following errors:</div>
            <ul class="list-disc ms-5 text-sm">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="rounded-2xl bg-white/85 backdrop-blur-xl shadow-xl border border-white p-6">
        <form action="{{ route('items.store') }}"
              method="POST"
              enctype="multipart/form-data"
              class="space-y-5">
            @csrf

            {{-- Item Name --}}
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">
                    Item Name
                </label>
                <input type="text"
                       name="name"
                       value="{{ old('name') }}"
                       required
                       class="w-full rounded-xl border border-gray-200 bg-white/70 px-3 py-2 text-sm shadow-sm
                              focus:border-primary focus:ring-4 focus:ring-primary/20 transition">
            </div>

            {{-- Description --}}
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">
                    Description
                </label>
                <textarea name="description"
                          rows="4"
                          required
                          class="w-full rounded-xl border border-gray-200 bg-white/70 px-3 py-2 text-sm shadow-sm
                                 focus:border-primary focus:ring-4 focus:ring-primary/20 transition">{{ old('description') }}</textarea>
            </div>

            {{-- Price & Quantity --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">
                        Price ($)
                    </label>
                    <input type="number"
                           step="0.01"
                           name="price"
                           value="{{ old('price') }}"
                           required
                           class="w-full rounded-xl border border-gray-200 bg-white/70 px-3 py-2 text-sm shadow-sm
                                  focus:border-primary focus:ring-4 focus:ring-primary/20 transition">
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">
                        Quantity
                    </label>
                    <input type="number"
                           name="quantity"
                           min="1"
                           value="{{ old('quantity') }}"
                           required
                           class="w-full rounded-xl border border-gray-200 bg-white/70 px-3 py-2 text-sm shadow-sm
                                  focus:border-primary focus:ring-4 focus:ring-primary/20 transition">
                </div>
            </div>

            {{-- Color --}}
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">
                    Color
                </label>
                <input type="text"
                       name="color"
                       value="{{ old('color') }}"
                       required
                       placeholder="e.g. Black, White"
                       class="w-full rounded-xl border border-gray-200 bg-white/70 px-3 py-2 text-sm shadow-sm
                              focus:border-primary focus:ring-4 focus:ring-primary/20 transition">
            </div>

            {{-- Category --}}
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">
                    Category
                </label>
                <select name="category_id"
                        required
                        class="w-full rounded-xl border border-gray-200 bg-white/70 px-3 py-2 text-sm shadow-sm
                               focus:border-primary focus:ring-4 focus:ring-primary/20 transition">
                    <option value="" disabled selected>Select a category</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}"
                            {{ old('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Image --}}
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">
                    Image
                </label>
                <input type="file"
                       name="image"
                       class="w-full rounded-xl border border-gray-200 bg-white/70 px-3 py-2 text-sm shadow-sm
                              focus:border-primary focus:ring-4 focus:ring-primary/20 transition">
                <p class="mt-1 text-xs text-gray-500">
                    Optional. JPG or PNG recommended.
                </p>
            </div>

            {{-- Actions --}}
            <div class="flex items-center justify-end gap-3 pt-2">
                <a href="{{ route('items.index') }}"
                   class="rounded-xl border border-gray-200 bg-white px-4 py-2 text-sm font-semibold text-gray-700 hover:bg-gray-50 transition">
                    Cancel
                </a>

                <button type="submit"
                        class="rounded-xl bg-primary px-5 py-2 text-sm font-semibold text-white shadow-sm
                               hover:bg-primary-600 focus:outline-none focus:ring-4 focus:ring-primary/25 transition">
                    Create Item
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

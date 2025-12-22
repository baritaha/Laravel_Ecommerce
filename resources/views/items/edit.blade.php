@extends('layouts.app')

@section('title', 'Edit Item')

@section('content')
<div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900">Edit Item</h1>
        <p class="text-sm text-gray-600">Update item details, price, quantity and image.</p>
    </div>

    @if ($errors->any())
        <div class="mb-4 rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-red-800">
            <ul class="list-disc ms-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="rounded-2xl bg-white/85 backdrop-blur-xl shadow-xl border border-white p-6">
        <form action="{{ route('items.update', $item->id) }}" method="POST" enctype="multipart/form-data" class="space-y-5">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Item Name</label>
                <input type="text" name="name" value="{{ old('name', $item->name) }}" required
                    class="w-full rounded-xl border border-gray-200 bg-white/70 px-3 py-2 text-sm shadow-sm
                           focus:border-primary focus:ring-4 focus:ring-primary/20 transition">
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Description</label>
                <textarea name="description" rows="4" required
                    class="w-full rounded-xl border border-gray-200 bg-white/70 px-3 py-2 text-sm shadow-sm
                           focus:border-primary focus:ring-4 focus:ring-primary/20 transition">{{ old('description', $item->description) }}</textarea>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Price ($)</label>
                    <input type="number" step="0.01" name="price" value="{{ old('price', $item->price) }}" required
                        class="w-full rounded-xl border border-gray-200 bg-white/70 px-3 py-2 text-sm shadow-sm
                               focus:border-primary focus:ring-4 focus:ring-primary/20 transition">
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Quantity</label>
                    <input type="number" name="quantity" value="{{ old('quantity', $item->quantity) }}" required
                        class="w-full rounded-xl border border-gray-200 bg-white/70 px-3 py-2 text-sm shadow-sm
                               focus:border-primary focus:ring-4 focus:ring-primary/20 transition">
                </div>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Color</label>
                <input type="text" name="color" value="{{ old('color', $item->color) }}"
                    class="w-full rounded-xl border border-gray-200 bg-white/70 px-3 py-2 text-sm shadow-sm
                           focus:border-primary focus:ring-4 focus:ring-primary/20 transition">
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Category</label>
                <select name="category_id" required
                    class="w-full rounded-xl border border-gray-200 bg-white/70 px-3 py-2 text-sm shadow-sm
                           focus:border-primary focus:ring-4 focus:ring-primary/20 transition">
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id', $item->category_id) == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Image (Optional)</label>
                <input type="file" name="image"
                    class="w-full rounded-xl border border-gray-200 bg-white/70 px-3 py-2 text-sm shadow-sm
                           focus:border-primary focus:ring-4 focus:ring-primary/20 transition">

                @if ($item->image)
                    <div class="mt-3 flex items-center gap-3">
                        <img src="{{ asset('images/' . $item->image) }}" alt="current image"
                             class="h-16 w-20 rounded-xl object-cover border border-gray-200">
                        <div class="text-sm text-gray-600">
                            <div class="font-semibold text-gray-800">Current image</div>
                            <div class="text-xs">Upload a new one to replace it.</div>
                        </div>
                    </div>
                @endif
            </div>

            <div class="flex items-center justify-end gap-3 pt-2">
                <a href="{{ route('items.index') }}"
                   class="rounded-xl border border-gray-200 bg-white px-4 py-2 text-sm font-semibold text-gray-700 hover:bg-gray-50 transition">
                    Cancel
                </a>

                <button type="submit"
                    class="rounded-xl bg-primary px-5 py-2 text-sm font-semibold text-white shadow-sm hover:bg-primary-600 focus:outline-none focus:ring-4 focus:ring-primary/25 transition">
                    Update Item
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

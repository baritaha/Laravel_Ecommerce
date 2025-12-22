@extends('layouts.app')

@section('title', 'Create Category')

@section('content')
<div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900">Create Category</h1>
        <p class="text-sm text-gray-600">Add a new category to your store.</p>
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
        <form action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
            @csrf

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Category Name</label>
                <input type="text" name="name" value="{{ old('name') }}" required
                       class="w-full rounded-xl border border-gray-200 bg-white/70 px-3 py-2 text-sm shadow-sm
                              focus:border-primary focus:ring-4 focus:ring-primary/20 transition">
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Description</label>
                <textarea name="description" rows="4"
                    class="w-full rounded-xl border border-gray-200 bg-white/70 px-3 py-2 text-sm shadow-sm
                           focus:border-primary focus:ring-4 focus:ring-primary/20 transition">{{ old('description') }}</textarea>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Category Image</label>
                <input type="file" name="image"
                       class="w-full rounded-xl border border-gray-200 bg-white/70 px-3 py-2 text-sm shadow-sm
                              focus:border-primary focus:ring-4 focus:ring-primary/20 transition">
            </div>

            <div class="flex items-center justify-end gap-3 pt-2">
                <a href="{{ route('categories.index') }}"
                   class="rounded-xl border border-gray-200 bg-white px-4 py-2 text-sm font-semibold text-gray-700 hover:bg-gray-50 transition">
                    Cancel
                </a>

                <button type="submit"
                    class="rounded-xl bg-primary px-5 py-2 text-sm font-semibold text-white shadow-sm hover:bg-primary-600 focus:outline-none focus:ring-4 focus:ring-primary/25 transition">
                    Create
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

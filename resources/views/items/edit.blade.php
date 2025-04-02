@extends('layouts.app')

@section('title', 'Edit Item')

@section('content')
<div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
    <div class="card shadow-lg p-4" style="width: 100%; max-width: 600px; border: none; border-radius: 12px; background: linear-gradient(135deg, #d4e4f7, #c6b7a3);">
        <h2 class="text-center mb-4" style="color: #2b6cb0;">Edit Item</h2>

        <!-- Error Messages -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Form Starts -->
        <form action="{{ route('items.update', $item->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="name" class="form-label" style="color: #2b6cb0;">Item Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $item->name) }}" required style="border-color: #6b705c;">
            </div>

            <div class="mb-3">
                <label for="description" class="form-label" style="color: #2b6cb0;">Description</label>
                <textarea class="form-control" id="description" name="description" rows="3" required style="border-color: #6b705c;">{{ old('description', $item->description) }}</textarea>
            </div>

            <div class="mb-3">
                <label for="price" class="form-label" style="color: #2b6cb0;">Price ($)</label>
                <input type="number" step="0.01" class="form-control" id="price" name="price" value="{{ old('price', $item->price) }}" required style="border-color: #6b705c;">
            </div>

            <div class="mb-3">
                <label for="quantity" class="form-label" style="color: #2b6cb0;">Quantity</label>
                <input type="number" class="form-control" id="quantity" name="quantity" value="{{ old('quantity', $item->quantity) }}" required style="border-color: #6b705c;">
            </div>

            <div class="mb-3">
                <label for="color" class="form-label" style="color: #2b6cb0;">Color</label>
                <input type="text" class="form-control" id="color" name="color" value="{{ old('color', $item->color) }}" required style="border-color: #6b705c;">
            </div>

            <div class="mb-3">
                <label for="category_id" class="form-label" style="color: #2b6cb0;">Category</label>
                <select class="form-control" id="category_id" name="category_id" required style="border-color: #6b705c;">
                    <option value="" disabled>Select a Category</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id', $item->category_id) == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="image" class="form-label" style="color: #2b6cb0;">Image (Optional)</label>
                <input type="file" class="form-control" id="image" name="image" style="border-color: #6b705c;">
                @if ($item->image)
                    <small class="d-block mt-2" style="color: #6b705c;">Current Image:
                        <img src="{{ asset('images/' . $item->image) }}" alt="current image" style="color: #2b6cb0;">View Current Image
                    </small>
                @endif
            </div>


            <button type="submit" class="btn btn-primary w-100" style="background-color: #2b6cb0; border-color: #2b6cb0; border-radius: 8px;">
                Update Item
            </button>
        </form>
        <!-- Form Ends -->
    </div>
</div>
@endsection

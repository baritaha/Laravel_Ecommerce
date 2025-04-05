@extends('layouts.app')

@section('title', 'Create Item')

@section('content')
    <div class="container py-5">
        <div class="card shadow-lg">
            <div class="card-header bg-primary text-white text-center">
                <h3>Create New Item</h3>
            </div>
            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <h5 class="alert-heading">Please fix the following errors:</h5>
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('items.store') }}" method="POST" enctype="multipart/form-data" class="needs-validation"
                    novalidate>
                    @csrf

                    <!-- Item Name -->
                    <div class="mb-3">
                        <label for="name" class="form-label">Item Name</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}"
                            required>
                        <div class="invalid-feedback">
                            Please provide a valid item name.
                        </div>
                    </div>

                    <!-- Description -->
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="3" required>{{ old('description') }}</textarea>
                        <div class="invalid-feedback">
                            Please enter a description.
                        </div>
                    </div>

                    <!-- Price -->
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="price" class="form-label">Price ($)</label>
                            <input type="number" step="0.01" class="form-control" id="price" name="price"
                                value="{{ old('price') }}" required>
                            <div class="invalid-feedback">
                                Please provide a valid price.
                            </div>
                        </div>

                        <!-- Quantity -->
                        <div class="col-md-6 mb-3">
                            <label for="quantity" class="form-label">Quantity</label>
                            <input type="number" class="form-control" id="quantity" name="quantity"
                                value="{{ old('quantity') }}" required>
                            <div class="invalid-feedback">
                                Please enter a valid quantity.
                            </div>
                        </div>
                    </div>

                    <!-- Color -->
                    <div class="mb-3">
                        <label for="color" class="form-label">Color</label>
                        <input type="text" class="form-control" id="color" name="color"
                            value="{{ old('color') }}">
                        <div class="invalid-feedback">
                            Please specify the color.
                        </div>
                    </div>

                    <!-- Category -->
                    <div class="mb-3">
                        <label for="category_id" class="form-label">Category</label>
                        <select class="form-select" id="category_id" name="category_id" required>
                            <option value="" disabled selected>Select a Category</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name}}
                                </option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback">
                            Please choose a category.
                        </div>
                    </div>

                    <!-- Assign to User -->
                    <div class="mb-3">
                        <label for="user_id" class="form-label">Assign to User</label>
                        <select class="form-select" id="user_id" name="user_id" required>
                            <option value="" disabled selected>Select a User</option>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                                    {{ $user->name }}
                                </option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback">
                            Please assign this item to a user.
                        </div>
                    </div>

                    <!-- Image -->
                    <div class="mb-3">
                        <label for="image" class="form-label">Image</label>
                        <input type="file" class="form-control" id="image" name="image">
                        <div class="invalid-feedback">
                            Please upload a valid image.
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary px-5">Create Item</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap Form Validation -->
    <script>
        // Bootstrap custom validation
        (function() {
            'use strict';
            var forms = document.querySelectorAll('.needs-validation');
            Array.prototype.slice.call(forms).forEach(function(form) {
                form.addEventListener('submit', function(event) {
                    if (!form.checkValidity()) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        })();
    </script>
@endsection

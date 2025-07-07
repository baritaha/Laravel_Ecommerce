@extends('layouts.app')

@section('title', 'Edit Category')

@section('content')
<div class="container py-12">
    <h1>Edit Category</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('categories.update', $category->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="name" class="form-label">Category Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $category->name) }}" required>
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Category Image</label>
            <input type="file" class="form-control" id="image" name="image">
            @if ($category->image)
                <img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->name }}" class="img-thumbnail mt-2" style="max-width: 200px;">
            @endif

        <button type="submit" class="btn btn-primary">Update Category</button>
    </form>
</div>
@endsection

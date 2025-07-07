@extends('layouts.app')

@section('title', 'Categories')

@section('content')
    <div class="container py-12">
        <h1 class="titleText">All Categories</h1>
        <a href="{{ route('categories.create') }}" class="btnDesign mb-3 p-2">Create New Category</a>

        <table class="table mt-4 table-striped table-bordered table-hover shadow rounded" style="opacity: 0.9;">
            <thead>

                <tr class="table-primary text-center fw-bold text-dark text-decoration-underline text-uppercase">
                    <th>Name</th>
                    <th>Image</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                    <tr class="text-center text-dark fw-bold">
                        <td>{{ $category->name }}</td>
                        <td style="justify-content: center; align-items: center; display: flex;">
                            <img src="{{ asset('images/categories/' . $category->image) }}" alt="{{ $category->name }}" class="img-thumbnail"
                                style="max-width: 150px; max-height: 200px;object-fit: cover;">
                        </td>
                        <td>
                            <a href="{{ route('categories.show', $category->id) }}" class="btn btn-info btn-sm">Show</a>
                            <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('categories.destroy', $category->id) }}" method="POST"
                                style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

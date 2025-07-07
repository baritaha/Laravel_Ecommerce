@extends('layouts.app')

@section('title', 'collections')

@section('content')
    <div class="container py-5">
        <div class="card shadow-lg">
            <div class="card-header bg-primary text-white text-center">
                <h3>Collections</h3>
            </div>
            <div class="card-body">
                @if ($categories->isEmpty())
                    <div class="alert alert-info text-center">
                        <strong>No collections found.</strong> You haven't added any collections yet.
                    </div>
                @else
                    <div class="row">
                        @foreach ($categories as $category)
                            <div class="col-md-4 mb-4">
                                <div class="card h-100">
                                    <div class="card-header bg-secondary text-white">
                                        <h5 class="card-title">{{ $category->name }}</h5>
                                    </div>
                                    <div class="card-body justify-content-center align-items-center d-flex flex-column">
                                        <img src="{{ asset('images/categories/' . $category->image) }}" alt="{{ $category->name }}"
                                            class="img-fluid mb-3" style="max-height: 200px; object-fit: cover;">
                                        <p class="card-text">{{ $category->description }}</p>
                                        <p class="card-text"><strong>Items:</strong> {{ $category->items->count() }}</p>
                                        <a href="{{ route('categories.show', $category->id) }}" class="btn btn-primary">View
                                            Items</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection

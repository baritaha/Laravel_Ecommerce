@extends('layouts.app')

@section('title', 'Item Details')

@section('content')
<div class="container py-12">
    <h1>Item Details</h1>
    <div class="card">
        <div class="card-header">
            <h2>{{ $category->name }}</h2>
        </div>
        <div class="card-body">
            <p><strong>ID:</strong> {{ $category->id }}</p>
            <p><strong>Created_at:</strong> ${{ $category->created_at }}</p>
            <p><strong>Updated_at:</strong> ${{ $category->updated_at }}</p>

        </div>
        <div class="card-footer">
            <a href="{{ route('categories.index') }}" class="btn btn-primary">Back</a>
            

        </div>
    </div>
</div>
@endsection

@extends('layouts.app')

@section('title', 'Item Details')

@section('content')
<div class="container py-12">
    <h1>Item Details</h1>
    <div class="card">
        <div class="card-header">
            <h2>{{ $item->name }}</h2>
        </div>
        <div class="card-body d-flex justify-content-center">
            <div class="inner-body mt-5" style="margin-right: 200px">
                <p class="p-1"><strong>Description:</strong> {{ $item->description }}</p>
                <p class="p-1"><strong>Price:</strong> ${{ $item->price }}</p>
                <p class="p-1"><strong>Quantity:</strong> {{ $item->quantity }}</p>
                <p class="p-1" style="background-color: {{$item->color}};color:white"><strong>Color:</strong> {{ $item->color }}</p>
                <p class="p-1"><strong>Category:</strong> {{ $item->category->name }}</p>
            </div>

            @if ($item->image)

                <img src="{{ asset('/images/' . $item->image) }}" alt="{{ $item->name }}" width="300">
            @endif
        </div>
        <div class="card-footer">
            <a href="{{ route('items.index') }}" class="btn btn-primary">Back</a>


        </div>
    </div>
</div>
@endsection

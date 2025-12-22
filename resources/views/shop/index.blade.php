@extends('layouts.app')

@section('title', 'Shop')

@section('content')
<div class="max-w-7xl mx-auto p-6">
    <h1 class="text-2xl font-bold mb-6">Shop</h1>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        @foreach($items as $item)
            <div class="border rounded-xl p-4 bg-white">
                <img src="{{ asset('images/items/' . $item->image) }}"
                     class="h-40 w-full object-cover rounded mb-3">

                <h3 class="font-semibold">{{ $item->name }}</h3>
                <p class="text-sm text-gray-600 mb-2">
                    ${{ number_format($item->price, 2) }}
                </p>

                <form method="POST" action="{{ route('cart.add', $item) }}">
                    @csrf
                    <button class="w-full bg-primary text-white py-2 rounded">
                        Add to Cart
                    </button>
                </form>
            </div>
        @endforeach
    </div>

    <div class="mt-6">
        {{ $items->links() }}
    </div>
</div>
@endsection

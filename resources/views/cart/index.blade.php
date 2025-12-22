@extends('layouts.app')

@section('title', 'Cart')

@section('content')
<div class="max-w-5xl mx-auto p-6">
    <h1 class="text-2xl font-bold mb-6">Your Cart</h1>

    @if(empty($cart))
        <p>Your cart is empty.</p>
    @else
        <table class="w-full border">
            <thead>
                <tr>
                    <th class="p-2">Item</th>
                    <th class="p-2">Price</th>
                    <th class="p-2">Quantity</th>
                    <th class="p-2">Total</th>
                    <th class="p-2"></th>
                </tr>
            </thead>
            <tbody>
                @php $grandTotal = 0; @endphp

                @foreach($cart as $id => $item)
                    @php $total = $item['price'] * $item['quantity']; @endphp
                    @php $grandTotal += $total; @endphp

                    <tr>
                        <td class="p-2">{{ $item['name'] }}</td>
                        <td class="p-2">${{ $item['price'] }}</td>
                        <td class="p-2">
                            <form method="POST" action="{{ route('cart.update', $id) }}">
                                @csrf
                                <input type="number" name="quantity"
                                       value="{{ $item['quantity'] }}" min="1"
                                       class="w-16 border">
                                <button>Update</button>
                            </form>
                        </td>
                        <td class="p-2">${{ $total }}</td>
                        <td class="p-2">
                            <form method="POST" action="{{ route('cart.remove', $id) }}">
                                @csrf
                                <button class="text-red-600">Remove</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-6 text-right">
            <p class="font-bold text-lg">
                Total: ${{ $grandTotal }}
            </p>

            <form method="POST" action="{{ route('orders.store') }}">
                @csrf
                <button class="mt-4 bg-primary text-white px-6 py-2 rounded">
                    Checkout
                </button>
            </form>
        </div>
    @endif
</div>
@endsection

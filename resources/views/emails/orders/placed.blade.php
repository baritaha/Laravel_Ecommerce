<h2>Thank you for your order!</h2>

<p><strong>Order #{{ $order->id }}</strong></p>
<p>Status: {{ ucfirst($order->status) }}</p>
<p>Total: ${{ number_format($order->total, 2) }}</p>

<hr>

<h4>Order Items</h4>

@if($order->orderItems->isEmpty())
    <p>No items found.</p>
@else
    <ul>
        @foreach($order->orderItems as $orderItem)
            <li>
                {{ $orderItem->item->name ?? 'Item removed' }}
                — {{ $orderItem->quantity }} ×
                ${{ number_format($orderItem->price, 2) }}
            </li>
        @endforeach
    </ul>
@endif

<hr>

<p>
    <a href="{{ route('orders.show', $order) }}">
        View Order Details
    </a>
</p>
<p>
    <a href="{{ route('shop.index') }}">
        Continue Shopping
    </a>
</p>
<p>Thank you for shopping with us!</p>

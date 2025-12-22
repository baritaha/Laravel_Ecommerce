<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Order Confirmation</title>
</head>
<body style="font-family: Arial, sans-serif; background:#f9fafb; padding:20px">

    <div style="max-width:600px;margin:auto;background:#ffffff;padding:20px;border-radius:8px">

        <h2>Thank you for your order 🎉</h2>

        <p>
            <strong>Order #{{ $order->id }}</strong><br>
            Date: {{ $order->created_at->format('d M Y') }}<br>
            Status: {{ ucfirst($order->status) }}
        </p>

        <hr>

        <h3>Order Items</h3>

        <table width="100%" cellpadding="8" cellspacing="0" border="1" style="border-collapse:collapse">
            <thead>
                <tr>
                    <th align="left">Item</th>
                    <th align="center">Qty</th>
                    <th align="right">Price</th>
                </tr>
            </thead>
            <tbody>
                @foreach($order->orderItems as $orderItem)
                    <tr>
                        <td>{{ $orderItem->item->name ?? 'Item removed' }}</td>
                        <td align="center">{{ $orderItem->quantity }}</td>
                        <td align="right">${{ number_format($orderItem->price, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <p style="margin-top:15px">
            <strong>Total: ${{ number_format($order->total, 2) }}</strong>
        </p>

        <a href="{{ route('orders.show', $order) }}"
           style="display:inline-block;margin-top:15px;padding:10px 16px;
                  background:#f97316;color:#fff;text-decoration:none;border-radius:6px">
            View Order Details
        </a>

        <p style="margin-top:20px;font-size:12px;color:#6b7280">
            Laravel Ecommerce © {{ date('Y') }}
        </p>

    </div>
</body>
</html>

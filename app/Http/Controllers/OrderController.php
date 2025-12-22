<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderPlacedMail;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /*
    |--------------------------------------------------------------------------
    | ADMIN: View all orders
    |--------------------------------------------------------------------------
    */
    public function index()
    {
        abort_unless(auth()->user()->is_admin, 403);

        $orders = Order::with('user')
            ->latest()
            ->paginate(10);

        return view('orders.index', compact('orders'));
    }

    /*
    |--------------------------------------------------------------------------
    | USER: View my orders
    |--------------------------------------------------------------------------
    */
    public function myOrders()
    {
        $orders = Order::where('user_id', auth()->id())
            ->with('orderItems.item')
            ->latest()
            ->paginate(10);

        return view('orders.my-order', compact('orders'));
    }

    /*
    |--------------------------------------------------------------------------
    | USER: Place order (Checkout)
    |--------------------------------------------------------------------------
    */
    public function store(Request $request)
    {
        $cart = session('cart', []);

        if (empty($cart)) {
            return back()->with('error', 'Your cart is empty.');
        }

        $order = null;

        DB::transaction(function () use ($cart, &$order) {

            // 1️⃣ Calculate total
            $total = collect($cart)->sum(
                fn($item) =>
                $item['price'] * $item['quantity']
            );

            // 2️⃣ Create order
            $order = Order::create([
                'user_id' => auth()->id(),
                'total'   => $total,
                'status'  => 'pending',
            ]);

            // 3️⃣ Create order items + reduce stock
            foreach ($cart as $itemId => $cartItem) {

                $item = Item::lockForUpdate()->findOrFail($itemId);

                if ($item->quantity < $cartItem['quantity']) {
                    throw new \Exception("Not enough stock for {$item->name}");
                }

                $item->decrement('quantity', $cartItem['quantity']);

                OrderItem::create([
                    'order_id' => $order->id,
                    'item_id'  => $item->id,
                    'price'    => $cartItem['price'],
                    'quantity' => $cartItem['quantity'],
                ]);
            }
        });
        // 4️⃣ Send confirmation email (SAFE)
        if ($order instanceof \App\Models\Order) {
            try {
                $order->load('orderItems.item');

                Mail::to(auth()->user()->email)
                    ->send(new OrderPlacedMail($order));
            } catch (\Throwable $e) {
                logger()->error('Order email failed', [
                    'order_id' => $order->id,
                    'error' => $e->getMessage(),
                ]);
            }
        }


        // 5️⃣ Clear cart
        session()->forget('cart');

        return redirect()
            ->route('orders.my-order')
            ->with('success', 'Order placed successfully.');
    }

    /*
    |--------------------------------------------------------------------------
    | USER + ADMIN: View order details
    |--------------------------------------------------------------------------
    */
    public function show(Order $order)
    {
        if ($order->user_id !== auth()->id() && !auth()->user()->is_admin) {
            abort(403);
        }

        $order->load('orderItems.item');

        return view('orders.show', compact('order'));
    }

    /*
    |--------------------------------------------------------------------------
    | USER: Cancel order
    |--------------------------------------------------------------------------
    */
    public function cancel(Order $order)
    {
        if ($order->user_id !== auth()->id()) {
            abort(403);
        }

        if (!in_array($order->status, ['pending', 'processing'])) {
            return back()->with('error', 'This order cannot be cancelled.');
        }

        DB::transaction(function () use ($order) {

            foreach ($order->orderItems as $orderItem) {
                if ($orderItem->item) {
                    $orderItem->item->increment('quantity', $orderItem->quantity);
                }
            }

            $order->update(['status' => 'cancelled']);
        });

        return back()->with('success', 'Order cancelled successfully.');
    }

    /*
    |--------------------------------------------------------------------------
    | ADMIN: Update order status
    |--------------------------------------------------------------------------
    */
    public function update(Request $request, Order $order)
    {
        abort_unless(auth()->user()->is_admin, 403);

        $request->validate([
            'status' => 'required|in:pending,processing,completed,cancelled',
        ]);

        $order->update([
            'status' => $request->status,
        ]);

        return back()->with('success', 'Order status updated.');
    }

    /*
    |--------------------------------------------------------------------------
    | USER: Reorder items (copy back to cart)
    |--------------------------------------------------------------------------
    */
    public function reorder(Order $order)
    {
        if ($order->user_id !== auth()->id()) {
            abort(403);
        }

        $order->load('orderItems.item');

        if ($order->orderItems->isEmpty()) {
            return back()->with('error', 'This order has no items to reorder.');
        }

        $cart = session('cart', []);

        foreach ($order->orderItems as $orderItem) {

            if (!$orderItem->item) {
                continue;
            }

            $itemId = $orderItem->item->id;

            if (isset($cart[$itemId])) {
                $cart[$itemId]['quantity'] += $orderItem->quantity;
            } else {
                $cart[$itemId] = [
                    'name'     => $orderItem->item->name,
                    'price'    => $orderItem->price,
                    'quantity' => $orderItem->quantity,
                    'image'    => $orderItem->item->image,
                ];
            }
        }

        session(['cart' => $cart]);

        return redirect()
            ->route('cart.index')
            ->with('success', 'Items added to cart successfully.');
    }
}

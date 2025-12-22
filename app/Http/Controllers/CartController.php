<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        return view('cart.index', compact('cart'));
    }

    public function add(Item $item)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$item->id])) {
            $cart[$item->id]['quantity']++;
        } else {
            $cart[$item->id] = [
                'name'     => $item->name,
                'price'    => $item->price,
                'quantity' => 1,
                'image'    => $item->image,
            ];
        }

        session()->put('cart', $cart);

        return back()->with('success', 'Item added to cart');
    }

    public function update(Request $request, Item $item)
    {
        $cart = session()->get('cart');

        if (isset($cart[$item->id])) {
            $cart[$item->id]['quantity'] = $request->quantity;
            session()->put('cart', $cart);
        }

        return back();
    }

    public function remove(Item $item)
    {
        $cart = session()->get('cart');

        if (isset($cart[$item->id])) {
            unset($cart[$item->id]);
            session()->put('cart', $cart);
        }

        return back()->with('success', 'Item removed');
    }
}

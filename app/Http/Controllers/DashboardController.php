<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\Category;
use App\Models\Item;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $totalOrders = Order::where('user_id', $user->id)->count();

        $pendingOrders = Order::where('user_id', $user->id)
            ->where('status', 'pending')
            ->count();

        $completedOrders = Order::where('user_id', $user->id)
            ->where('status', 'completed')
            ->count();

        $totalSpent = Order::where('user_id', $user->id)
            ->where('status', 'completed')
            ->sum('total');

        $recentOrders = Order::where('user_id', $user->id)
            ->latest()
            ->take(5)
            ->get();

        // LEFT slider (categories)
        $categories = Category::latest()->get();

        // RIGHT slider (items)
        $items = Item::latest()->take(10)->get();

        return view('dashboard', [
            'totalOrders'     => $totalOrders,
            'pendingOrders'   => $pendingOrders,
            'completedOrders' => $completedOrders,
            'totalSpent'      => $totalSpent,
            'recentOrders'    => $recentOrders,
            'categories'      => $categories,
            'items'           => $items,
        ]);
    }
}

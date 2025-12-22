<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Order;

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

        return view('dashboard', [
            'totalOrders'     => $totalOrders,
            'pendingOrders'   => $pendingOrders,
            'completedOrders' => $completedOrders,
            'totalSpent'      => $totalSpent,
            'recentOrders'    => $recentOrders,
        ]);
    }
}

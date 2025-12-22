<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Order;
use App\Models\Item;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard', [
            'totalUsers'      => User::count(),
            'totalOrders'     => Order::count(),
            'pendingOrders'   => Order::where('status', 'pending')->count(),
            'completedOrders' => Order::where('status', 'completed')->count(),
            'totalRevenue'    => Order::where('status', 'completed')->sum('total'),
            'totalItems'      => Item::count(),
            'recentOrders'    => Order::with('user')->latest()->take(5)->get(),
        ]);
    }
}

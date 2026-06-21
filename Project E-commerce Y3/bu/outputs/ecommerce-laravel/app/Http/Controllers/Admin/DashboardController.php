<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;

class DashboardController extends Controller
{
    public function __invoke()
    {
        $stats = [
            'products' => Product::count(),
            'categories' => Category::count(),
            'orders' => Order::count(),
            'revenue' => Order::sum('total'),
        ];

        $recentOrders = Order::latest()->take(6)->get();
        $lowStockProducts = Product::where('stock', '<=', 5)->orderBy('stock')->take(6)->get();

        return view('admin.dashboard', compact('stats', 'recentOrders', 'lowStockProducts'));
    }
}

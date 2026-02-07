<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Product;
use App\Models\Order;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $userCount = User::count();
        $productCount = Product::count();
        $orderCount = Order::count();
        
       
        $totalRevenue = Order::where('status', 'paid')->sum('total_amount');
        
        
        $latestOrders = Order::latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'userCount',
            'productCount',
            'orderCount',
            'totalRevenue',
            'latestOrders'
        ));
    }
}

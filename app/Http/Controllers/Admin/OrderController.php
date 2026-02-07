<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    
    public function index()
    {
        $orders = Order::latest()->paginate(15);
        return view('admin.orders.index', compact('orders'));
    }

    
    public function show(Order $order)
    {
       
        $order->load('items.product'); 
        return view('admin.orders.show', compact('order'));
    }
    
   
    public function update(Request $request, Order $order)
{
    $request->validate([
        'status' => 'required|string|in:pending_payment,paid,processing,shipped,completed,cancelled',
    ]);

    $order->status = $request->status;
    $order->save();

    return redirect()->route('admin.orders.show', $order->id)->with('success', 'وضعیت سفارش با موفقیت بروزرسانی شد.');
}

}

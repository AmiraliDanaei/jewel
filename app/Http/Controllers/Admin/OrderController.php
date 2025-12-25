<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::latest()->paginate(15);
        return view('admin.orders.index', compact('orders'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        // We use 'with' to eager-load the related items and products
        $order->load('items.product'); 
        return view('admin.orders.show', compact('order'));
    }
    
    // We will implement other methods like edit, update, destroy later
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

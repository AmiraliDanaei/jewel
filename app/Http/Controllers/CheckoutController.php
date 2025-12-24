<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function index()
    {
        if (!session('cart') || count(session('cart')) == 0) {
            return redirect()->route('cart.show')->with('error', 'سبد خرید شما خالی است!');
        }
        return view('checkout.index');
    }

    public function placeOrder(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255', 'email' => 'required|email|max:255',
            'mobile' => 'required|string|max:15', 'province' => 'required|string|max:255',
            'city' => 'required|string|max:255', 'address' => 'required|string',
            'postal_code' => 'required|string|max:20',
        ]);

        $cart = session()->get('cart');
        $totalAmount = 0;
        foreach ($cart as $details) { $totalAmount += $details['price'] * $details['quantity']; }

        DB::beginTransaction();
        try {
            $order = Order::create([
                'user_id' => auth()->id(), 'name' => $validated['name'],
                'email' => $validated['email'], 'mobile' => $validated['mobile'],
                'province' => $validated['province'], 'city' => $validated['city'],
                'address' => $validated['address'], 'postal_code' => $validated['postal_code'],
                'total_amount' => $totalAmount, 'status' => 'pending_payment',
            ]);

            foreach ($cart as $id => $details) {
                OrderItem::create([
                    'order_id' => $order->id, 'product_id' => $id,
                    'quantity' => $details['quantity'], 'price' => $details['price'],
                ]);
            }
            
            DB::commit();
            session()->forget('cart');

            return "سفارش شما با شماره #{$order->id} با موفقیت ثبت و آماده پرداخت است.";

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'خطایی در ثبت سفارش رخ داد: ' . $e->getMessage());
        }
    }
}

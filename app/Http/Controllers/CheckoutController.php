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
    $cart = session()->get('cart');

    if (!$cart || count($cart) == 0) {
        return redirect()->route('cart.show')->with('error', 'سبد خرید شما برای ادامه خالی است!');
    }

    
    $subtotal = 0;
    foreach ($cart as $details) {
        $subtotal += $details['price'] * $details['quantity'];
    }

    $discount = 0;
    if (session()->has('coupon')) {
        $coupon = session()->get('coupon');
        if ($coupon['type'] == 'percent') {
            $discount = ($subtotal * $coupon['value']) / 100;
        } else {
            $discount = $coupon['value'];
        }
    }

    $total = $subtotal - $discount;
    

    return view('checkout.index', compact('subtotal', 'discount', 'total'));
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

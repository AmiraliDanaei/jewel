<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    public function show(Order $order)
    {
        if (auth()->id() !== $order->user_id) {
            abort(404);
        }
        
        
        if ($order->status !== 'pending_payment') {
            return redirect()->route('home')->with('error', 'این سفارش قبلا پردازش شده است.');
        }

        return view('payment.show', compact('order'));
    }

    
    public function success(Order $order)
    {
        
        if (auth()->id() !== $order->user_id) {
            abort(404);
        }

        if ($order->status !== 'pending_payment') {
            return redirect()->route('home')->with('error', 'این سفارش قبلا پردازش شده است.');
        }

        DB::beginTransaction();
        try {
           
            $order->status = 'paid';
            $order->save();

            
            foreach ($order->items as $item) {
                Product::find($item->product_id)->decrement('quantity', $item->quantity);
            }

          
            session()->forget('cart');
            session()->forget('coupon');
            
            DB::commit();

            return redirect()->route('payment.thankyou')->with('success', "پرداخت برای سفارش #{$order->id} با موفقیت انجام شد.");

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('cart.show')->with('error', 'خطایی در پردازش پرداخت رخ داد. لطفا دوباره تلاش کنید.');
        }
    }

   
    public function fail(Order $order)
    {
        
        if (auth()->id() !== $order->user_id) {
            abort(404);
        }
        
        
        return redirect()->route('cart.show')->with('error', "پرداخت برای سفارش #{$order->id} ناموفق بود.");
    }

    
    public function thankyou()
    {
        if (!session('success')) {
            return redirect()->route('home');
        }
        return view('payment.thankyou');
    }
}

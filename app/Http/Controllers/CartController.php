<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    
    public function show()
    {
        return view('cart.index');
    }

    
    public function add(Request $request, Product $product)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        
        if ($product->quantity < $request->quantity) {
            return redirect()->back()->with('error', 'متاسفانه تعداد درخواستی شما بیشتر از موجودی انبار است.');
        }

        $cart = session()->get('cart', []);

        if(isset($cart[$product->id])) {
            
            if ($product->quantity < ($cart[$product->id]['quantity'] + $request->quantity)) {
                return redirect()->back()->with('error', 'امکان افزودن این تعداد به سبد خرید وجود ندارد (موجودی کافی نیست).');
            }
            $cart[$product->id]['quantity'] += $request->quantity;
        } else {
           
            $cart[$product->id] = [
                "name" => $product->name,
                "quantity" => (int) $request->quantity,
                "price" => $product->price,
                "image" => $product->image
            ];
        }

        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'محصول با موفقیت به سبد خرید اضافه شد!');
    }

    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'quantity' => 'required|integer|min:1'
        ]);

        $cart = session()->get('cart');

        
        if(isset($cart[$request->id])) {
            $product = Product::find($request->id);
            
            if ($product->quantity < $request->quantity) {
                return redirect()->back()->with('error', 'متاسفانه تعداد درخواستی شما بیشتر از موجودی انبار است.');
            }
            $cart[$request->id]["quantity"] = $request->quantity;
            session()->put('cart', $cart);
            return redirect()->back()->with('success', 'سبد خرید با موفقیت آپدیت شد.');
        }
        
        return redirect()->back()->with('error', 'مشکلی در آپدیت سبد خرید رخ داد.');
    }

    
    public function remove(Request $request)
    {
        if($request->id) {
            $cart = session()->get('cart');
            if(isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
            return redirect()->back()->with('success', 'محصول از سبد خرید حذف شد.');
        }
        return redirect()->back()->with('error', 'مشکلی در حذف محصول رخ داد.');
    }
}

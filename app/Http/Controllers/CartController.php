<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    
    public function add(Request $request, Product $product)
    {
       
        $request->validate([
            'quantity' => 'required|integer|min=1',
        ]);

        
        $cart = session()->get('cart', []);

        
        if(isset($cart[$product->id])) {
            
            $cart[$product->id]['quantity'] += $request->quantity;
        } else {
           
            $cart[$product->id] = [
                "name" => $product->name,
                "quantity" => $request->quantity,
                "price" => $product->price,
                "image" => $product->image
            ];
        }

        
        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'محصول با موفقیت به سبد خرید اضافه شد!');
    }
}

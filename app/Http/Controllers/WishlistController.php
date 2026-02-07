<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;


class WishlistController extends Controller
{
   
    
    public function index()
    {
        $wishlist = auth()->user()->wishlist()->paginate(10);
        return view('profile.wishlist', compact('wishlist'));
    }

    
    public function toggle(Product $product)
    {
        auth()->user()->wishlist()->toggle($product->id);
        return back()->with('success', 'لیست علاقه‌مندی‌های شما به‌روز شد.');
    }
}

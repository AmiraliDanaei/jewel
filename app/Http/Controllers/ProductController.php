<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    
    public function show(Product $product)
    {
    
    $comments = $product->comments()
                        ->where('is_approved', true)
                        ->whereNull('parent_id')
                        ->with('user', 'replies.user') 
                        ->latest()->get();

    return view('products.show', compact('product', 'comments'));
    }
}

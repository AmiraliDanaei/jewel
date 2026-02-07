<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Comment;


class CommentController extends Controller
{
   
    public function store(Request $request, Product $product)
    {
        $request->validate(['body' => 'required|string']);

        Comment::create([
            'user_id'    => auth()->id(),
            'product_id' => $product->id,
            'parent_id'  => $request->input('parent_id'),
            'body'       => $request->body,
        ]);

        return back()->with('success', 'نظر شما ثبت شد و پس از تایید نمایش داده خواهد شد.');
    }
}

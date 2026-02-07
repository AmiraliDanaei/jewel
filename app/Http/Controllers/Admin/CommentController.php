<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    
    public function index()
    {
        $comments = Comment::with('user', 'product')->latest()->paginate(20);
        return view('admin.comments.index', compact('comments'));
    }

    public function edit(Comment $comment)
    {
        return view('admin.comments.edit', compact('comment'));
    }

    public function update(Request $request, Comment $comment)
    {
        $request->validate(['body' => 'required|string']);
        
        $comment->update([
            'body' => $request->body,
            'is_approved' => $request->has('is_approved'),
        ]);

        return redirect()->route('admin.comments.index')->with('success', 'نظر با موفقیت آپدیت شد.');
    }
    
    public function storeReply(Request $request, Comment $comment)
    {
        $request->validate(['body' => 'required|string']);

        
        Comment::create([
            'user_id'    => auth()->id(), 
            'product_id' => $comment->product_id, 
            'parent_id'  => $comment->id, 
            'body'       => $request->body,
            'is_approved' => true,
        ]);

        return back()->with('success', 'پاسخ شما با موفقیت ثبت شد.');
    }

    
    public function destroy(Comment $comment)
    {
        $comment->delete();
        return redirect()->route('admin.comments.index')->with('success', 'نظر با موفقیت حذف شد.');
    }
}

@extends('admin.layouts.admin')
@section('title', 'ویرایش نظر')
@section('content')
    <h1 class="text-right">ویرایش نظر</h1>
    <div class="card">
        <div class="card-body">
            <p><strong>کاربر:</strong> {{ $comment->user->name }}</p>
            <p><strong>محصول:</strong> {{ $comment->product->name }}</p>
            
            <form action="{{ route('admin.comments.update', $comment->id) }}" method="POST">
                @csrf @method('PUT')
                <div class="form-group">
                    <label for="body">متن نظر</label>
                    <textarea name="body" class="form-control" rows="5">{{ old('body', $comment->body) }}</textarea>
                </div>
                <div class="form-check">
                    <input type="checkbox" name="is_approved" class="form-check-input" id="is_approved" @if($comment->is_approved) checked @endif>
                    <label class="form-check-label" for="is_approved">تایید شده</label>
                </div>
                <button type="submit" class="btn btn-success mt-3">ذخیره تغییرات</button>
            </form>
        </div>
    </div>
    @if(!$comment->parent_id)
        <div class="card mt-4">
            <div class="card-header">
                <h3 class="card-title">ثبت پاسخ</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.comments.reply', $comment->id) }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="reply_body">متن پاسخ</label>
                        <textarea name="body" class="form-control" rows="3" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">ارسال پاسخ</button>
                </form>
            </div>
        </div>
    @endif
@endsection

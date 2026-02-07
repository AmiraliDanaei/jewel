@extends('admin.layouts.admin')
@section('title', 'مدیریت نظرات')
@section('content')
    <h1 class="text-right">مدیریت نظرات</h1>
    {{-- ... (نمایش پیام success/error) ... --}}
    <div class="card">
        <div class="card-body">
            <table class="table table-bordered text-center">
                <thead> ... <th>کاربر</th><th>محصول</th><th>نظر</th><th>وضعیت</th><th>عملیات</th> ... </thead>
                <tbody>
                    @foreach($comments as $comment)
                        <tr class="{{ $comment->parent_id ? 'bg-light' : '' }}">
                            <td>{{ $comment->user->name }}</td>
                            <td><a href="{{ route('products.show', $comment->product_id) }}" target="_blank">{{ $comment->product->name }}</a></td>
                            <td class="text-right">{{ Str::limit($comment->body, 80) }}</td>
                            <td>
                                @if($comment->is_approved)
                                    <span class="badge badge-success">تایید شده</span>
                                @else
                                    <span class="badge badge-warning">در انتظار</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('admin.comments.edit', $comment->id) }}" class="btn btn-sm btn-primary">ویرایش</a>
                                <form action="{{ route('admin.comments.destroy', $comment->id) }}" method="POST" class="d-inline">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="...">حذف</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer">{{ $comments->links() }}</div>
    </div>
@endsection

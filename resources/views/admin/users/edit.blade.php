@extends('admin.layouts.admin')
@section('title', 'ویرایش کاربر')
@section('content')
    <h1 class="text-right">ویرایش کاربر: {{ $user->name }}</h1>
    <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
        @csrf
        @method('PATCH')
        <div class="form-group"><label>نام</label><input type="text" name="name" class="form-control" value="{{ $user->name }}"></div>
        <div class="form-group"><label>ایمیل</label><input type="email" name="email" class="form-control" value="{{ $user->email }}"></div>
        <div class="form-group"><label>نقش</label><select name="role" class="form-control"><option value="user" @selected($user->role == 'user')>کاربر عادی</option><option value="admin" @selected($user->role == 'admin')>مدیر</option></select></div>
        <hr>
        <p>برای تغییر رمز عبور، فیلدهای زیر را پر کنید. در غیر این صورت، خالی بگذارید.</p>
        <div class="form-group"><label>رمز عبور جدید</label><input type="password" name="password" class="form-control"></div>
        <div class="form-group"><label>تکرار رمز عبور جدید</label><input type="password" name="password_confirmation" class="form-control"></div>
        <button type="submit" class="btn btn-success">بروزرسانی</button>
    </form>
@endsection

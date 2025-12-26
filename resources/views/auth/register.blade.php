@extends('layouts.auth_layout')
@section('title', 'ثبت نام')

@section('content')
    <h5 class="text-center mb-4">ایجاد حساب کاربری جدید</h5>

    <form method="POST" action="{{ route('register') }}">
        @csrf
        <!-- Name -->
        <div class="form-group"><input id="name" class="form-control" type="text" name="name" value="{{ old('name') }}" required autofocus placeholder="نام و نام خانوادگی">@error('name')<div class="text-danger mt-2">{{ $message }}</div>@enderror</div>
        <!-- Email Address -->
        <div class="form-group mt-3"><input id="email" class="form-control" type="email" name="email" value="{{ old('email') }}" required placeholder="آدرس ایمیل">@error('email')<div class="text-danger mt-2">{{ $message }}</div>@enderror</div>
        <!-- Password -->
        <div class="form-group mt-3"><input id="password" class="form-control" type="password" name="password" required placeholder="رمز عبور">@error('password')<div class="text-danger mt-2">{{ $message }}</div>@enderror</div>
        <!-- Confirm Password -->
        <div class="form-group mt-3"><input id="password_confirmation" class="form-control" type="password" name="password_confirmation" required placeholder="تکرار رمز عبور">@error('password_confirmation')<div class="text-danger mt-2">{{ $message }}</div>@enderror</div>
        
        <div class="form-group mt-4">
            <button type="submit" class="btn btn-primary btn-block">ثبت نام</button>
        </div>
        <div class="text-center mt-3">
            <a class="text-muted" href="{{ route('login') }}">قبلا ثبت‌نام کرده‌اید؟ ورود</a>
        </div>
    </form>
@endsection

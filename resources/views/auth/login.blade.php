@extends('layouts.auth_layout')

@section('title', 'ورود')

@section('content')
    <h5 class="text-center mb-4">به حساب کاربری خود وارد شوید</h5>

    <form method="POST" action="{{ route('login.send-code') }}">
        @csrf
        <div class="form-group">
            <input id="email" class="form-control" type="email" name="email" value="{{ old('email') }}" required autofocus placeholder="آدرس ایمیل">
            @error('email')<div class="text-danger mt-2 text-right" style="font-size: 0.8rem;">{{ $message }}</div>@enderror
        </div>
        <div class="form-group mt-4">
            <button type="submit" class="btn btn-primary btn-block">ارسال کد ورود</button>
        </div>
        <div class="text-center mt-3">
            <a class="text-muted" href="{{ route('register') }}">حساب کاربری ندارید؟ ثبت نام</a>
        </div>
    </form>
@endsection

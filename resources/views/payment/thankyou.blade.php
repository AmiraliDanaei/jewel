
@extends('layouts.main')

@section('title', 'تشکر از پرداخت شما')

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8 text-center">
                @if(session('success'))
                    <div class="alert alert-success">
                        <h1 class="text-success" style="font-size: 4rem;">✔</h1>
                        <h2>پرداخت شما با موفقیت انجام شد!</h2>
                        <p class="lead mt-3">{{ session('success') }}</p>
                    </div>
                @endif
                
                <div class="card border-0 mt-4">
                    <div class="card-body">
                        <p>سفارش شما در حال پردازش است و به زودی برایتان ارسال خواهد شد. از خرید شما سپاسگزاریم.</p>
                        {{-- لینک به صفحه اصلی و پروفایل سفارش‌ها --}}
                        <a href="{{ route('home') }}" class="btn btn-primary mt-3">بازگشت به صفحه اصلی</a>
                        <a href="{{ route('profile.orders') }}" class="btn btn-outline-secondary mt-3">پیگیری سفارش‌ها</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

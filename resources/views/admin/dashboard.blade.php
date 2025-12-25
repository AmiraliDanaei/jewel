@extends('admin.layouts.admin')

@section('title', 'داشبورد')

@section('content')
    <h1 class="text-right mb-4">داشبورد</h1>

    <!-- Statistics Cards -->
    <div class="row">
        <div class="col-md-3">
            <div class="card text-white bg-primary mb-3">
                <div class="card-header text-right">کاربران</div>
                <div class="card-body text-center">
                    <h3 class="card-title">{{ $userCount }}</h3>
                    <p class="card-text">کاربر ثبت نام شده</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-info mb-3">
                <div class="card-header text-right">محصولات</div>
                <div class="card-body text-center">
                    <h3 class="card-title">{{ $productCount }}</h3>
                    <p class="card-text">محصول ثبت شده</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-success mb-3">
                <div class="card-header text-right">سفارش‌ها</div>
                <div class="card-body text-center">
                    <h3 class="card-title">{{ $orderCount }}</h3>
                    <p class="card-text">سفارش ثبت شده</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-dark mb-3">
                <div class="card-header text-right">درآمد کل</div>
                <div class="card-body text-center">
                    <h3 class="card-title">{{ number_format($totalRevenue) }}</h3>
                    <p class="card-text">تومان (فقط سفارشات پرداخت شده)</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Latest Orders -->
    <div class="card mt-4">
        <div class="card-header text-right">
            <h4>آخرین ۵ سفارش</h4>
        </div>
        <div class="card-body">
            <table class="table table-bordered text-center">
                {{-- Table for latest orders (same as orders.index but without pagination) --}}
            </table>
        </div>
    </div>
@endsection

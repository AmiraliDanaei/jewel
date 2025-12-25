@extends('admin.layouts.admin')

@section('title', 'جزئیات سفارش #' . $order->id)

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>جزئیات سفارش #{{ $order->id }}</h1>
        <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary">بازگشت به لیست سفارش‌ها</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success text-right">
            {{ session('success') }}
        </div>
    @endif

    <div class="row" style="direction: rtl;">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-right">
                    <h4>محصولات این سفارش</h4>
                </div>
                <div class="card-body">
                    <table class="table table-bordered text-center">
                        <thead>
                            <tr>
                                <th>نام محصول</th>
                                <th>تعداد</th>
                                <th>قیمت واحد</th>
                                <th>مجموع</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($order->items as $item)
                                <tr>
                                    <td>{{ $item->product->name ?? 'محصول حذف شده' }}</td>
                                    <td>{{ $item->quantity }}</td>
                                    <td>{{ number_format($item->price) }} تومان</td>
                                    <td>{{ number_format($item->price * $item->quantity) }} تومان</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header text-right">
                    <h4>اطلاعات مشتری و ارسال</h4>
                </div>
                <div class="card-body text-right">
                    <p><strong>مشتری:</strong> {{ $order->name }}</p>
                    <p><strong>ایمیل:</strong> {{ $order->email }}</p>
                    <p><strong>موبایل:</strong> {{ $order->mobile }}</p>
                    <hr>
                    <p>
                        <strong>آدرس ارسال:</strong><br>
                        استان {{ $order->province }}، شهر {{ $order->city }}<br>
                        {{ $order->address }}<br>
                        کد پستی: {{ $order->postal_code }}
                    </p>
                    <hr>
                    <p><strong>مبلغ کل:</strong> <span class="font-weight-bold">{{ number_format($order->total_amount) }} تومان</span></p>
                    <p><strong>وضعیت:</strong> <span class="badge badge-info">@if($order->status == 'pending_payment') در انتظار پرداخت @else {{ $order->status }} @endif</span></p>

                    {{-- =============================================== --}}
                    {{--  THIS IS THE NEW FORM TO UPDATE ORDER STATUS   --}}
                    {{-- =============================================== --}}
                    <hr>
                    <h5 class="mt-4 text-right">تغییر وضعیت سفارش</h5>
                    <form action="{{ route('admin.orders.update', $order->id) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <div class="form-group">
                            <select name="status" class="custom-select text-right">
                                <option value="pending_payment" @selected($order->status == 'pending_payment')>در انتظار پرداخت</option>
                                <option value="paid" @selected($order->status == 'paid')>پرداخت شده</option>
                                <option value="processing" @selected($order->status == 'processing')>در حال پردازش</option>
                                <option value="shipped" @selected($order->status == 'shipped')>ارسال شده</option>
                                <option value="completed" @selected($order->status == 'completed')>تکمیل شده</option>
                                <option value="cancelled" @selected($order->status == 'cancelled')>لغو شده</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">بروزرسانی وضعیت</button>
                    </form>
                    {{-- =============================================== --}}
                </div>
            </div>
        </div>
    </div>
@endsection

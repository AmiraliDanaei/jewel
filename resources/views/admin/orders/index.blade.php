@extends('admin.layouts.admin')

@section('title', 'مدیریت سفارش‌ها')

@section('content')
    <h1 class="text-right">مدیریت سفارش‌ها</h1>

    @if(session('success'))
        <div class="alert alert-success text-right">
            {{ session('success') }}
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <table class="table table-bordered text-center">
                <thead class="thead-light">
                    <tr>
                        <th>شماره سفارش</th>
                        <th>نام مشتری</th>
                        <th>مبلغ کل</th>
                        <th>وضعیت</th>
                        <th>تاریخ ثبت</th>
                        <th>عملیات</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($orders as $order)
                        <tr>
                            <td>#{{ $order->id }}</td>
                            <td>{{ $order->name }}</td>
                            <td>{{ number_format($order->total_amount) }} تومان</td>
                            <td>
                                <span class="badge 
                                    @if($order->status == 'pending_payment') badge-warning
                                    @elseif($order->status == 'paid') badge-success
                                    @else badge-danger @endif">
                                    @if($order->status == 'pending_payment')
                                        در انتظار پرداخت
                                    @elseif($order->status == 'paid')
                                        پرداخت شده
                                    @else
                                        {{ $order->status }}
                                    @endif
                                </span>
                            </td>
                            <td>{{ $order->created_at->format('Y/m/d') }}</td>
                            <td>
                                <a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-sm btn-info">مشاهده جزئیات</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">هیچ سفارشی یافت نشد.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="card-footer d-flex justify-content-center">
            {{ $orders->links() }}
        </div>
    </div>
@endsection

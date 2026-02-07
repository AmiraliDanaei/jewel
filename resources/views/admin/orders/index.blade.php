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
                                @php
                                    $statusConfig = [
                                        'pending_payment' => ['class' => 'badge-warning', 'text' => 'در انتظار پرداخت'],
                                        'paid'              => ['class' => 'badge-success', 'text' => 'پرداخت شده'],
                                        'processing'      => ['class' => 'badge-primary', 'text' => 'در حال پردازش'],
                                        'shipped'           => ['class' => 'badge-info', 'text' => 'ارسال شده'],
                                        'completed'         => ['class' => 'badge-dark', 'text' => 'تکمیل شده'],
                                        'cancelled'         => ['class' => 'badge-danger', 'text' => 'لغو شده'],
                                    ];
                                    $statusClass = $statusConfig[$order->status]['class'] ?? 'badge-secondary';
                                    $statusText = $statusConfig[$order->status]['text'] ?? $order->status;
                                @endphp
                                <span class="badge {{ $statusClass }}" style="font-size: 0.9em; padding: 0.5em 0.8em;">
                                    {{ $statusText }}
                                </span>
                            </td>
                            <td>{{ $order->created_at->format('Y/m/d') }}</td>
                            <td>
                                <a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-sm btn-info">
                                    <i class="fa fa-eye"></i> مشاهده جزئیات
                                </a>
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

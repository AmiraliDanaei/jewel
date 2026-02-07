
@extends('layouts.profile_master_layout')

@section('title', 'سفارش‌های من')

@section('content')

    <h4 class="mb-4 text-right font-weight-bold">سفارش‌های من</h4>

    
    @forelse($orders as $order)
        <div class="card shadow-sm mb-4">
            
            <div class="card-header bg-light p-3 d-flex justify-content-between align-items-center">
                <div class="font-weight-bold">
                    <span>وضعیت: </span>
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
                    <span class="badge {{ $statusClass }}">{{ $statusText }}</span>
                </div>
                <div>
                    <span>تاریخ ثبت: {{ $order->created_at->format('Y/m/d') }}</span>
                </div>
            </div>
            
            
            <div class="card-body">
                @foreach($order->items as $item)
                    <div class="d-flex align-items-center @if(!$loop->last) border-bottom @endif py-3">
                        
                       
                        <a href="{{ route('products.show', $item->product_id) }}">
                            <img src="{{ asset('products/' . ($item->product->image ?? 'default.jpg')) }}" width="80" class="rounded" alt="{{ $item->product->name ?? '' }}">
                        </a>
                        
                        <div class="pr-3 text-right flex-grow-1">
                            
                            <a href="{{ route('products.show', $item->product_id) }}" class="text-dark font-weight-bold">
                              
                                {{ $item->product->name ?? 'محصول حذف شده' }}
                            </a>
                            <div class="text-muted">تعداد: {{ $item->quantity }}</div>
                        </div>
                        
                        <div class="font-weight-bold">
                            {{ number_format($item->price * $item->quantity) }} تومان
                        </div>
                    </div>
                @endforeach
            </div>
            
            
            <div class="card-footer d-flex justify-content-between align-items-center">
                <span class="font-weight-bold">مبلغ کل: {{ number_format($order->total_amount) }} تومان</span>
                <a href="#" class="btn btn-outline-primary btn-sm">پیگیری سفارش</a>
            </div>
        </div>
    @empty
        <div class="text-center p-5 bg-white rounded shadow-sm">
            <p>شما تاکنون هیچ سفارشی ثبت نکرده‌اید.</p>
            <a href="{{ route('home') }}" class="btn btn-primary">شروع خرید</a>
        </div>
    @endforelse

   
    <div class="d-flex justify-content-center mt-4">
        {{ $orders->links() }}
    </div>

@endsection

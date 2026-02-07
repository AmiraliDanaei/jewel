{{-- به جای <x-main-layout>، از @extends استفاده می‌کنیم --}}
@extends('layouts.main')

@section('title', 'پرداخت سفارش #' . $order->id)

@section('content')
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-7 col-lg-6">
                <div class="card shadow-lg" style="border-radius: 15px; border: none;">
                    <div class="card-header bg-dark text-white text-center" style="border-top-left-radius: 15px; border-top-right-radius: 15px;">
                        <h3 class="mb-0">
                            <i class="fa fa-credit-card"></i>
                            درگاه پرداخت شبیه‌سازی شده
                        </h3>
                    </div>
                    <div class="card-body p-4 text-center">
                        <p class="text-muted">شماره سفارش</p>
                        <h2 class="mb-4 font-weight-bold">#{{ $order->id }}</h2>
                        
                        <p class="text-muted">مبلغ قابل پرداخت</p>
                        <h1 class="mb-4" style="color: #333; font-weight: 700;">
                            {{ number_format($order->total_amount) }}
                            <small class="text-muted" style="font-size: 0.6em;">تومان</small>
                        </h1>
                        
                        <hr class="my-4">

                        <p class="mb-4">این یک درگاه پرداخت تستی است. لطفاً نتیجه پرداخت را انتخاب کنید:</p>

                        <div class="d-grid gap-2">
                            
                            <form action="{{ route('payment.success', $order) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-success btn-lg w-100" style="border-radius: 50px; padding: 12px 0; font-weight: bold; box-shadow: 0 4px 15px rgba(40, 167, 69, 0.3);">
                                    <i class="fa fa-check-circle"></i>
                                    پرداخت موفق
                                </button>
                            </form>

                           
                            <a href="{{ route('payment.fail', $order) }}" class="btn btn-danger btn-lg w-100 mt-2" style="border-radius: 50px; padding: 12px 0; font-weight: bold; box-shadow: 0 4px 15px rgba(220, 53, 69, 0.3);">
                                <i class="fa fa-times-circle"></i>
                                 پرداخت ناموفق
                            </a>
                        </div>
                    </div>
                    <div class="card-footer text-muted text-center" style="border-bottom-left-radius: 15px; border-bottom-right-radius: 15px;">
                        <small>
                            <i class="fa fa-lock"></i>
                            این یک محیط امن و تستی است.
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

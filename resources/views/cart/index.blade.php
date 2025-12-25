@extends('layouts.main')

@section('title', 'سبد خرید')

@section('content')
    <!-- Page Header Start -->
    <div class="container-fluid bg-secondary mb-5">
        <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 150px">
            <h1 class="font-weight-semi-bold text-uppercase mb-3">سبد خرید</h1>
            <div class="d-inline-flex">
                <p class="m-0"><a href="{{ route('home') }}">خانه</a></p>
                <p class="m-0 px-2">-</p>
                <p class="m-0">سبد خرید</p>
            </div>
        </div>
    </div>
    <!-- Page Header End -->

    <!-- Cart Start -->
    <div class="container-fluid pt-5">
        <div class="row px-xl-5">
            <div class="col-lg-8 table-responsive mb-5">
                <table class="table table-bordered text-center mb-0">
                    <thead class="bg-secondary text-dark">
                        <tr>
                            <th>محصولات</th>
                            <th>قیمت</th>
                            <th>تعداد</th>
                            <th>مجموع</th>
                            <th>حذف</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle">
                        @php $total = 0 @endphp
                        @if(session('cart') && count(session('cart')) > 0)
                            @foreach(session('cart') as $id => $details)
                                @php $total += $details['price'] * $details['quantity'] @endphp
                                <tr data-id="{{ $id }}">
                                    <td class="align-middle text-left"><a href="{{ route('products.show', $id) }}"><img src="{{ asset('products/' . $details['image']) }}" alt="" style="width: 50px;"> {{ $details['name'] }}</a></td>
                                    <td class="align-middle" data-price="{{ $details['price'] }}">{{ number_format($details['price']) }} تومان</td>
                                    <td class="align-middle">
                                        <div class="input-group quantity mx-auto" style="width: 100px;">
                                            {{-- Quantity buttons and input --}}
                                        </div>
                                    </td>
                                    <td class="align-middle item-total">{{ number_format($details['price'] * $details['quantity']) }} تومان</td>
                                    <td class="align-middle"><button class="btn btn-sm btn-danger btn-remove"><i class="fa fa-times"></i></button></td>
                                </tr>
                            @endforeach
                        @else
                            <tr><td colspan="5" class="text-center">سبد خرید شما خالی است!</td></tr>
                        @endif
                    </tbody>
                </table>
            </div>
            <div class="col-lg-4">
              
                <form class="mb-5" action="{{ route('cart.apply-coupon') }}" method="POST">
                    @csrf
                    <div class="input-group">
                        <input type="text" name="coupon_code" class="form-control p-4 text-right" placeholder="کد تخفیف">
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-primary">اعمال</button>
                        </div>
                    </div>
                </form>
                <div class="card border-secondary mb-5">
                    <div class="card-header bg-secondary border-0">
                        <h4 class="font-weight-semi-bold m-0 text-right">خلاصه سبد خرید</h4>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-3 pt-1">
                            <h6 class="font-weight-medium">جمع محصولات</h6>
                            <h6 class="font-weight-medium">{{ number_format($total) }} تومان</h6>
                        </div>
                        @if(session()->has('coupon'))
                            <div class="d-flex justify-content-between">
                                <h6 class="font-weight-medium text-success">تخفیف ({{ session('coupon')['code'] }})</h6>
                                @php
                                    $discount = 0;
                                    if(session('coupon')['type'] == 'percent') {
                                        $discount = ($total * session('coupon')['value']) / 100;
                                    } else {
                                        $discount = session('coupon')['value'];
                                    }
                                @endphp
                                <h6 class="font-weight-medium text-success">-{{ number_format($discount) }} تومان</h6>
                            </div>
                        @endif
                    </div>
                    <div class="card-footer border-secondary bg-transparent">
                        <div class="d-flex justify-content-between mt-2">
                            <h5 class="font-weight-bold">مبلغ نهایی</h5>
                            @php
                                $finalTotal = $total;
                                if(session()->has('coupon')) { $finalTotal -= $discount; }
                            @endphp
                            <h5 class="font-weight-bold">{{ number_format($finalTotal > 0 ? $finalTotal : 0) }} تومان</h5>
                        </div>
                        <a href="{{ route('checkout.index') }}" class="btn btn-block btn-primary my-3 py-3">ادامه و تکمیل خرید</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Cart End -->
@endsection

@section('scripts')
    {{-- Your AJAX scripts for quantity update go here --}}
@endsection

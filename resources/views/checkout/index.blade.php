@extends('layouts.main')

@section('title', 'تکمیل خرید')

@section('content')

    <!-- Page Header Start -->
    <div class="container-fluid bg-secondary mb-5">
        <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 150px;">
            <h1 class="font-weight-semi-bold text-uppercase mb-3">تکمیل خرید</h1>
            <div class="d-inline-flex">
                <p class="m-0"><a href="{{ route('home') }}">خانه</a></p>
                <p class="m-0 px-2">-</p>
                <p class="m-0">تکمیل خرید</p>
            </div>
        </div>
    </div>
    <!-- Page Header End -->

    <!-- Checkout Start -->
    <div class="container-fluid pt-5">
        <form class="row px-xl-5" action="{{ route('checkout.placeOrder') }}" method="POST">
            @csrf
            <div class="col-lg-8">
                <div class="mb-4 p-4" style="background-color: #F5F5F5; direction: rtl;">
                    <h4 class="font-weight-semi-bold mb-4 text-right">آدرس ارسال و صورتحساب</h4>
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label class="text-right d-block">نام و نام خانوادگی</label>
                            <input class="form-control text-right" type="text" name="name" value="{{ auth()->user()->name }}" required>
                        </div>
                        <div class="col-md-6 form-group">
                            <label class="text-right d-block">ایمیل</label>
                            <input class="form-control text-right" type="email" name="email" value="{{ auth()->user()->email }}" required>
                        </div>
                        <div class="col-md-6 form-group">
                            <label class="text-right d-block">شماره موبایل</label>
                            <input class="form-control text-right" type="text" name="mobile" placeholder="...۰۹" required>
                        </div>
                        <div class="col-md-6 form-group">
                            <label class="text-right d-block">استان</label>
                            <select class="custom-select text-right" name="province" required>
                                <option value="" selected disabled>یک استان را انتخاب کنید</option>
                                <option value="آذربایجان شرقی">آذربایجان شرقی</option>
                                <option value="آذربایجان غربی">آذربایجان غربی</option>
                                <option value="اردبیل">اردبیل</option>
                                <option value="اصفهان">اصفهان</option>
                                <option value="البرز">البرز</option>
                                <option value="ایلام">ایلام</option>
                                <option value="بوشهر">بوشهر</option>
                                <option value="تهران">تهران</option>
                                <option value="چهارمحال و بختیاری">چهارمحال و بختیاری</option>
                                <option value="خراسان جنوبی">خراسان جنوبی</option>
                                <option value="خراسان رضوی">خراسان رضوی</option>
                                <option value="خراسان شمالی">خراسان شمالی</option>
                                <option value="خوزستان">خوزستان</option>
                                <option value="زنجان">زنجان</option>
                                <option value="سمنان">سمنان</option>
                                <option value="سیستان و بلوچستان">سیستان و بلوچستان</option>
                                <option value="فارس">فارس</option>
                                <option value="قزوین">قزوین</option>
                                <option value="قم">قم</option>
                                <option value="کردستان">کردستان</option>
                                <option value="کرمان">کرمان</option>
                                <option value="کرمانشاه">کرمانشاه</option>
                                <option value="کهگیلویه و بویراحمد">کهگیلویه و بویراحمد</option>
                                <option value="گلستان">گلستان</option>
                                <option value="گیلان">گیلان</option>
                                <option value="لرستان">لرستان</option>
                                <option value="مازندران">مازندران</option>
                                <option value="مرکزی">مرکزی</option>
                                <option value="هرمزگان">هرمزگان</option>
                                <option value="همدان">همدان</option>
                                <option value="یزد">یزد</option>
                            </select>
                        </div>
                        <div class="col-md-6 form-group">
                            <label class="text-right d-block">شهر</label>
                            <input class="form-control text-right" type="text" name="city" placeholder="نام شهر" required>
                        </div>
                        <div class="col-md-6 form-group">
                            <label class="text-right d-block">کد پستی</label>
                            <input class="form-control text-right" type="text" name="postal_code" placeholder="بدون خط تیره" required>
                        </div>
                        <div class="col-md-12 form-group">
                            <label class="text-right d-block">آدرس کامل</label>
                            <textarea class="form-control text-right" rows="4" name="address" placeholder="خیابان، کوچه، پلاک، واحد..." required></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card border-secondary mb-5">
                    <div class="card-header bg-secondary border-0">
                        <h4 class="font-weight-semi-bold m-0 text-right">خلاصه سفارش</h4>
                    </div>
                    <div class="card-body">
                        <h5 class="font-weight-medium mb-3 text-right">محصولات</h5>
                        @foreach((array) session('cart') as $id => $details)
                            <div class="d-flex justify-content-between">
                                <p>{{ $details['name'] }} (x{{ $details['quantity'] }})</p>
                                <p>{{ number_format($details['price'] * $details['quantity']) }} تومان</p>
                            </div>
                        @endforeach
                        <hr class="mt-0">
                        <div class="d-flex justify-content-between mb-3 pt-1">
                            <h6 class="font-weight-medium">جمع محصولات</h6>
                            <h6 class="font-weight-medium">{{ number_format($subtotal) }} تومان</h6>
                        </div>
                        @if(session()->has('coupon'))
                            <div class="d-flex justify-content-between">
                                <h6 class="font-weight-medium text-success">تخفیف</h6>
                                <h6 class="font-weight-medium text-success">-{{ number_format($discount) }} تومان</h6>
                            </div>
                        @endif
                    </div>
                    <div class="card-footer border-secondary bg-transparent">
                        <div class="d-flex justify-content-between mt-2">
                            <h5 class="font-weight-bold">مبلغ نهایی</h5>
                            <h5 class="font-weight-bold">{{ number_format($total > 0 ? $total : 0) }} تومان</h5>
                        </div>
                    </div>
                </div>
                <div class="card border-secondary mb-5">
                    <div class="card-header bg-secondary border-0">
                        <h4 class="font-weight-semi-bold m-0 text-right">پرداخت</h4>
                    </div>
                    <div class="card-footer border-secondary bg-transparent">
                        <button type="submit" class="btn btn-lg btn-block btn-primary font-weight-bold my-3 py-3">ثبت سفارش و پرداخت</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <!-- Checkout End -->
@endsection

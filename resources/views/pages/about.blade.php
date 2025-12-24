@extends('layouts.main')

@section('title', 'درباره ما')

@section('content')
    <!-- Page Header Start -->
    <div class="container-fluid bg-secondary mb-5">
        <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
            <h1 class="font-weight-semi-bold text-uppercase mb-3">درباره ما</h1>
            <div class="d-inline-flex">
                <p class="m-0"><a href="{{ route('home') }}">خانه</a></p>
                <p class="m-0 px-2">-</p>
                <p class="m-0">درباره ما</p>
            </div>
        </div>
    </div>
    <!-- Page Header End -->

    <!-- About Us Content Start -->
    <div class="container-fluid py-5" style="direction: rtl;">
        <div class="row px-xl-5">
            <div class="col-lg-8 mx-auto text-right">
                <h2 class="section-title px-5 mb-4 text-center"><span class="px-2">داستان فروشگاه ما</span></h2>
                <p class="mb-4" style="line-height: 2.2;">
                    فروشگاه ما فعالیت خود را از دو سال پیش در قلب تهران، با هدف ارائه جدیدترین و باکیفیت‌ترین محصولات مد و پوشاک آغاز کرد. ما باور داریم که خرید، فقط یک معامله نیست، بلکه یک تجربه لذت‌بخش است. به همین دلیل، تمام تلاش خود را به کار گرفته‌ایم تا با گردآوری بهترین‌ها و ارائه خدمات پشتیبانی بی‌نظیر، این تجربه را برای شما به یادماندنی کنیم. 
                </p>
                <p class="mb-4" style="line-height: 2.2;">
                    تیم ما متشکل از افراد جوان و علاقه‌مند به دنیای مد است که همواره در تلاشند تا جدیدترین ترندهای جهانی را با بهترین کیفیت و قیمت مناسب در اختیار شما عزیزان قرار دهند.
                </p>
                <hr>
                <h4 class="font-weight-semi-bold mt-5 mb-3 text-center">تماس با ما</h4>
                <div class="text-center">
                    <p><strong>آدرس:</strong> تهران، میدان تجریش، خیابان سعدآباد، مجموعه فرهنگی تاریخی سعدآباد</p>
                    <p><strong>شماره تماس:</strong> ۰۲۱-۹۱۰۹۸۷۶۵</p>
                </div>
            </div>
        </div>
    </div>
    <!-- About Us Content End -->
@endsection

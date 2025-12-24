@extends('layouts.main')
@section('title', 'سوالات متداول')
@section('content')
    <div class="container-fluid bg-secondary mb-5">
        <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
            <h1 class="font-weight-semi-bold text-uppercase mb-3">سوالات متداول</h1>
        </div>
    </div>
    <div class="container py-5 text-right" style="direction: rtl;">
        <div class="accordion" id="faqAccordion">
            <div class="card">
                <div class="card-header" id="headingOne">
                    <h2 class="mb-0">
                        <button class="btn btn-link btn-block text-right" type="button" data-toggle="collapse" data-target="#collapseOne">
                            چگونه می‌توانم سفارش خود را ثبت کنم؟
                        </button>
                    </h2>
                </div>
                <div id="collapseOne" class="collapse show" data-parent="#faqAccordion">
                    <div class="card-body">
                        برای ثبت سفارش، پس از انتخاب محصولات مورد نظر و افزودن آنها به سبد خرید، به صفحه تکمیل خرید رفته و اطلاعات خود را وارد نمایید. سپس با انتخاب روش پرداخت، سفارش خود را نهایی کنید.
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header" id="headingTwo">
                    <h2 class="mb-0">
                        <button class="btn btn-link btn-block text-right collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo">
                            روش‌های ارسال کالا چگونه است؟
                        </button>
                    </h2>
                </div>
                <div id="collapseTwo" class="collapse" data-parent="#faqAccordion">
                    <div class="card-body">
                        ارسال سفارشات در تهران از طریق پیک و برای سایر شهرستان‌ها از طریق پست پیشتاز انجام می‌شود. هزینه ارسال بر اساس آدرس شما محاسبه خواهد شد.
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

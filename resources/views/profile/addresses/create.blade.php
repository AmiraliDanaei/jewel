@extends('profile.layouts.profile')

@section('title', 'افزودن آدرس جدید')

@section('profile-content')

{{-- استایل‌های سفارشی برای بهبود ظاهر فرم --}}
<style>
    .custom-form-input {
        /* تغییر رنگ پس‌زمینه برای خوانایی بهتر */
        background-color: #f7f9fc !important;
        border: 1px solid #dfe6e9 !important;
        /* افزودن سایه ملایم هنگام انتخاب (فوکوس) */
        transition: box-shadow 0.2s ease-in-out;
    }
    .custom-form-input:focus {
        box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
        border-color: #b2bec3 !important;
    }
</style>

{{-- استفاده از dir="rtl" برای اطمینان از راست‌چین بودن کامل --}}
<div dir="rtl">
    <h4 class="mb-4 text-right">افزودن آدرس جدید</h4>

    <form action="{{ route('addresses.store') }}" method="POST">
        @csrf
        <div class="row">

            {{-- 
                نکته مهم برای راست‌چین:
                برای اینکه ستون‌ها در حالت راست‌چین به درستی نمایش داده شوند (استان در سمت راست و شهر در چپ),
                باید در کد HTML، ستون "شهر" را قبل از ستون "استان" قرار دهیم.
            --}}

            <!-- ستون شهر -->
            <div class="col-md-6 form-group">
                <label for="city" class="d-block text-right">شهر</label>
                <input id="city" class="form-control text-right custom-form-input" type="text" name="city" required>
            </div>

            <!-- ستون استان -->
            <div class="col-md-6 form-group">
                <label for="province" class="d-block text-right">استان</label>
                <select id="province" class="custom-select text-right custom-form-input" name="province" required>
                    <option value="" disabled selected>استان خود را انتخاب کنید...</option>
                    @foreach ($provinces as $province)
                        <option value="{{ $province }}">{{ $province }}</option>
                    @endforeach
                </select>
            </div>

            <!-- آدرس کامل -->
            <div class="col-md-12 form-group">
                <label for="address" class="d-block text-right">آدرس کامل</label>
                <textarea id="address" class="form-control text-right custom-form-input" rows="3" name="address" required></textarea>
            </div>

            <!-- کد پستی -->
            <div class="col-md-6 form-group">
                <label for="postal_code" class="d-block text-right">کد پستی</label>
                <input id="postal_code" class="form-control text-right custom-form-input" type="text" name="postal_code" required>
            </div>
        </div>

        <div class="mt-3">
            <button type="submit" class="btn btn-success shadow-sm">ذخیره آدرس</button>
            <a href="{{ route('addresses.index') }}" class="btn btn-secondary">انصراف</a>
        </div>
    </form>
</div>
@endsection

@extends('admin.layouts.admin')
@section('title', 'ویرایش کوپن')
@section('content')
    <h1 class="text-right">ویرایش کوپن: {{ $coupon->code }}</h1>
     <div class="card">
        <div class="card-body" style="direction: rtl;">
            <form action="{{ route('admin.coupons.update', $coupon->id) }}" method="POST">
                @csrf
                @method('PATCH')
                <div class="form-group text-right">
                    <label for="code">کد تخفیف</label>
                    <input type="text" name="code" id="code" class="form-control" value="{{ old('code', $coupon->code) }}" required>
                </div>
                <div class="form-group text-right">
                    <label for="type">نوع</label>
                    <select name="type" id="type" class="custom-select">
                        <option value="fixed" @selected(old('type', $coupon->type) == 'fixed')>مبلغ ثابت (به تومان)</option>
                        <option value="percent" @selected(old('type', $coupon->type) == 'percent')>درصد</option>
                    </select>
                </div>
                <div class="form-group text-right">
                    <label for="value">مقدار</label>
                    <input type="number" name="value" id="value" class="form-control" value="{{ old('value', $coupon->value) }}" required min="0">
                </div>
                <div class="form-group text-right">
                    <label for="expires_at">تاریخ انقضا (اختیاری)</label>
                    <input type="date" name="expires_at" id="expires_at" class="form-control" value="{{ old('expires_at', $coupon->expires_at) }}">
                </div>
                <button type="submit" class="btn btn-success">بروزرسانی کوپن</button>
                 <a href="{{ route('admin.coupons.index') }}" class="btn btn-secondary">انصراف</a>
            </form>
        </div>
    </div>
@endsection

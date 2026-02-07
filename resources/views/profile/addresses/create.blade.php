@extends('layouts.main')

@section('title', 'افزودن آدرس جدید')

@section('content')
<div class="container py-5">
    <div class="row">

        {{-- ستون منوی کناری (Sidebar) --}}
        <div class="col-md-3">
            @include('profile.partials.sidebar')
        </div>

        {{-- ستون محتوای اصلی --}}
        <div class="col-md-9">
            <div class="card shadow-sm">
                <div class="card-header">
                    <h4 class="mb-0 text-right font-weight-bold">افزودن آدرس جدید</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('addresses.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label>استان</label>
                                <select name="province" class="form-control" required>
                                    <option value="">انتخاب کنید...</option>
                                    @foreach($provinces as $province)
                                        <option value="{{ $province }}" {{ old('province') == $province ? 'selected' : '' }}>{{ $province }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 form-group">
                                <label>شهر</label>
                                <input name="city" class="form-control" value="{{ old('city') }}" type="text" placeholder="مثال: تهران" required>
                            </div>
                            <div class="col-md-12 form-group">
                                <label>کد پستی</label>
                                <input name="postal_code" class="form-control" value="{{ old('postal_code') }}" type="text" placeholder="کد پستی ۱۰ رقمی" required>
                            </div>
                            <div class="col-md-12 form-group">
                                <label>آدرس کامل</label>
                                <textarea name="address" class="form-control" rows="3" required>{{ old('address') }}</textarea>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">ذخیره آدرس</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

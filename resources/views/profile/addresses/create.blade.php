@extends('profile.layouts.profile')
@section('title', 'افزودن آدرس جدید')

@section('profile-content')
    <h4 class="mb-4 text-right">افزودن آدرس جدید</h4>
    <form action="{{ route('addresses.store') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-md-6 form-group">
                <label>استان</label>
                <select class="custom-select text-right" name="province" required>
                    {{-- Province list --}}
                </select>
            </div>
            <div class="col-md-6 form-group">
                <label>شهر</label>
                <input class="form-control text-right" type="text" name="city" required>
            </div>
            <div class="col-md-12 form-group">
                <label>آدرس کامل</label>
                <textarea class="form-control text-right" rows="3" name="address" required></textarea>
            </div>
            <div class="col-md-6 form-group">
                <label>کد پستی</label>
                <input class="form-control text-right" type="text" name="postal_code" required>
            </div>
        </div>
        <button type="submit" class="btn btn-success">ذخیره آدرس</button>
        <a href="{{ route('addresses.index') }}" class="btn btn-secondary">انصراف</a>
    </form>
@endsection

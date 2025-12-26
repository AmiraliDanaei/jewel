@extends('profile.layouts.profile')
@section('title', 'آدرس‌های من')

@section('profile-content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="text-right font-weight-bold">آدرس‌های من</h4>
        <a href="{{ route('addresses.create') }}" class="btn btn-primary">افزودن آدرس جدید</a>
    </div>

    @if($addresses->count() > 0)
        @foreach($addresses as $address)
            <div class="card mb-3">
                <div class="card-body text-right">
                    <p><strong>استان:</strong> {{ $address->province }}</p>
                    <p><strong>شهر:</strong> {{ $address->city }}</p>
                    <p><strong>آدرس:</strong> {{ $address->address }}</p>
                    <p><strong>کد پستی:</strong> {{ $address->postal_code }}</p>
                    <hr>
                    {{-- Edit/Delete buttons will go here --}}
                </div>
            </div>
        @endforeach
    @else
        <p class="text-center">شما هنوز هیچ آدرسی ثبت نکرده‌اید.</p>
    @endif
@endsection

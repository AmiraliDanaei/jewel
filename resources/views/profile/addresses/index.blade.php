@extends('layouts.main')

@section('title', 'آدرس‌های من')

@section('content')
<div class="container py-5">
    <div class="row">
        
        {{-- ستون منوی کناری (Sidebar) --}}
        <div class="col-md-3">
            @include('profile.partials.sidebar')
        </div>

        {{-- ستون محتوای اصلی --}}
        <div class="col-md-9">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h4 class="font-weight-bold text-right m-0">آدرس‌های من</h4>
                <a href="{{ route('addresses.create') }}" class="btn btn-primary">
                    <i class="fa fa-plus"></i> افزودن آدرس جدید
                </a>
            </div>

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <div class="card shadow-sm">
                <div class="card-body">
                    @forelse($addresses as $address)
                        <div class="p-3 @if(!$loop->last) border-bottom @endif">
                            <p class="mb-1"><strong>استان:</strong> {{ $address->province }}</p>
                            <p class="mb-1"><strong>شهر:</strong> {{ $address->city }}</p>
                            <p class="mb-1"><strong>آدرس کامل:</strong> {{ $address->address }}</p>
                            <p class="mb-0"><strong>کد پستی:</strong> {{ $address->postal_code }}</p>
                        </div>
                    @empty
                        <div class="text-center p-4">
                            <p>شما هنوز هیچ آدرسی ثبت نکرده‌اید.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

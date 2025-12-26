@extends('layouts.profile_master_layout') {{-- <-- IMPORTANT: Extends the NEW master layout --}}

@section('content')
<div class="container">
    <div class="row">
        <!-- Profile Sidebar -->
        <div class="col-lg-3">
            <div class="list-group text-right shadow-sm">
                <a href="{{ route('profile.edit') }}" class="list-group-item list-group-item-action {{ request()->routeIs('profile.edit') ? 'active' : '' }}">
                    <i class="fa fa-user ml-2"></i>اطلاعات حساب
                </a>
                <a href="{{ route('profile.orders') }}" class="list-group-item list-group-item-action {{ request()->routeIs('profile.orders*') ? 'active' : '' }}">
                    <i class="fa fa-box-open ml-2"></i>سفارش‌های من
                </a>
                <a href="{{ route('addresses.index') }}" class="list-group-item list-group-item-action {{ request()->routeIs('addresses*') ? 'active' : '' }}">
                    <i class="fa fa-map-marker-alt ml-2"></i>آدرس‌ها
                </a>
                <a href="#" class="list-group-item list-group-item-action disabled">
                    <i class="fa fa-heart ml-2"></i>لیست علاقه‌مندی‌ها
                </a>
                <a href="#" class="list-group-item list-group-item-action text-danger" 
                   onclick="event.preventDefault(); document.getElementById('logout-form-profile').submit();">
                    <i class="fa fa-sign-out-alt ml-2"></i>خروج
                </a>
                <form id="logout-form-profile" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
            </div>
        </div>
        <!-- Profile Content -->
        <div class="col-lg-9">
            @if(session('success'))
                <div class="alert alert-success text-right">{{ session('success') }}</div>
            @endif
            <div class="card shadow-sm">
                <div class="card-body p-4">
                    @yield('profile-content')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .list-group-item.active {
        background-color: #D19C97 !important;
        border-color: #D19C97 !important;
        color: white;
    }
</style>
@endpush

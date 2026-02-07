<div class="card shadow-sm">
    <div class="card-header">منوی کاربری</div>
    <div class="list-group list-group-flush">
        {{-- لینک اطلاعات حساب --}}
        <a href="{{ route('profile.edit') }}" 
           class="list-group-item list-group-item-action {{ request()->routeIs('profile.edit') ? 'active' : '' }}">
           <i class="fas fa-user fa-fw ml-2"></i>اطلاعات حساب
        </a>
        
        {{-- لینک سفارش‌های من --}}
        <a href="{{ route('profile.orders') }}" 
           class="list-group-item list-group-item-action {{ request()->routeIs('profile.orders') ? 'active' : '' }}">
           <i class="fas fa-box-open fa-fw ml-2"></i>سفارش‌های من
        </a>

        {{-- لینک لیست علاقه‌مندی‌ها --}}
        <a href="{{ route('profile.wishlist') }}" 
           class="list-group-item list-group-item-action {{ request()->routeIs('profile.wishlist') ? 'active' : '' }}">
           <i class="fas fa-heart fa-fw ml-2"></i>لیست علاقه‌مندی‌ها
        </a>
        
        {{-- لینک آدرس‌های من --}}
        <a href="{{ route('addresses.index') }}" 
           class="list-group-item list-group-item-action {{ request()->routeIs('addresses.index') || request()->routeIs('addresses.create') ? 'active' : '' }}">
           <i class="fas fa-map-marker-alt fa-fw ml-2"></i>آدرس‌های من
        </a>
    </div>
</div>

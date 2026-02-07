<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - پنل کاربری</title>
    
    
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-v4-rtl@4.5.3-1/dist/css/bootstrap-rtl.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    
   
    <link href="https://cdn.jsdelivr.net/gh/rastikerdar/vazirmatn@v33.003/Vazirmatn-font-face.css" rel="stylesheet" type="text/css" />
    <style>
        body {
            font-family: 'Vazirmatn', sans-serif !important;
            background-color: #f8f9fa;
        }
    </style>
    @stack('styles')
</head>
<body>

    
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">
                <h4 class="font-weight-bold m-0"><span class="text-primary">E</span>Shopper</h4>
            </a>
            <div class="navbar-nav ml-auto">
                 <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">{{ Auth::user()->name }}</a>
                    <div class="dropdown-menu dropdown-menu-right">
                        @if(Auth::user()->role === 'admin')
                            <a href="{{ route('admin.dashboard') }}" class="dropdown-item text-right">پنل مدیریت</a>
                            <div class="dropdown-divider"></div>
                        @endif
                        <a href="#" class="dropdown-item text-right" onclick="event.preventDefault(); document.getElementById('logout-form-main').submit();">خروج</a>
                        <form id="logout-form-main" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
                    </div>
                </div>
            </div>
        </div>
    </nav>
    
   
    <main class="py-5">
        <div class="container">
            <div class="row">
                
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-header">منوی کاربری</div>
                        <div class="list-group list-group-flush">
                            <a href="{{ route('profile.edit') }}" class="list-group-item list-group-item-action {{ request()->routeIs('profile.edit') ? 'active' : '' }}">
                                <i class="fas fa-user fa-fw ml-2"></i>اطلاعات حساب
                            </a>
                            <a href="{{ route('profile.orders') }}" class="list-group-item list-group-item-action {{ request()->routeIs('profile.orders') ? 'active' : '' }}">
                                <i class="fas fa-box-open fa-fw ml-2"></i>سفارش‌های من
                            </a>
                            <a href="{{ route('addresses.index') }}" class="list-group-item list-group-item-action {{ request()->routeIs('addresses.index') ? 'active' : '' }}">
                                <i class="fas fa-map-marker-alt fa-fw ml-2"></i>آدرس‌های من
                            </a>
                            
                            
                            <a href="{{ route('profile.wishlist') }}" class="list-group-item list-group-item-action {{ request()->routeIs('profile.wishlist') ? 'active' : '' }}">
                                <i class="fas fa-heart fa-fw ml-2"></i>لیست علاقه‌مندی‌ها
                            </a>
                            
                            
                        </div>
                    </div>
                </div>
                
                <div class="col-md-9">
                    @yield('content')
                </div>
            </div>
        </div>
    </main>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>
    @yield('scripts')

</body>
</html>

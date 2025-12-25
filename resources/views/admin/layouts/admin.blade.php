<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - پنل مدیریت</title>
    
    <!-- Bootstrap RTL -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-v4-rtl@4.5.3-1/dist/css/bootstrap-rtl.min.css">
    
    <!-- Persian Font -->
    <link href="https://cdn.jsdelivr.net/gh/rastikerdar/vazirmatn@v33.003/Vazirmatn-font-face.css" rel="stylesheet" type="text/css" />

    <style>
        body { font-family: 'Vazirmatn', sans-serif; }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('admin.dashboard') }}">پنل مدیریت فروشگاه</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#admin-navbar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="admin-navbar">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.dashboard') }}">داشبورد</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.users.index') }}">مدیریت کاربران</a>
                </li>
                 <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.categories.index') }}">مدیریت دسته‌بندی‌ها</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.products.index') }}">مدیریت محصولات</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.orders.index') }}">مدیریت سفارش‌ها</a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.coupons.index') }}">مدیریت کوپن‌ها</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<main class="container mt-4">
    @yield('content')
</main>

<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>
@yield('scripts')

</body>
</html>

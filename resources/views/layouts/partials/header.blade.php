<!-- Topbar Start -->
<div class="container-fluid">
    <div class="row bg-secondary py-2 px-xl-5">
        <div class="col-lg-6 text-center text-lg-right">
            <div class="d-inline-flex align-items-center">
                <a class="text-dark px-2" href="{{ route('pages.faq') }}">سوالات متداول</a>
                <span class="text-muted px-2">|</span>
                <a class="text-dark px-2" href="{{ route('about') }}">راهنما</a>
                <span class="text-muted px-2">|</span>
                <a class="text-dark px-2" href="{{ route('about') }}#contact">پشتیبانی</a>
            </div>
        </div>
        <div class="col-lg-6 d-none d-lg-block text-lg-left">
        </div>
    </div>
    <div class="row align-items-center py-3 px-xl-5">
        <div class="col-lg-3 d-none d-lg-block">
            <a href="/" class="text-decoration-none">
                <h1 class="m-0 display-5 font-weight-semi-bold"><span class="text-primary font-weight-bold border px-3 ml-1">E</span>فروشگاه</h1>
            </a>
        </div>
        <div class="col-lg-6 col-6 text-right">
            <form action="">
                <div class="input-group">
                    <input type="text" class="form-control text-right" placeholder="جستجو برای محصولات">
                    <div class="input-group-append">
                        <span class="input-group-text bg-transparent text-primary"><i class="fa fa-search"></i></span>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-lg-3 col-6 text-left">
            <a href="{{ route('profile.wishlist') }}" class="btn border">
                <i class="fas fa-heart text-primary"></i>
                <span class="badge">{{ $wishlistCount ?? 0 }}</span>
            </a>
            <a href="{{ route('cart.show') }}" class="btn border ml-2">
                <i class="fas fa-shopping-cart text-primary"></i>
                <span class="badge">{{ count((array) session('cart')) }}</span>
            </a>
        </div>
    </div>
</div>
<!-- Topbar End -->


<!-- Navbar Start -->
<div class="container-fluid">
    <div class="row border-top px-xl-5">
        <div class="col-lg-3 d-none d-lg-block">
            <a class="btn shadow-none d-flex align-items-center justify-content-between bg-primary text-white w-100" data-toggle="collapse" href="#navbar-vertical" style="height: 65px; margin-top: -1px; padding: 0 30px;">
                <h6 class="m-0">دسته‌بندی‌ها</h6>
                <i class="fa fa-angle-down text-dark"></i>
            </a>
            <nav class="collapse {{ Request::is('/') ? 'show' : '' }} navbar navbar-vertical navbar-light align-items-start p-0 border border-top-0 border-bottom-0" id="navbar-vertical">
                <div class="navbar-nav w-100 overflow-hidden" style="height: 410px">
                    @if(isset($categories))
                        @foreach($categories as $category)
                            <a href="{{ route('category.products', $category->id) }}" class="nav-item nav-link">{{ $category->name }}</a>
                        @endforeach
                    @endif
                </div>
            </nav>
        </div>
        <div class="col-lg-9">
            <nav class="navbar navbar-expand-lg bg-light navbar-light py-3 py-lg-0 px-0">
                <a href="" class="text-decoration-none d-block d-lg-none">
                    <h1 class="m-0 display-5 font-weight-semi-bold"><span class="text-primary font-weight-bold border px-3 mr-1">E</span>فروشگاه</h1>
                </a>
                <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                    <div class="navbar-nav mr-auto py-0">
                        <a href="{{ route('home') }}" class="nav-item nav-link active">خانه</a>
                        <a href="#" class="nav-item nav-link">فروشگاه</a>
                        <a href="{{ route('about') }}" class="nav-item nav-link">تماس با ما</a>
                    </div>
                    <div class="navbar-nav ml-auto py-0">
                        {{-- ↓↓↓↓↓↓ بخش ورود/خروج و منوی کاربر (نسخه کامل و صحیح) ↓↓↓↓↓↓ --}}
                        @guest
                            <a href="{{ route('login') }}" class="nav-item nav-link">ورود</a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="nav-item nav-link">ثبت نام</a>
                            @endif
                        @else
                            <div class="nav-item dropdown">
                                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">{{ Auth::user()->name }}</a>
                                <div class="dropdown-menu rounded-0 m-0 dropdown-menu-right">
                                    <a href="{{ route('profile.edit') }}" class="dropdown-item">پروفایل من</a>
                                    <a href="{{ route('profile.orders') }}" class="dropdown-item">سفارش‌های من</a>
                                    <a href="{{ route('profile.wishlist') }}" class="dropdown-item">لیست علاقه‌مندی‌ها</a>
                                    <div class="dropdown-divider"></div>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <a href="{{ route('logout') }}" class="dropdown-item" onclick="event.preventDefault(); this.closest('form').submit();">خروج</a>
                                    </form>
                                </div>
                            </div>
                        @endguest
                        {{-- ↑↑↑↑↑↑ پایان بخش منوی کاربر ↑↑↑↑↑↑ --}}
                    </div>
                </div>
            </nav>
            
            {{-- Carousel (فقط برای صفحه اصلی) --}}
            @if(Request::is('/'))
            <div id="header-carousel" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active" style="height: 410px;">
                        <img class="img-fluid" src="{{ asset('img/carousel-1.jpg') }}" alt="Image">
                        <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                            <div class="p-3" style="max-width: 700px;">
                                <h4 class="text-light text-uppercase font-weight-medium mb-3">۱۰٪ تخفیف اولین خرید</h4>
                                <h3 class="display-4 text-white font-weight-semi-bold mb-4">لباس‌های شیک</h3>
                                <a href="" class="btn btn-light py-2 px-3">همین حالا خرید کنید</a>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item" style="height: 410px;">
                        <img class="img-fluid" src="{{ asset('img/carousel-2.jpg') }}" alt="Image">
                        <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                            <div class="p-3" style="max-width: 700px;">
                                <h4 class="text-light text-uppercase font-weight-medium mb-3">۱۰٪ تخفیف اولین خرید</h4>
                                <h3 class="display-4 text-white font-weight-semi-bold mb-4">قیمت مناسب</h3>
                                <a href="" class="btn btn-light py-2 px-3">همین حالا خرید کنید</a>
                            </div>
                        </div>
                    </div>
                </div>
                <a class="carousel-control-prev" href="#header-carousel" data-slide="prev"><div class="btn btn-dark" style="width: 45px; height: 45px;"><span class="carousel-control-prev-icon mb-n2"></span></div></a>
                <a class="carousel-control-next" href="#header-carousel" data-slide="next"><div class="btn btn-dark" style="width: 45px; height: 45px;"><span class="carousel-control-next-icon mb-n2"></span></div></a>
            </div>
            @endif
        </div>
    </div>
</div>
<!-- Navbar End -->

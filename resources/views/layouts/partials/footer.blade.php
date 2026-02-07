<div class="container-fluid bg-secondary text-dark mt-5 pt-5" style="direction: rtl;">
    <div class="row px-xl-5 pt-5">
        <div class="col-lg-4 col-md-12 mb-5 pr-3 pr-xl-5">
            <a href="" class="text-decoration-none">
                <h1 class="mb-4 display-5 font-weight-semi-bold text-right"><span class="text-primary font-weight-bold border border-white px-3 ml-1">E</span>فروشگاه</h1>
            </a>
            <p class="text-right">ما باور داریم که خرید، فقط یک معامله نیست، بلکه یک تجربه لذت‌بخش است. به همین دلیل، تمام تلاش خود را به کار گرفته‌ایم تا بهترین‌ها را برای شما فراهم کنیم.</p>
            <p class="mb-2 text-right"><i class="fa fa-map-marker-alt text-primary ml-3"></i>تهران، میدان تجریش، خیابان سعدآباد</p>
            <p class="mb-2 text-right"><i class="fa fa-envelope text-primary ml-3"></i>info@example.com</p>
            <p class="mb-0 text-right"><i class="fa fa-phone-alt text-primary ml-3"></i>۰۲۱-۹۱۰۹۸۷۶۵</p>
        </div>
        <div class="col-lg-8 col-md-12">
            <div class="row">
                <div class="col-md-4 mb-5">
                    <h5 class="font-weight-bold text-dark mb-4 text-right">پیوندهای سریع</h5>
                    <div class="d-flex flex-column justify-content-start text-right">
                        <a class="text-dark mb-2" href="{{ route('home') }}"><i class="fa fa-angle-left mr-2"></i>خانه</a>
                        <a class="text-dark mb-2" href="{{ route('home') }}"><i class="fa fa-angle-left mr-2"></i>فروشگاه ما</a>
                        <a class="text-dark mb-2" href="{{ route('about') }}"><i class="fa fa-angle-left mr-2"></i>درباره ما</a>
                        <a class="text-dark" href="{{ route('about') }}"><i class="fa fa-angle-left mr-2"></i>تماس با ما</a>
                    </div>
                </div>
                <div class="col-md-4 mb-5">
                    {{-- Empty Column --}}
                </div>
                <div class="col-md-4 mb-5">
                    <h5 class="font-weight-bold text-dark mb-4 text-right">خبرنامه</h5>
                    <form action="">
                        <div class="form-group">
                            <input type="text" class="form-control border-0 py-4 text-right" placeholder="نام شما" required="required" />
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-control border-0 py-4 text-right" placeholder="ایمیل شما" required="required" />
                        </div>
                        <div>
                            <button class="btn btn-primary btn-block border-0 py-3" type="submit">عضویت</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row border-top border-light mx-xl-5 py-4">
        <div class="col-md-12 px-xl-0 text-center">
            <p class="mb-md-0 text-center text-dark">
                &copy; <a class="text-dark font-weight-semi-bold" href="{{ route('home') }}">فروشگاه شما</a>. تمامی حقوق محفوظ است.
            </p>
        </div>
    </div>
</div>


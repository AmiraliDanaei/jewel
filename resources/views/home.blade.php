@extends('layouts.main')

@section('title', 'صفحه اصلی')

@section('content')

    
    <div class="container-fluid offer pt-5">
        <div class="row px-xl-5">
            <div class="col-md-6 pb-4">
                <div class="position-relative bg-secondary text-center text-md-left text-white mb-2 py-5 px-5">
                    <img src="img/offer-1.png" alt="" class="offer-img-rtl">
                    <div class="position-relative" style="z-index: 1;">
                        <h5 class="text-uppercase text-primary mb-3">۲۰٪ تخفیف روی تمام سفارشات</h5>
                        <h1 class="mb-4 font-weight-semi-bold">کالکشن بهاره</h1>
                        <a href="" class="btn btn-outline-primary py-md-2 px-md-3">همین حالا خرید کنید</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 pb-4">
                <div class="position-relative bg-secondary text-center text-md-right text-white mb-2 py-5 px-5">
                    <img src="img/offer-2.png" alt="">
                    <div class="position-relative" style="z-index: 1;">
                        <h5 class="text-uppercase text-primary mb-3">۲۰٪ تخفیف روی تمام سفارشات</h5>
                        <h1 class="mb-4 font-weight-semi-bold">کالکشن زمستانه</h1>
                        <a href="" class="btn btn-outline-primary py-md-2 px-md-3">همین حالا خرید کنید</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    


    
    <div class="container-fluid pt-5 pb-3">
        <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">محصولات پرطرفدار</span></h2>
        <div class="row px-xl-5">
            @forelse($trandyProducts as $product)
                <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                    <div class="card product-item border-0 mb-4">
                        <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                            <a href="{{ route('products.show', $product->id) }}">
                                <img class="img-fluid w-100" src="{{ asset('products/' . $product->image) }}" alt="{{ $product->name }}">
                            </a>
                        </div>
                        <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                            <h6 class="text-truncate mb-3">{{ $product->name }}</h6>
                            <div class="d-flex justify-content-center">
                                <h6>{{ number_format($product->price) }} تومان</h6>
                            </div>
                        </div>
                        
                        <div class="card-footer d-flex justify-content-center bg-light border">
                            
                            <form action="{{ route('wishlist.toggle', $product->id) }}" method="POST" class="d-inline mx-1">
                                @csrf
                                <button type="submit" class="btn btn-sm text-dark p-0" title="افزودن به علاقه‌ها">
                                    @auth
                                        @if(auth()->user()->wishlist->contains($product))
                                            <i class="fas fa-heart text-danger"></i>
                                        @else
                                            <i class="far fa-heart text-primary"></i>
                                        @endif
                                    @else
                                        <i class="far fa-heart text-primary"></i>
                                    @endauth
                                </button>
                            </form>

                            
                            <form action="{{ route('cart.add', $product->id) }}" method="POST" class="d-inline mx-1">
                                @csrf
                                <input type="hidden" name="quantity" value="1">
                                <button type="submit" class="btn btn-sm text-dark p-0" title="افزودن به سبد خرید">
                                    <i class="fas fa-shopping-cart text-primary"></i>
                                </button>
                            </form>

                           
                            <a href="{{ route('products.show', $product->id) }}" class="btn btn-sm text-dark p-0 mx-1" title="مشاهده جزئیات">
                                <i class="fas fa-eye text-primary"></i>
                            </a>

                        </div>
                         
                    </div>
                </div>
            @empty
                <div class="col-12 text-center">
                    <p>در حال حاضر محصولی یافت نشد.</p>
                </div>
            @endforelse
        </div>
    </div>
    

@endsection

@section('scripts')
<style>
    .offer-img-rtl {
        transform: scaleX(-1);
    }
</style>
@endsection

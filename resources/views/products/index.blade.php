@extends('layouts.main')

@section('title', 'دسته‌بندی: ' . $category->name)

@section('content')

    
    <div class="container-fluid bg-secondary mb-5">
        <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 200px">
            <h1 class="font-weight-semi-bold text-uppercase mb-3">دسته‌بندی: {{ $category->name }}</h1>
            <div class="d-inline-flex">
                <p class="m-0"><a href="{{ route('home') }}">صفحه اصلی</a></p>
                <p class="m-0 px-2">-</p>
                <p class="m-0">فروشگاه</p>
            </div>
        </div>
    </div>
    


    
    <div class="container-fluid pt-5">
        <div class="row px-xl-5">
           
            <div class="col-lg-12 col-md-12">
                <div class="row pb-3">
                    @forelse($products as $product)
                        <div class="col-lg-4 col-md-6 col-sm-12 pb-1">
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
                            <p class="p-5">هیچ محصولی در این دسته‌بندی یافت نشد.</p>
                        </div>
                    @endforelse

                    <div class="col-12 pb-1">
                        <div class="d-flex justify-content-center mt-4">
                            
                            {{ $products->links() }}
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
    

@endsection

@extends('layouts.main')

@section('title', 'Shop by Category: ' . $category->name)

@section('content')
    <!-- Page Header Start -->
    <div class="container-fluid bg-secondary mb-5">
        <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 150px">
            <h1 class="font-weight-semi-bold text-uppercase mb-3">Category: {{ $category->name }}</h1>
            <div class="d-inline-flex">
                <p class="m-0"><a href="{{ route('home') }}">Home</a></p>
                <p class="m-0 px-2">-</p>
                <p class="m-0">Shop</p>
            </div>
        </div>
    </div>
    <!-- Page Header End -->

    <!-- Shop Start -->
    <div class="container-fluid pt-5">
        <div class="row px-xl-5">
            <!-- Shop Product Start -->
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
                                        <h6>${{ number_format($product->price, 2) }}</h6>
                                    </div>
                                </div>
                                <div class="card-footer d-flex justify-content-between bg-light border">
                                    <a href="{{ route('products.show', $product->id) }}" class="btn btn-sm text-dark p-0"><i class="fas fa-eye text-primary mr-1"></i>View Detail</a>
                                    <form action="{{ route('cart.add', $product->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        <input type="hidden" name="quantity" value="1">
                                        <button type="submit" class="btn btn-sm text-dark p-0"><i class="fas fa-shopping-cart text-primary mr-1"></i>Add To Cart</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12 text-center">
                            <p class="p-5">No products found in this category.</p>
                        </div>
                    @endforelse

                    <div class="col-12 pb-1">
                        <div class="d-flex justify-content-center">
                            {{-- This will show pagination links if there are more than 9 products --}}
                            {{ $products->links() }}
                        </div>
                    </div>
                </div>
            </div>
            <!-- Shop Product End -->
        </div>
    </div>
    <!-- Shop End -->
@endsection

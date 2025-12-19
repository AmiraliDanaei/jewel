@extends('layouts.main')

@section('title', $product->name)

@section('content')

    <!-- Page Header Start -->
    <div class="container-fluid bg-secondary mb-5">
        <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
            <h1 class="font-weight-semi-bold text-uppercase mb-3">Shop Detail</h1>
            <div class="d-inline-flex">
                <p class="m-0"><a href="{{ route('home') }}">Home</a></p>
                <p class="m-0 px-2">-</p>
                <p class="m-0">Shop Detail</p>
            </div>
        </div>
    </div>
    <!-- Page Header End -->


    <!-- Shop Detail Start -->
    <div class="container-fluid py-5">
        <div class="row px-xl-5">
            <div class="col-lg-5 pb-5">
                <div id="product-carousel" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner border">
                        <div class="carousel-item active">
                            <img class="w-100 h-100" src="{{ asset('products/' . $product->image) }}" alt="{{ $product->name }}">
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-7 pb-5">
                <h3 class="font-weight-semi-bold">{{ $product->name }}</h3>
                <h3 class="font-weight-semi-bold mb-4">${{ number_format($product->price, 2) }}</h3>
                <p class="mb-4">{{ $product->description }}</p>
                
                <form action="{{ route('cart.add', $product->id) }}" method="POST">
                    @csrf
                    <div class="d-flex align-items-center mb-4 pt-2">
                        <div class="input-group quantity mr-3" style="width: 130px;">
                            <div class="input-group-btn">
                                <button type="button" class="btn btn-primary btn-minus">
                                    <i class="fa fa-minus"></i>
                                </button>
                            </div>
                            <input type="text" name="quantity" class="form-control bg-secondary text-center" value="1">
                            <div class="input-group-btn">
                                <button type="button" class="btn btn-primary btn-plus">
                                    <i class="fa fa-plus"></i>
                                </button>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary px-3"><i class="fa fa-shopping-cart mr-1"></i> Add To Cart</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="row px-xl-5">
            <div class="col">
                <div class="nav nav-tabs justify-content-center border-secondary mb-4">
                    <a class="nav-item nav-link active" data-toggle="tab" href="#tab-pane-1">Description</a>
                    <a class="nav-item nav-link" data-toggle="tab" href="#tab-pane-3">Reviews (0)</a>
                </div>
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="tab-pane-1">
                        <h4 class="mb-3">Product Description</h4>
                        <p>{{ $product->description }}</p>
                    </div>
                    <div class="tab-pane fade" id="tab-pane-3">
                        <p>Reviews will be implemented in a future step.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Shop Detail End -->

@endsection

@section('scripts')
<script>
$(document).ready(function(){
    
    $('.quantity .btn-plus').on('click', function() {
        var input = $(this).closest('.quantity').find('input');
        var currentValue = parseInt(input.val());
        input.val(currentValue + 1);
    });

   
    $('.quantity .btn-minus').on('click', function() {
        var input = $(this).closest('.quantity').find('input');
        var currentValue = parseInt(input.val());
        if (currentValue > 1) {
            input.val(currentValue - 1);
        }
    });
});
</script>
@endsection

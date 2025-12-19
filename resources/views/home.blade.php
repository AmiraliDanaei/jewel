@extends('layouts.main')

@section('title', 'Home Page')

@section('content')

{{-- Static content blocks (Featured, Categories, Offer) remain the same --}}
<div class="container-fluid pt-5">
    {{-- ... Featured section ... --}}
</div>

<div class="container-fluid pt-5">
    {{-- ... Categories section ... --}}
</div>

<div class="container-fluid offer pt-5">
    {{-- ... Offer section ... --}}
</div>


<div class="container-fluid pt-5">
    <div class="text-center mb-4">
        <h2 class="section-title px-5"><span class="px-2">Trandy Products</span></h2>
    </div>
    <div class="row px-xl-5 pb-3">
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
                <p>No products found at the moment.</p>
            </div>
        @endforelse
    </div>
</div>

@endsection

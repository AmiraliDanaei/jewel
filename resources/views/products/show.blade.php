@extends('layouts.main')

@section('title', $product->name)

@section('content')

    
    <div class="container-fluid bg-secondary mb-5">
        <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 200px">
            <h1 class="font-weight-semi-bold text-uppercase mb-3">جزئیات محصول</h1>
            <div class="d-inline-flex">
                <p class="m-0"><a href="{{ route('home') }}">صفحه اصلی</a></p>
                <p class="m-0 px-2">-</p>
                <p class="m-0">جزئیات محصول</p>
            </div>
        </div>
    </div>
    

    
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
                <h3 class="font-weight-semi-bold mb-4">{{ number_format($product->price) }} تومان</h3>
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
                            <input type="text" name="quantity" class="form-control bg-secondary border-0 text-center" value="1">
                            <div class="input-group-btn">
                               
                                <button type="button" class="btn btn-primary btn-plus">
                                    <i class="fa fa-plus"></i>
                                </button>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary px-3">
                            <i class="fa fa-shopping-cart ml-1"></i> افزودن به سبد
                        </button>
                    </div>
                </form>
            </div>
        </div>
        
       
        <div class="row px-xl-5">
            <div class="col">
                <div class="nav nav-tabs justify-content-center border-secondary mb-4">
                    <a class="nav-item nav-link active" data-toggle="tab" href="#tab-pane-1">توضیحات</a>
                    <a class="nav-item nav-link" data-toggle="tab" href="#tab-pane-3">نظرات ({{ $comments->count() }})</a>
                </div>
                <div class="tab-content">
                    
                    <div class="tab-pane fade show active" id="tab-pane-1">
                        <h4 class="mb-3">توضیحات محصول</h4>
                        <p>{{ $product->description }}</p>
                    </div>

                    
                    <div class="tab-pane fade" id="tab-pane-3">
                        <div class="row">
                            <div class="col-md-7">
                                <h4 class="mb-4">نظرات کاربران برای "{{ $product->name }}"</h4>
                                @forelse($comments as $comment)
                                    {{-- کامنت اصلی کاربر --}}
                                    <div class="media mb-4 p-3" style="background-color: #f8f9fa; border-radius: 5px;">
                                        <i class="fas fa-user-circle fa-3x mr-3 text-muted"></i>
                                        <div class="media-body">
                                            <h6>{{ $comment->user->name }}<small class="text-muted"> - <i>{{ $comment->created_at->diffForHumans() }}</i></small></h6>
                                            <p>{{ $comment->body }}</p>
                                        </div>
                                    </div>
                                    
                                    
                                    @foreach($comment->replies as $reply)
                                        @if($reply->is_approved)
                                            <div class="media mt-3 mb-4 p-3" style="margin-right: 50px; background-color: #e9f5ff; border: 1px solid #cce5ff; border-radius: 5px;">
                                                <i class="fas fa-user-shield fa-3x mr-3 text-primary"></i>
                                                <div class="media-body">
                                                    <h6>پاسخ ادمین<small class="text-muted"> - <i>{{ $reply->created_at->diffForHumans() }}</i></small></h6>
                                                    <p>{{ $reply->body }}</p>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                @empty
                                    <div class="alert alert-secondary text-center">
                                        هنوز نظری برای این محصول ثبت نشده است. شما اولین نفر باشید!
                                    </div>
                                @endforelse
                            </div>
                           
                            <div class="col-md-5">
                                <h4 class="mb-4">نظر خود را ثبت کنید</h4>
                                @auth
                                    <form action="{{ route('comments.store', $product->id) }}" method="POST">
                                        @csrf
                                        <div class="form-group">
                                            <label for="message">نظر شما *</label>
                                            <textarea id="message" name="body" cols="30" rows="5" class="form-control" required></textarea>
                                        </div>
                                        <div class="form-group mb-0">
                                            <button type="submit" class="btn btn-primary px-3">
                                                <i class="fas fa-paper-plane"></i> ارسال نظر
                                            </button>
                                        </div>
                                    </form>
                                @else
                                    @guest
                                        <div class="alert alert-warning">
                                            برای ثبت نظر، لطفا ابتدا <a href="{{ route('login') }}" class="alert-link">وارد شوید</a>.
                                        </div>
                                    @endguest
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
@endsection

@section('scripts')

<script>
$(document).ready(function(){
    
    $('.quantity button.btn-plus').on('click', function () {
        let button = $(this);
        let input = button.closest('.quantity').find('input');
        let newVal = parseInt(input.val()) + 1;
        input.val(newVal);
    });

    
    $('.quantity button.btn-minus').on('click', function () {
        let button = $(this);
        let input = button.closest('.quantity').find('input');
        let oldValue = parseInt(input.val());
        if (oldValue > 1) {
            let newVal = oldValue - 1;
            input.val(newVal);
        }
    });
});
</script>
@endsection

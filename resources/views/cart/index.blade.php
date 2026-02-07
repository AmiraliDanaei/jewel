@extends('layouts.main')

@section('title', 'سبد خرید')

@section('content')

    
    <div class="container-fluid bg-secondary mb-5">
        <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 200px">
            <h1 class="font-weight-semi-bold text-uppercase mb-3">سبد خرید</h1>
            <div class="d-inline-flex">
                <p class="m-0"><a href="{{ route('home') }}">صفحه اصلی</a></p>
                <p class="m-0 px-2">-</p>
                <p class="m-0">سبد خرید</p>
            </div>
        </div>
    </div>
    

    
    <div class="container-fluid">
        <div class="row px-xl-5">
            
            <div class="col-lg-8 mb-5">
                
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-transparent border-0 py-3">
                        <h4 class="font-weight-semi-bold m-0">محصولات شما</h4>
                    </div>
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-center mb-0">
                            <thead class="thead-light">
                                <tr>
                                    <th>محصولات</th>
                                    <th>قیمت واحد</th>
                                    <th>تعداد</th>
                                    <th>قیمت کل</th>
                                    <th>حذف</th>
                                </tr>
                            </thead>
                            <tbody class="align-middle">
                                @if(session('cart') && count(session('cart')) > 0)
                                    @php $subtotal = 0; @endphp
                                    @foreach(session('cart') as $id => $details)
                                        @php $subtotal += $details['price'] * $details['quantity']; @endphp
                                        <tr>
                                            <td class="align-middle text-left"><img src="{{ asset('products/'.$details['image']) }}" alt="" style="width: 50px;"> {{ $details['name'] }}</td>
                                            <td class="align-middle">{{ number_format($details['price']) }} تومان</td>
                                            <td class="align-middle">
                                                <div class="input-group quantity mx-auto" style="width: 100px;">
                                                    <div class="input-group-btn">
                                                        <button type="button" class="btn btn-sm btn-primary btn-minus" data-id="{{ $id }}"><i class="fa fa-minus"></i></button>
                                                    </div>
                                                    <input type="text" class="form-control form-control-sm bg-secondary border-0 text-center" value="{{ $details['quantity'] }}" readonly>
                                                    <div class="input-group-btn">
                                                        <button type="button" class="btn btn-sm btn-primary btn-plus" data-id="{{ $id }}"><i class="fa fa-plus"></i></button>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="align-middle">{{ number_format($details['price'] * $details['quantity']) }} تومان</td>
                                            <td class="align-middle"><button class="btn btn-sm btn-danger remove-from-cart" data-id="{{ $id }}"><i class="fa fa-times"></i></button></td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="5" class="text-center py-4">سبد خرید شما خالی است.</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            
           
            <div class="col-lg-4">
                
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-transparent border-0 py-3">
                        <h5 class="font-weight-semi-bold m-0">کد تخفیف</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('cart.apply-coupon') }}" method="post">
                            @csrf
                            <div class="input-group">
                                <input type="text" class="form-control p-4" name="coupon_code" placeholder="کد تخفیف خود را وارد کنید">
                                <div class="input-group-append">
                                    <button class="btn btn-primary">اعمال</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-primary text-white border-0">
                        <h4 class="font-weight-semi-bold m-0">خلاصه سبد خرید</h4>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-3 pt-1">
                            <h6 class="font-weight-medium">جمع محصولات</h6>
                            <h6 class="font-weight-medium">{{ number_format($subtotal ?? 0) }} تومان</h6>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h6 class="font-weight-medium">تخفیف</h6>
                            @php
                                $discount = 0;
                                if(session('coupon') && isset($subtotal)) {
                                    $coupon = session('coupon');
                                    if ($coupon['type'] == 'percent') {
                                        $discount = ($subtotal * $coupon['value']) / 100;
                                    } else {
                                        $discount = $coupon['value'];
                                    }
                                }
                            @endphp
                            <h6 class="font-weight-medium text-danger">-{{ number_format($discount) }} تومان</h6>
                        </div>
                    </div>
                    <div class="card-footer border-secondary bg-transparent">
                        <div class="d-flex justify-content-between mt-2">
                            <h5 class="font-weight-bold">مبلغ نهایی</h5>
                            <h5 class="font-weight-bold">{{ number_format(($subtotal ?? 0) - $discount) }} تومان</h5>
                        </div>
                        @if(session('cart') && count(session('cart')) > 0)
                            <a href="{{ route('checkout.index') }}" class="btn btn-block btn-primary font-weight-bold my-3 py-3">ادامه فرآیند خرید</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    

@endsection

@section('scripts')

<script>
$(document).ready(function () {
    function updateCart(id, quantity) {
        var form = $('<form>', { 'action': "{{ route('cart.update') }}", 'method': 'POST' });
        form.append($('<input>', { 'type': 'hidden', 'name': '_token', 'value': '{{ csrf_token() }}' }));
        form.append($('<input>', { 'type': 'hidden', 'name': '_method', 'value': 'PATCH' }));
        form.append($('<input>', { 'type': 'hidden', 'name': 'id', 'value': id }));
        form.append($('<input>', { 'type': 'hidden', 'name': 'quantity', 'value': quantity }));
        form.appendTo('body').submit();
    }
    
    $('.btn-plus').on('click', function () {
        var id = $(this).data('id');
        var input = $(this).closest('.quantity').find('input');
        var newQuantity = parseInt(input.val()) + 1;
        updateCart(id, newQuantity);
    });

    $('.btn-minus').on('click', function () {
        var id = $(this).data('id');
        var input = $(this).closest('.quantity').find('input');
        var newQuantity = parseInt(input.val()) - 1;
        if (newQuantity >= 1) {
            updateCart(id, newQuantity);
        }
    });

    $('.remove-from-cart').on('click', function () {
        if (confirm('آیا از حذف این محصول مطمئن هستید؟')) {
            var id = $(this).data('id');
            var form = $('<form>', { 'action': "{{ route('cart.remove') }}", 'method': 'POST' });
            form.append($('<input>', { 'type': 'hidden', 'name': '_token', 'value': '{{ csrf_token() }}' }));
            form.append($('<input>', { 'type': 'hidden', 'name': '_method', 'value': 'DELETE' }));
            form.append($('<input>', { 'type': 'hidden', 'name': 'id', 'value': id }));
            form.appendTo('body').submit();
        }
    });
});
</script>
@endsection

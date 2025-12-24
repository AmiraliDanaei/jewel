@extends('layouts.main')

@section('title', 'سبد خرید')

@section('content')
    <!-- Page Header Start -->
    <div class="container-fluid bg-secondary mb-5">
        <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 150px">
            <h1 class="font-weight-semi-bold text-uppercase mb-3">سبد خرید</h1>
            <div class="d-inline-flex">
                <p class="m-0"><a href="{{ route('home') }}">خانه</a></p>
                <p class="m-0 px-2">-</p>
                <p class="m-0">سبد خرید</p>
            </div>
        </div>
    </div>
    <!-- Page Header End -->

    <!-- Cart Start -->
    <div class="container-fluid pt-5">
        <div class="row px-xl-5">
            <div class="col-lg-8 table-responsive mb-5">
                <table class="table table-bordered text-center mb-0">
                    <thead class="bg-secondary text-dark">
                        <tr>
                            <th>محصولات</th>
                            <th>قیمت</th>
                            <th>تعداد</th>
                            <th>مجموع</th>
                            <th>حذف</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle">
                        @php $total = 0 @endphp
                        @if(session('cart') && count(session('cart')) > 0)
                            @foreach(session('cart') as $id => $details)
                                @php $total += $details['price'] * $details['quantity'] @endphp
                                <tr data-id="{{ $id }}">
                                    <td class="align-middle text-left">
                                        <a href="{{ route('products.show', $id) }}">
                                            <img src="{{ asset('products/' . $details['image']) }}" alt="" style="width: 50px;"> 
                                            {{ $details['name'] }}
                                        </a>
                                    </td>
                                    <td class="align-middle" data-price="{{ $details['price'] }}">{{ number_format($details['price']) }} تومان</td>
                                    <td class="align-middle">
                                        <div class="input-group quantity mx-auto" style="width: 100px;">
                                            <div class="input-group-btn">
                                                <button type="button" class="btn btn-sm btn-primary btn-minus-cart">
                                                    <i class="fa fa-minus"></i>
                                                </button>
                                            </div>
                                            <input type="text" class="form-control form-control-sm bg-secondary text-center quantity-input" value="{{ $details['quantity'] }}">
                                            <div class="input-group-btn">
                                                <button type="button" class="btn btn-sm btn-primary btn-plus-cart">
                                                    <i class="fa fa-plus"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="align-middle item-total">{{ number_format($details['price'] * $details['quantity']) }} تومان</td>
                                    <td class="align-middle">
                                        <button class="btn btn-sm btn-danger btn-remove"><i class="fa fa-times"></i></button>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="5" class="text-center">سبد خرید شما خالی است!</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
            {{-- =============================================== --}}
            {{-- THIS IS THE MISSING CART SUMMARY PART          --}}
            {{-- =============================================== --}}
            <div class="col-lg-4">
                <div class="card border-secondary mb-5">
                    <div class="card-header bg-secondary border-0">
                        <h4 class="font-weight-semi-bold m-0 text-right">خلاصه سبد خرید</h4>
                    </div>
                    <div class="card-footer border-secondary bg-transparent">
                        <div class="d-flex justify-content-between mt-2">
                            <h5 class="font-weight-bold">جمع کل</h5>
                            <h5 class="font-weight-bold" id="cart-total">{{ number_format($total) }} تومان</h5>
                        </div>
                        <a href="{{ route('checkout.index') }}" class="btn btn-block btn-primary my-3 py-3">ادامه و تکمیل خرید</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Cart End -->
@endsection

@section('scripts')
<script type="text/javascript">
    function updateCart(element, newQuantity) {
        var row = element.closest("tr");
        var id = row.data("id");
        $.ajax({
            url: '{{ route('cart.update') }}',
            method: "patch",
            data: {
                _token: '{{ csrf_token() }}', 
                id: id, 
                quantity: newQuantity
            },
            success: function (response) {
                updatePageTotals();
            }
        });
    }

    function updatePageTotals() {
        var total = 0;
        $('table tbody tr').each(function() {
            var row = $(this);
            if (row.find('.quantity-input').length > 0) {
                var price = parseFloat(row.find('td[data-price]').data('price'));
                var quantity = parseInt(row.find('.quantity-input').val());
                var itemTotal = price * quantity;
                row.find('.item-total').text(itemTotal.toLocaleString() + ' تومان');
                total += itemTotal;
            }
        });
        $('#cart-total').text(total.toLocaleString() + ' تومان');
    }

    $(".btn-plus-cart").on('click', function () {
        var input = $(this).closest('.quantity').find('input');
        var currentValue = parseInt(input.val());
        input.val(currentValue + 1);
        updateCart($(this), currentValue + 1);
    });

    $(".btn-minus-cart").on('click', function () {
        var input = $(this).closest('.quantity').find('input');
        var currentValue = parseInt(input.val());
        if (currentValue > 1) {
            input.val(currentValue - 1);
            updateCart($(this), currentValue - 1);
        }
    });

    $(".btn-remove").click(function (e) {
        e.preventDefault();
        var ele = $(this);
        if(confirm("آیا از حذف این محصول اطمینان دارید؟")) {
            $.ajax({
                url: '{{ route('cart.remove') }}',
                method: "DELETE",
                data: {
                    _token: '{{ csrf_token() }}', 
                    id: ele.parents("tr").attr("data-id")
                },
                success: function (response) {
                    window.location.reload(); 
                }
            });
        }
    });
</script>
@endsection

@extends('layouts.main')

@section('title', 'Shopping Cart')

@section('content')
    <!-- Page Header Start -->
    <div class="container-fluid bg-secondary mb-5">
        <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 150px">
            <h1 class="font-weight-semi-bold text-uppercase mb-3">Shopping Cart</h1>
            <div class="d-inline-flex">
                <p class="m-0"><a href="{{ route('home') }}">Home</a></p>
                <p class="m-0 px-2">-</p>
                <p class="m-0">Shopping Cart</p>
            </div>
        </div>
    </div>
    
    <div class="container-fluid pt-5">
        <div class="row px-xl-5">
            <div class="col-lg-8 table-responsive mb-5">
                <table class="table table-bordered text-center mb-0">
                    <thead class="bg-secondary text-dark">
                        <tr>
                            <th>Products</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <th>Remove</th>
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
                                    <td class="align-middle" data-price="{{ $details['price'] }}">${{ number_format($details['price'], 2) }}</td>
                                    <td class="align-middle">
                                        <div class="input-group quantity mx-auto" style="width: 100px;">
                                            <div class="input-group-btn">
                                                {{-- Added 'cart-quantity-minus' class --}}
                                                <button type="button" class="btn btn-sm btn-primary cart-quantity-minus">
                                                    <i class="fa fa-minus"></i>
                                                </button>
                                            </div>
                                            <input type="text" class="form-control form-control-sm bg-secondary text-center quantity-input" value="{{ $details['quantity'] }}">
                                            <div class="input-group-btn">
                                                 {{-- Added 'cart-quantity-plus' class --}}
                                                <button type="button" class="btn btn-sm btn-primary cart-quantity-plus">
                                                    <i class="fa fa-plus"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="align-middle item-total">${{ number_format($details['price'] * $details['quantity'], 2) }}</td>
                                    <td class="align-middle">
                                        <form action="{{ route('cart.remove') }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <input type="hidden" name="id" value="{{ $id }}">
                                            <button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-times"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="5" class="text-center">Your cart is empty!</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
            <div class="col-lg-4">
                 <div class="card border-secondary mb-5">
                    <div class="card-header bg-secondary border-0">
                        <h4 class="font-weight-semi-bold m-0">Cart Summary</h4>
                    </div>
                    <div class="card-footer border-secondary bg-transparent">
                        <div class="d-flex justify-content-between mt-2">
                            <h5 class="font-weight-bold">Total</h5>
                            <h5 class="font-weight-bold" id="cart-total">${{ number_format($total, 2) }}</h5>
                        </div>
                        <a href="#" class="btn btn-block btn-primary my-3 py-3">Proceed To Checkout</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
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
                row.find('.item-total').text('$' + itemTotal.toFixed(2));
                total += itemTotal;
            }
        });
        $('#cart-total').text('$' + total.toFixed(2));
    }

    $(".cart-quantity-plus").on('click', function () {
        var input = $(this).closest('.quantity').find('input');
        var currentValue = parseInt(input.val());
        input.val(currentValue + 1);
        updateCart($(this), currentValue + 1);
    });

    $(".cart-quantity-minus").on('click', function () {
        var input = $(this).closest('.quantity').find('input');
        var currentValue = parseInt(input.val());
        if (currentValue > 1) {
            input.val(currentValue - 1);
            updateCart($(this), currentValue - 1);
        }
    });

</script>
@endsection

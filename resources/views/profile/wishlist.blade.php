@extends('layouts.main')
@section('title', 'لیست علاقه‌مندی‌ها')
@section('content')
    <div class="container-fluid py-5">
        <div class="row px-xl-5">
            <div class="col">
                <h2 class="mb-4">لیست علاقه‌مندی‌های من</h2>
                <div class="table-responsive">
                    <table class="table table-bordered text-center">
                        <thead class="thead-light">
                            <tr>
                                <th>محصول</th>
                                <th>قیمت</th>
                                <th>عملیات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($wishlist as $product)
                                <tr>
                                    <td class="align-middle text-left">
                                        <img src="{{ asset('products/'.$product->image) }}" alt="" style="width: 50px;">
                                        {{ $product->name }}
                                    </td>
                                    <td class="align-middle">{{ number_format($product->price) }} تومان</td>
                                    <td class="align-middle">
                                        <a href="{{ route('products.show', $product->id) }}" class="btn btn-sm btn-info">مشاهده</a>
                                        <form action="{{ route('wishlist.toggle', $product->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-danger">حذف</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3">لیست علاقه‌مندی‌های شما خالی است.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                 <div class="d-flex justify-content-center mt-4">
                    {{ $wishlist->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection

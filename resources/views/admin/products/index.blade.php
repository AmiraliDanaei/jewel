@extends('admin.layouts.admin')
@section('title', 'مدیریت محصولات')
@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>مدیریت محصولات</h1>
        <a href="{{ route('admin.products.create') }}" class="btn btn-primary">افزودن محصول جدید</a>
    </div>
    @if(session('success'))<div class="alert alert-success text-right">{{ session('success') }}</div>@endif
    <div class="card"><div class="card-body"><table class="table table-bordered text-center"><thead class="thead-light"><tr><th>#</th><th>تصویر</th><th>نام محصول</th><th>دسته‌بندی</th><th>قیمت</th><th>موجودی</th><th>عملیات</th></tr></thead><tbody>
    @forelse($products as $product)
        <tr>
            <td>{{ $product->id }}</td>
            <td><img src="{{ asset('products/' . $product->image) }}" alt="{{ $product->name }}" width="60"></td>
            <td>{{ $product->name }}</td>
            <td>{{ $product->category->name ?? 'N/A' }}</td>
            <td>{{ number_format($product->price) }} تومان</td>
            <td>{{ $product->quantity }} عدد</td>
            <td>
                <a href="{{ route('products.show', $product->id) }}" class="btn btn-sm btn-success" target="_blank">نمایش</a>
                <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-sm btn-info">ویرایش</a>
                <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" class="d-inline">@csrf @method('DELETE')<button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('آیا از حذف این محصول اطمینان دارید؟')">حذف</button></form>
            </td>
        </tr>
    @empty
        <tr><td colspan="7" class="text-center">هیچ محصولی یافت نشد.</td></tr>
    @endforelse
    </tbody></table></div><div class="card-footer d-flex justify-content-center">{{ $products->links() }}</div></div>
@endsection

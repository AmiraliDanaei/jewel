@extends('admin.layouts.admin')

@section('title', 'ویرایش محصول: ' . $product->name)

@section('content')
    <h1 class="text-right">ویرایش محصول: {{ $product->name }}</h1>

    <div class="card">
        <div class="card-body" style="direction: rtl;">
            <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PATCH')

                <div class="form-group mb-3">
                    <label for="name" class="text-right d-block">نام محصول:</label>
                    <input type="text" id="name" name="name" class="form-control text-right" value="{{ old('name', $product->name) }}" required>
                </div>
                
                <div class="form-group mb-3">
                    <label for="description" class="text-right d-block">توضیحات:</label>
                    <textarea id="description" name="description" class="form-control text-right" rows="4" required>{{ old('description', $product->description) }}</textarea>
                </div>

                <div class="form-group mb-3">
                    <label for="price" class="text-right d-block">قیمت (تومان):</label>
                    <input type="number" id="price" name="price" class="form-control text-right" value="{{ old('price', $product->price) }}" required>
                </div>
                
                <div class="form-group mb-3">
                    <label for="quantity" class="text-right d-block">موجودی انبار:</label>
                    <input type="number" id="quantity" name="quantity" class="form-control text-right" value="{{ old('quantity', $product->quantity) }}" required min="0">
                </div>
                
                <div class="form-group mb-3">
                    <label for="image" class="text-right d-block">تصویر محصول:</label>
                    <input type="file" id="image" name="image" class="form-control">
                    <small class="form-text text-muted text-right">برای نگه داشتن تصویر فعلی، این فیلد را خالی بگذارید.</small>
                    <img src="{{ asset('products/' . $product->image) }}" alt="{{ $product->name }}" width="100" class="mt-2 rounded">
                </div>
                
                <div class="form-group mb-3">
                    <label for="category_id" class="text-right d-block">دسته‌بندی:</label>
                    <select id="category_id" name="category_id" class="custom-select text-right" required>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" @selected(old('category_id', $product->category_id) == $category->id)>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                
                <button type="submit" class="btn btn-success">بروزرسانی محصول</button>
                <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">انصراف</a>
            </form>
        </div>
    </div>
@endsection

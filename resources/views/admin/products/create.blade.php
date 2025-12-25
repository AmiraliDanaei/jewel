@extends('admin.layouts.admin')

@section('title', 'افزودن محصول جدید')

@section('content')
    <h1 class="text-right">افزودن محصول جدید</h1>

    <div class="card">
        <div class="card-body" style="direction: rtl;">
            <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group mb-3">
                    <label for="name" class="text-right d-block">نام محصول:</label>
                    <input type="text" id="name" name="name" class="form-control text-right" required>
                </div>
                
                <div class="form-group mb-3">
                    <label for="description" class="text-right d-block">توضیحات:</label>
                    <textarea id="description" name="description" class="form-control text-right" rows="4" required></textarea>
                </div>

                <div class="form-group mb-3">
                    <label for="price" class="text-right d-block">قیمت (تومان):</label>
                    <input type="number" id="price" name="price" class="form-control text-right" required>
                </div>
                
                <div class="form-group mb-3">
                    <label for="quantity" class="text-right d-block">موجودی انبار:</label>
                    <input type="number" id="quantity" name="quantity" class="form-control text-right" required min="0" value="1">
                </div>
                
                <div class="form-group mb-3">
                    <label for="image" class="text-right d-block">تصویر محصول:</label>
                    <input type="file" id="image" name="image" class="form-control">
                </div>
                
                <div class="form-group mb-3">
                    <label for="category_id" class="text-right d-block">دسته‌بندی:</label>
                    <select id="category_id" name="category_id" class="custom-select text-right" required>
                        <option value="">یک دسته‌بندی را انتخاب کنید</option>
                        @if(isset($categories))
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
                
                <button type="submit" class="btn btn-success">ذخیره محصول</button>
                <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">انصراف</a>
            </form>
        </div>
    </div>
@endsection

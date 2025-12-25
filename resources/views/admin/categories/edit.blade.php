@extends('admin.layouts.admin')
@section('title', 'ویرایش دسته‌بندی')
@section('content')
    <h1 class="text-right">ویرایش: {{ $category->name }}</h1>
    <form action="{{ route('admin.categories.update', $category->id) }}" method="POST">
        @csrf
        @method('PATCH')
        <div class="form-group">
            <label for="name" class="text-right d-block">نام دسته‌بندی:</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ $category->name }}" required>
        </div>
        <button type="submit" class="btn btn-success">بروزرسانی</button>
    </form>
@endsection

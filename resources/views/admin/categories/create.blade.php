@extends('admin.layouts.admin')
@section('title', 'افزودن دسته‌بندی')
@section('content')
    <h1 class="text-right">افزودن دسته‌بندی جدید</h1>
    <form action="{{ route('admin.categories.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name" class="text-right d-block">نام دسته‌بندی:</label>
            <input type="text" name="name" id="name" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success">ذخیره</button>
    </form>
@endsection

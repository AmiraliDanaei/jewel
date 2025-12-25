@extends('admin.layouts.admin')

@section('title', 'مدیریت دسته‌بندی‌ها')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>مدیریت دسته‌بندی‌ها</h1>
        <a href="{{ route('admin.categories.create') }}" class="btn btn-primary">افزودن دسته‌بندی جدید</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success text-right">
            {{ session('success') }}
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <table class="table table-bordered text-center">
                <thead class="thead-light">
                    <tr>
                        <th>#</th>
                        <th>نام دسته‌بندی</th>
                        <th>تعداد محصولات</th>
                        <th>عملیات</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($categories as $category)
                        <tr>
                            <td>{{ $category->id }}</td>
                            <td>{{ $category->name }}</td>
                            <td>{{ $category->products_count }}</td>
                            <td>
                                <a href="{{ route('admin.categories.edit', $category->id) }}" class="btn btn-sm btn-info">ویرایش</a>
                                
                                <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('آیا از حذف این دسته‌بندی اطمینان دارید؟ حذف دسته‌بندی، تمام محصولات آن را نیز حذف خواهد کرد.')">حذف</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center">هیچ دسته‌بندی یافت نشد.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection

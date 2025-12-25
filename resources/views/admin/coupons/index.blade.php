@extends('admin.layouts.admin')

@section('title', 'مدیریت کوپن‌ها')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="text-right">مدیریت کوپن‌ها</h1>
        <a href="{{ route('admin.coupons.create') }}" class="btn btn-primary">افزودن کوپن جدید</a>
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
                        <th>کد تخفیف</th>
                        <th>نوع</th>
                        <th>مقدار</th>
                        <th>تاریخ انقضا</th>
                        <th>عملیات</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($coupons as $coupon)
                        <tr>
                            <td><code>{{ $coupon->code }}</code></td>
                            <td>{{ $coupon->type == 'fixed' ? 'مبلغ ثابت' : 'درصد' }}</td>
                            <td>{{ $coupon->type == 'percent' ? $coupon->value . '%' : number_format($coupon->value) . ' تومان' }}</td>
                            <td>{{ $coupon->expires_at ? \Carbon\Carbon::parse($coupon->expires_at)->format('Y/m/d') : '—' }}</td>
                            <td>
                                <a href="{{ route('admin.coupons.edit', $coupon->id) }}" class="btn btn-sm btn-info">ویرایش</a>
                                <form action="{{ route('admin.coupons.destroy', $coupon->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('آیا از حذف این کوپن اطمینان دارید؟')">حذف</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">هیچ کوپنی یافت نشد.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection

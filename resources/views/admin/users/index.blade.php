@extends('admin.layouts.admin')
@section('title', 'مدیریت کاربران')
@section('content')
    <h1 class="text-right">مدیریت کاربران</h1>
    @if(session('success')) <div class="alert alert-success text-right">{{ session('success') }}</div> @endif
    @if(session('error')) <div class="alert alert-danger text-right">{{ session('error') }}</div> @endif
    <div class="card">
        <div class="card-body">
            <table class="table table-bordered text-center">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>نام</th>
                        <th>ایمیل</th>
                        <th>نقش</th>
                        <th>تاریخ ثبت‌نام</th>
                        <th>عملیات</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td><span class="badge {{ $user->role == 'admin' ? 'badge-success' : 'badge-secondary' }}">{{ $user->role }}</span></td>
                        <td>{{ $user->created_at->format('Y-m-d') }}</td>
                        <td>
                            <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-sm btn-info">ویرایش</a>
                            <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('آیا از حذف این کاربر اطمینان دارید؟')">حذف</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

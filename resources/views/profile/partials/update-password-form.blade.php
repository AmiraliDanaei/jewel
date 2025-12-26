<section style="direction: rtl;">
    <header>
        <h2 class="h5 font-weight-bold text-right">
            بروزرسانی رمز عبور
        </h2>
        <p class="mt-1 text-sm text-muted text-right">
            اطمینان حاصل کنید که حساب شما از یک رمز عبور طولانی و تصادفی برای امن ماندن استفاده می‌کند.
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-4">
        @csrf
        @method('put')

        <div class="form-group">
            <label for="update_password_current_password" class="text-right d-block">رمز عبور فعلی</label>
            <input id="update_password_current_password" name="current_password" type="password" class="form-control" autocomplete="current-password">
            @error('current_password', 'updatePassword') <span class="text-danger text-sm">{{ $message }}</span> @enderror
        </div>
        <div class="form-group">
            <label for="update_password_password" class="text-right d-block">رمز عبور جدید</label>
            <input id="update_password_password" name="password" type="password" class="form-control" autocomplete="new-password">
            @error('password', 'updatePassword') <span class="text-danger text-sm">{{ $message }}</span> @enderror
        </div>
        <div class="form-group">
            <label for="update_password_password_confirmation" class="text-right d-block">تکرار رمز عبور جدید</label>
            <input id="update_password_password_confirmation" name="password_confirmation" type="password" class="form-control" autocomplete="new-password">
        </div>

        <div class="d-flex align-items-center">
            <button type="submit" class="btn btn-primary">ذخیره</button>
            @if (session('status') === 'password-updated')
                <p class="text-sm text-success mr-3">ذخیره شد.</p>
            @endif
        </div>
    </form>
</section>

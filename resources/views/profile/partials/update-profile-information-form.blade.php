<section style="direction: rtl;">
    <header>
        <h2 class="h5 font-weight-bold text-right">
            اطلاعات پروفایل
        </h2>
        <p class="mt-1 text-sm text-muted text-right">
            اطلاعات پروفایل و آدرس ایمیل حساب خود را بروزرسانی کنید.
        </p>
    </header>

    <form method="post" action="{{ route('profile.update') }}" class="mt-4">
        @csrf
        @method('patch')

        <div class="form-group">
            <label for="name" class="text-right d-block">نام</label>
            <input id="name" name="name" type="text" class="form-control text-right" value="{{ old('name', $user->name) }}" required autofocus>
            @error('name') <span class="text-danger text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <label for="email" class="text-right d-block">ایمیل</label>
            <input id="email" name="email" type="email" class="form-control text-right" value="{{ old('email', $user->email) }}" required>
            @error('email') <span class="text-danger text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="d-flex align-items-center">
            <button type="submit" class="btn btn-primary">ذخیره</button>
            @if (session('status') === 'profile-updated')
                <p class="text-sm text-success mr-3">ذخیره شد.</p>
            @endif
        </div>
    </form>
</section>

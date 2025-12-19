<x-guest-layout>
    <div class="mb-4 text-sm text-gray-600">
        {{ __('We have sent a 6-digit code to your email address. Please enter it below.') }}
    </div>

    <form method="POST" action="{{ route('verify.code') }}">
        @csrf

        
        <input type="hidden" name="email" value="{{ session('email') }}">

        
        <div>
            <x-input-label for="login_code" :value="__('Verification Code')" />
            <x-text-input id="login_code" class="block mt-1 w-full" type="text" name="login_code" required autofocus />
            <x-input-error :messages="$errors->get('login_code')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                {{ __('Verify and Log In') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>

@extends('profile.layouts.profile')

@section('profile-content')
    {{-- Update Profile Information --}}
    <div class="p-4 border-bottom">
        @include('profile.partials.update-profile-information-form')
    </div>

    {{-- Update Password --}}
    <div class="p-4 border-bottom">
        @include('profile.partials.update-password-form')
    </div>

    {{-- Delete Account --}}
    <div class="p-4">
        @include('profile.partials.delete-user-form')
    </div>
@endsection

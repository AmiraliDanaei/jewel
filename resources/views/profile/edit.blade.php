{{-- ارث‌بری از لیوت اصلی فروشگاه --}}
@extends('layouts.main')

@section('title', 'ویرایش پروفایل')

@section('content')
    <div class="container py-5">
        <div class="row">
            
            
            <div class="col-md-3">
              
                @include('profile.partials.sidebar')
            </div>
          

           
            <div class="col-md-9">
                
                
                <div class="card shadow-sm mb-4">
                    <div class="card-body p-4">
                        @include('profile.partials.update-profile-information-form')
                    </div>
                </div>

               
                <div class="card shadow-sm mb-4">
                    <div class="card-body p-4">
                        @include('profile.partials.update-password-form')
                    </div>
                </div>

               
                <div class="card shadow-sm">
                    <div class="card-body p-4">
                        @include('profile.partials.delete-user-form')
                    </div>
                </div>
            </div>
            

        </div>
    </div>
@endsection

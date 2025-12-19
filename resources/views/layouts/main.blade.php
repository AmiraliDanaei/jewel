<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>EShopper - @yield('title')</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    
    <link href="{{ asset('img/favicon.ico') }}" rel="icon">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet"> 
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="{{ asset('lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>
<body>
    @include('layouts.partials.header')
    
    <div class="container">
        @if(session('success'))
            <div class="alert alert-success mt-3" role="alert">
                {{ session('success') }}
            </div>
        @endif
         @if(session('error'))
            <div class="alert alert-danger mt-3" role="alert">
                {{ session('error') }}
            </div>
        @endif
    </div>

    <main>
        @yield('content')
    </main>

    @include('layouts.partials.footer')
    
    <a href="#" class="btn btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>
    
    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('lib/easing/easing.min.js') }}"></script>
    <script src="{{ asset('lib/owlcarousel/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>


    @yield('scripts')

</body>
</html>

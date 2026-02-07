<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'فروشگاه')</title>

    <!-- Persian Font -->
    <link href="https://cdn.jsdelivr.net/gh/rastikerdar/vazirmatn@v33.003/Vazirmatn-font-face.css" rel="stylesheet" type="text/css" />
    
    
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    
    <style>
        body, h1, h2, h3, h4, h5, h6, .btn, .nav-link, .form-control, label {
            font-family: 'Vazirmatn', 'Poppins', sans-serif;
        }
        body {
            background-color: #f5f5f5;
        }
    </style>
</head>
<body class="font-sans antialiased">
    <div class="container">
        <div class="row justify-content-center" style="min-height: 100vh; align-items: center;">
            <div class="col-lg-6 col-md-8">
                 <div class="text-center mb-4">
                    <a href="/">
                        <h1 class="m-0 display-5 font-weight-semi-bold"><span class="text-primary font-weight-bold border px-3 mr-1">E</span>فروشگاه</h1>
                    </a>
                </div>
                {{ $slot }}
            </div>
        </div>
    </div>
</body>
</html>

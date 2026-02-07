<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - فروشگاه</title>
    
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/gh/rastikerdar/vazirmatn@v33.003/Vazirmatn-font-face.css" rel="stylesheet" type="text/css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

    <style>
        body, h1, h2, h3, h4, h5, h6, .btn, label, input::placeholder {
            font-family: 'Vazirmatn', 'Poppins', sans-serif !important;
        }
        body {
            background-color: #f8f9fa;
        }
        .auth-wrapper {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .auth-card {
            box-shadow: 0 1rem 3rem rgba(0,0,0,.175) !important;
            border: 0;
            border-radius: 1rem;
            overflow: hidden;
        }
        .auth-form-side {
            display: flex;
            flex-direction: column;
            justify-content: center;
            height: 100%;
            padding: 2.5rem;
        }
        .auth-image-side {
            background: url("{{ asset('img/auth-background.jpg') }}") no-repeat center center;
            background-size: cover;
        }
        .form-control {
            border-radius: 0.5rem;
            padding: 1.25rem 1rem;
            text-align: right;
        }
        .btn-primary {
            border-radius: 0.5rem;
            padding: 0.75rem;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="auth-wrapper">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-11 col-lg-9">
                    <div class="card auth-card">
                        <div class="row g-0">
                            <div class="col-md-6 order-2 order-md-1">
                                <div class="auth-form-side">
                                    <div class="text-center mb-4">
                                        <a href="/">
                                            <h2 class="font-weight-bold"><span class="text-primary">E</span>Shopper</h2>
                                        </a>
                                    </div>
                                   
                                    @yield('content') 
                                </div>
                            </div>
                            <div class="col-md-6 order-1 order-md-2 d-none d-md-block">
                                <div class="auth-image-side h-100"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

<!doctype html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Start CSS -->
    <link rel="stylesheet" href="{{ asset('vendor/bootstrap/css/bootstrap.css') }}">
    <!-- End CSS -->
    <title>Laravel - AdminLTE 3</title>
</head>
<body>

<!-- Start header -->
<header>
    <div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm">
        <h5 class="my-0 mr-md-auto font-weight-normal">Laravel - AdminLTE 3</h5>
        <nav class="my-2 my-md-0 mr-md-3">
            <a class="p-2 text-dark" href="{{ route('home') }}">Home</a>
        </nav>

        <!-- Start Buttons -->
        @auth
            <a href="{{ route('admin') }}" class="btn btn-outline-primary">Painel</a>
        @else
            <div class="d-grid gap-2">
                <a href="{{ route('login') }}" class="btn btn-outline-primary">Login</a>
                <a href="{{ route('register') }}" class="btn btn-outline-primary">Register</a>
            </div>
        @endauth
        <!-- End Buttons -->
    </div>
</header>
<!-- End header -->

<!-- Start content -->
@yield('content')
<!-- End content -->

<!-- Start JavaScript -->
<script src="{{ asset('vendor/jquery/jquery.js') }}"></script>
<script src="{{ asset('vendor/bootstrap/js//bootstrap.js') }}"></script>
<!-- End JavaScript -->

</body>
</html>

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="{{ asset('storage/'.setting('site.favicon')) }}">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ setting('site.title') }}</title>

    <!-- Data User Sesion-->
    <meta name="user" content="{{ Auth::user() }}">
    
    <!-- URL img page not found -->
    <meta name="img_page_not_found" content="{{ setting('site.error_404') }}">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- App css -->
    <link href="{{ asset('template/css/custom.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('template/css/app.css') }}" rel="stylesheet" type="text/css" id="light-style">
    <link href="{{ asset('template/css/app-dark.css') }}" rel="stylesheet" type="text/css" id="dark-style" disabled="disabled">

    <meta name="theme-color" content="#ffffff">
    
    <!-- Styles for toastr notifications -->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
</head>
<body data-layout-config="{{ Auth::user()->theme }}">
    <div id="app">
        <div class="wrapper mm-active">
            @include('components.left-menu')
                <div class="content-page">
                    <div class="content">
                        @include('components.header')
                        @yield('content')
                    </div>
                </div>
            @include('components.footer')
            @include('components.right-menu')
        </div>
        <!-- END wrapper -->
    </div>
    <!-- bundle -->
    {{-- <script type="text/javascript" src="{{ asset('template/scripts/vendor.min.js') }}"></script> --}}
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script type="text/javascript" src="{{ asset('template/scripts/app-custom.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
</body>
</html>
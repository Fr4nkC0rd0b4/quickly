<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="{{ setting('site.favion') }}">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ setting('site.title') }}</title>

    <!-- Data User Sesion-->
    <meta name="user" content="{{ Auth::user() }}">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- App css -->
    <link href="{{ asset('template/css/custom.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('template/css/app.css') }}" rel="stylesheet" type="text/css" id="light-style">
    <link href="{{ asset('template/css/app-dark.css') }}" rel="stylesheet" type="text/css" id="dark-style" disabled="disabled">
</head>
<body data-layout-config='{"leftSideBarTheme":"dark","layoutBoxed":false, "leftSidebarCondensed":false, "leftSidebarScrollable":false,"darkMode":true, "showRightSidebarOnStart": true}'>
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
    <!-- Icons -->
    <script src="https://unpkg.com/feather-icons/dist/feather.min.js"></script>
    <script>
        feather.replace();
    </script>
</body>
</html>
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="{{ asset('storage/' . setting('site.favicon')) }}">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ setting('site.title') }}</title>

    <!-- Data User Sesion-->
    <meta name="user" content="{{ Auth::user() }}">

    <!-- URL img page not found -->
    <meta name="img_page_not_found" content="{{ setting('site.logo') }}">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- App css -->
    <link href="{{ asset('template/css/app.css') }}" rel="stylesheet" type="text/css" id="light-style">
    <link href="{{ asset('template/css/app-dark.css') }}" rel="stylesheet" type="text/css" id="dark-style"
        disabled="disabled">
    <link href="{{ asset('template/css/custom.css') }}" rel="stylesheet" type="text/css">

    <meta name="theme-color" content="#ffffff">

    <!-- Styles for toastr notifications -->
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
</head>

<body class="show"
    data-layout-config="{'leftSideBarTheme':'dark','layoutBoxed':false, 'leftSidebarCondensed':false, 'leftSidebarScrollable':false,'darkMode':false, 'showRightSidebarOnStart': true}"
    style="visibility: visible;">
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
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>

    <script src="https://unpkg.com/metismenu"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://momentjs.com/downloads/moment.min.js"></script>

    <script type="text/javascript" src="{{ asset('template/scripts/app.js') }}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

    <script>
        $(document).ready(function() {
            console.log("JQUERY IS WORK");
        });
    </script>
</body>

</html>

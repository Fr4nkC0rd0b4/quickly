<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="{{ asset('storage/'.setting('site.favicon')) }}">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ setting('site.title') }}</title>

    <!-- URL img page not found -->
    <meta name="img_page_not_found" content="{{ setting('site.img_page_not_found') }}">

    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- App css -->
    <link href="{{ asset('template/css/custom.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('template/css/app.css') }}" rel="stylesheet" type="text/css" id="light-style">
    <link href="{{ asset('template/css/app-dark.css') }}" rel="stylesheet" type="text/css" id="dark-style" disabled="disabled">

    <meta name="theme-color" content="#ffffff">
</head>
<body>
    <div class="content">
        @yield('content')
    </div>
</body>
</html>
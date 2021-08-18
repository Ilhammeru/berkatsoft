<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- ################################################## CSS ############################################### --}}
    {{-- custom css --}}
    <link rel="stylesheet" href="{{ asset('assets/css/master.css') }}">
    @stack('css')

    {{-- bootstarp --}}
    <link rel="stylesheet" href="{{ asset('assets/bootstrap/css/bootstrap.min.css') }}">

    {{-- fontawesome --}}
    <link rel="stylesheet" href="{{ asset('assets/fontawesome/css/all.min.css') }}">

    {{-- ################################################## js ############################################### --}}
    <script src="{{ asset('assets/bootstrap/js/bootstrap.bundle.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="{{ asset('js/sweetalert.js') }}"></script>

    <style>
        .active {
            border-bottom: 1px solid skyblue;
        }
    </style>

    <title>Document</title>
</head>
<body>

@yield('navbar')
@yield('content')

@stack('js')
{{-- navigation --}}
    <script src="{{ asset('assets/js/navigate.js') }}"></script>

    {{-- pagination --}}
    <script src="{{ asset('assets/js/pagination.js') }}"></script>
</body>
</html>
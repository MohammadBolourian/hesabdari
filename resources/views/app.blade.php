<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" style="direction: rtl">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title inertia>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/Custom.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/line/css/line-awesome.css') }}">

        <!-- Scripts -->
        @routes
        <script src="{{ mix('js/app.js') }}" defer></script>
        <script src="{{ asset('assets/sweetalert/sweetalert2.all.js') }}"></script>

        @inertiaHead
    </head>
    <body>
        @inertia

        @env ('local')
{{--            <script src="http://localhost:8080/js/bundle.js"></script>--}}
        @endenv
    </body>
</html>
